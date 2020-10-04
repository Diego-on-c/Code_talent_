<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Candidate;
use App\Promotion;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{

    protected function index()
    {
        $candidates=Candidate::orderBy('percentage','ASC')->paginate(50);

        return view('candidate.index',compact('candidates'));
    }


    protected function create()
    {
        $promotions= Promotion::all();


        return view('candidate.create',compact('promotions'));
    }


    protected function store(Request $request)
    {
        $this->validate($request,[ 'name'=>'required', 'lastname'=>'required', 'email'=>'required', 'sololearn'=>'required', 'codeacademy'=>'required']);


        Candidate::create($request->all());


        return redirect()->route('candidate.index')->with('success','Registro creado satisfactoriamente');

    }

    protected function show($id)
    {
        $candidate=Candidate::find($id);
        $courses = $candidate->promotion->courses;
        foreach($courses as $course)
        {
            $progress[] = DB::table('progress')->where('course_id', $course->id)->get();
        }
        return  view('candidate.perfil',compact('candidate', 'courses', 'progress'));
    }

    protected function edit($id)
    {
        $candidate=Candidate::find($id);
        $promotions= Promotion::all();


        return view('candidate.edit',compact('candidate','promotions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[ 'name'=>'required', 'lastname'=>'required', 'email'=>'required', 'sololearn'=>'required', 'codeacademy'=>'required']);

        Candidate::find($id)->update($request->all());

        return redirect()->route('candidate.index')->with('success','Registro actualizado satisfactoriamente');

    }

    public function destroy($id)
    {
        Candidate::find($id)->delete();

        return redirect()->route('candidate.index')->with('success','Registro eliminado satisfactoriamente');

    }

}
