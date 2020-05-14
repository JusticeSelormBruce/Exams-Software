<?php

namespace App\Http\Controllers;

use App\Department;
use App\Institution;
use App\School;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectsController extends Controller
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
            $institutions = Institution::find(Auth::user()->institution_id);
            $schools = School::whereIn('institution_id', $institutions)->pluck('id');
            $departments = Department::whereIn('school_id', $schools)->pluck('id');
            $subjects1 = Subject::whereIn('subjectable_id', $institutions)->where('subjectable_type', 'App\Institution')->get();
            $subjects2 = Subject::whereIn('subjectable_id', $schools)->where('subjectable_type', 'App\School')->get();
            $subjects3 = Subject::whereIn('subjectable_id', $departments)->where('subjectable_type', 'App\Department')->get();
            $subjects = $subjects1->concat($subjects2)->concat($subjects3)->all();
        }
        return view('tertiary.subjects.index',['subjects' => $subjects]);
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
            $schools = School::where('institution_id', Auth::user()->institution_id)->get();
            return view('tertiary.subjects.create', ['institutions' => $institutions, 'schools' => $schools]);
        }
        return view('tertiary.subjects.create', ['institutions' => $institutions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedRequest = null;
        if($request->get('type') == 'institution'){
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'institution' => 'required'
            ]);
        }else if($request->get('type') == 'school'){
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'institution' => 'required',
                'school' => 'required'
            ]);
        }else if($request->get('type') == 'department'){
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'institution' => 'required',
                'school' => 'required',
                'department' => 'required'
            ]);
        }else{
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'institution' => 'required',
                'school' => 'required',
                'department' => 'required',
                'type' => 'required'
            ]);
        }

        $res = null;
        if($request->get('type') == 'institution'){
            global $res;
            $res = Institution::find($request->input('institution'));
            $res->subjects()->create([
                'name' => $request->input('name'),
                'code' => $request->input('code')
            ]);
        }else if($request->get('type') == 'school'){
            global $res;
            $res = School::find($request->input('school'));
            $res->subjects()->create([
                'name' => $request->input('name'),
                'code' => $request->input('code')
            ]);
        }else if($request->get('type') == 'department'){
            global $res;
            $res = Department::find($request->input('department'));
            $res->subjects()->create([
                'name' => $request->input('name'),
                'code' => $request->input('code')
            ]);
        }

        $subject = Subject::orderBy('created_at', 'desc')->first();


        if($subject){
            return redirect()->route('subjects.show', [$subject->id])->with('success', 'Course/Subject Created Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('tertiary.subjects.show', ['subject' => $subject]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        if(Auth::user()->role == 'superadmin'){
            $institutions = Institution::all();
        }else{
            $institutions = Institution::where('id', Auth::user()->institution_id)->get();
        }

        if($subject->subjectable_type == 'App\School'){
            $schools = School::where('institution_id', $subject->subjectable->institution_id)->get();
            return view('tertiary.subjects.edit', ['subject' => $subject, 'institutions' => $institutions, 'schools' => $schools]);
        }else if($subject->subjectable_type == 'App\Department'){
            $departments = Department::where('school_id', $subject->subjectable->school_id)->get();
            $department = Department::where('school_id', $subject->subjectable->school_id)->get()->first();
            $schools = School::where('institution_id', $department->school->institution->id)->get();
            return view('tertiary.subjects.edit', ['subject' => $subject, 'institutions' => $institutions, 'schools' => $schools, 'departments' => $departments]);
        }
        return view('tertiary.subjects.edit', ['subject' => $subject, 'institutions' => $institutions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $validatedRequest = null;
        if($request->get('type') == 'institution'){
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'institution' => 'required',
            ]);
        }else if($request->get('type') == 'school'){
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'institution' => 'required',
                'school' => 'required'
            ]);
        }else if($request->get('type') == 'department'){
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'institution' => 'required',
                'school' => 'required',
                'department' => 'required'
            ]);
        }else{
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'institution' => 'required',
                'school' => 'required',
                'department' => 'required',
                'type' => 'required'
            ]);
        }

        $updatedSubject = null;

        if($request->get('type') == 'institution'){
            global $updatedSubject;
            $updatedSubject = $subject->update([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'subjectable_id' => $request->input('institution'),
                'subjectable_type' => 'App\Institution'
            ]);
        }else if($request->get('type') == 'school'){
            global $updatedSubject;
            $updatedSubject = $subject->update([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'subjectable_id' => $request->input('school'),
                'subjectable_type' => 'App\School'
            ]);
        }else if($request->get('type') == 'department'){
            global $updatedSubject;
            $updatedSubject = $subject->update([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'subjectable_id' => $request->input('department'),
                'subjectable_type' => 'App\Department'
            ]);
        }

        if($updatedSubject){
            return redirect()->route('subjects.show',[$subject->id])->with('success', 'Course/Subject Updated Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        if($subject->delete()){
            return redirect()->route('subjects.index')->with('success','Course/Subject Deleted Successfully');
        }
        return back();
    }
}
