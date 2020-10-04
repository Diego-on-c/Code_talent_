<?php

namespace App\Http\Controllers;


use App\Course;
use App\Promotion;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index()
    {
        $courses=Course::orderBy('name','ASC')->paginate(50);

        return view('courses.index',compact('courses'));
    }

    public function create()
    {
        $courses= Course::all();


        return view('courses.create',compact('courses'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[ 'name'=>'required']);


        Course::create($request->all());


        return redirect()->route('courses.index')->with('success','Registro creado satisfactoriamente');
    }


    public function show(Course $course)
    {
        //
    }

    public function edit($id)
    {
        $course=Course::find($id);


        return view('courses.edit',compact('course'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[ 'name'=>'required', 'platform'=>'required']);

        Course::find($id)->update($request->all());

        return redirect()->route('courses.index')->with('success','Registro actualizado satisfactoriamente');
    }

    public function destroy($id)
    {
        Course::find($id)->delete();

        return redirect()->route('courses.index')->with('success','Registro eliminado satisfactoriamente');
    }
}
