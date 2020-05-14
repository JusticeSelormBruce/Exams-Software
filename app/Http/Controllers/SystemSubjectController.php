<?php

namespace App\Http\Controllers;

use App\Subject;
use App\System;
use Illuminate\Http\Request;

class SystemSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('systemsubjects.index', ['subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $systems = System::all();
        return view('systemsubjects.create', ['systems' => $systems]);
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
            'system' => 'required',
            'name' => 'required'
        ]);
        $system = System::find($request->input('system'));
        if($system->for == 'basic'){
            $subject = Subject::create([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'for' => $request->input('for'),
                'subjectable_id' => $system->id,
                'subjectable_type' => 'App\System'
            ]);
        }else{
            $subject = Subject::create([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'for' => $system->for,
                'subjectable_id' => $system->id,
                'subjectable_type' => 'App\System'
            ]);
        }
        

        if($subject){
            return redirect()->route('system-subjects.show', [$subject->id])->with('success', 'System Subject Created Succussfully');
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
        return view('systemsubjects.show', ['subject' => $subject]);
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
        $systems = System::all();
        return view('systemsubjects.edit', ['subject' => $subject, 'systems' => $systems]);
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
            'system' => 'required',
            'name' => 'required'
        ]);

        $system = System::find($request->input('system'));
        $subject = Subject::find($subject);

        if($system->for == 'basic'){
            $updatedSubject = $subject->update([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'for' => $request->input('for'),
                'subjectable_id' => $system->id
            ]);
        }else{
            $updatedSubject = $subject->update([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'for' => $system->for,
                'subjectable_id' => $system->id
            ]);
        }
        
        if($updatedSubject){
            return redirect()->route('system-subjects.show', [$subject->id])->with('success', 'System Subject Updated Successfully');
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
            return redirect()->route('system-subjects.index')->with('success','System Subject Deleted Successfully');
        }
        return back();
    }
}
