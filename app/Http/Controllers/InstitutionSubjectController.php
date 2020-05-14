<?php

namespace App\Http\Controllers;

use App\Subject;
use App\System;
use App\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstitutionSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'superadmin'){
            $subjects = Subject::all();
        }else{
            $subject1 = Subject::where(['subjectable_id' => Auth::user()->institution->system_id, 'subjectable_type' => 'App\System'])->get();
            $subject2 = Subject::where(['subjectable_id' => Auth::user()->institution_id, 'subjectable_type' => 'App\Institution'])->get();
            $subjects = $subject1->concat($subject2)->all();
        }
        return view('institutionsubjects.index', ['subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == 'superadmin'){
            $institutions = Institution::all();
        }else{
            $institutions = Institution::where('id', Auth::user()->institution_id)->get();
        }
        return view('institutionsubjects.create', ['institutions' => $institutions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'institution' => 'required',
            'name' => 'required'
        ]);
        $institution = Institution::find($request->input('institution'));
        if($institution->type == 'basic'){
            $subject = Subject::create([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'for' => $request->input('for'),
                'subjectable_id' => $institution->id,
                'subjectable_type' => 'App\Institution'
            ]);
        }else{
            $subject = Subject::create([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'for' => $institution->type,
                'subjectable_id' => $institution->id,
                'subjectable_type' => 'App\Institution'
            ]);
        }
        

        if($subject){
            return redirect()->route('subject.show', [$subject->id])->with('success', 'Subject Created Succussfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show($subject)
    {
        $subject = Subject::find($subject);
        return view('institutionsubjects.show', ['subject' => $subject]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit($subject)
    {
        $subject = Subject::find($subject);
        $institutions = Institution::all();
        return view('institutionsubjects.edit', ['subject' => $subject, 'institutions' => $institutions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subject)
    {
        $validatedRequest = $request->validate([
            'institution' => 'required',
            'name' => 'required'
        ]);

        $institution = Institution::find($request->input('institution'));
        $subject = Subject::find($subject);

        if($institution->type == 'basic'){
            $updatedSubject = $subject->update([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'for' => $request->input('for'),
                'subjectable_id' => $institution->id
            ]);
        }else{
            $updatedSubject = $subject->update([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'for' => $institution->type,
                'subjectable_id' => $institution->id
            ]);
        }
        
        if($updatedSubject){
            return redirect()->route('subject.show', [$subject->id])->with('success', 'Subject Updated Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($subject)
    {
        $subject = Subject::find($subject);
        if($subject->delete()){
            return redirect()->route('subject.index')->with('success','Subject Deleted Successfully');
        }
        return back();
    }
}
