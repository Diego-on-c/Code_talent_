<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Course;
use Illuminate\Http\Request;
use App\Promotion;


class PromotionController extends Controller
{

    public function index()
    {
        $promotions=Promotion::orderBy('created_at','ASC')->paginate(50);

        return view('promotion.index',compact('promotions'));
    }


    public function create()
    {
        $courses = Course::all();

        return view('promotion.create',compact('courses'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[ 'name'=>'required']);

        $promotion = Promotion::create($request->all());
        $courses_id = $request->input('courses_id');

        $courses = [];
        foreach ($courses_id as $id)
        {
           array_push($courses, Course::find($id));
        }

        $promotion->courses()->saveMany($courses);

        return redirect()->route('promotion.index')->with('success','Registro creado satisfactoriamente');

    }

    protected function show(Promotion $promotion)
    {
        return  view('promotion.show',compact('promotion'));
    }

    public function edit($id)
    {
        $promotion = Promotion::find($id);
        $courses = Course::all();

        return view('promotion.edit',compact('promotion','courses'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[ 'name'=>'required']);

        $promotion = Promotion::find($id);
        $promotion->update($request->all());


        $courses_ids = $request->courses_id;
        $promotion->courses()->detach();
        $promotion->courses()->attach($courses_ids);

        return redirect()->route('promotion.index')->with('success','Registro actualizado satisfactoriamente');

    }

    public function destroy($id)
    {
        Promotion::find($id)->delete();

        return redirect()->route('promotion.index')->with('success','Registro eliminado satisfactoriamente');

    }

}
