<?php

namespace App\Http\Controllers;

use App\Institution;
use App\School;
use App\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'superadmin'){
            $schools = School::all();
        }else{
            $schools = School::where('institution_id', Auth::user()->institution_id)->get();
        }
        return view('tertiary.schools.index',['schools' => $schools]);
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
        $systems = System::where(['type' => 'specific', 'for' => 'tertiary'])->get();
        return view('tertiary.schools.create', ['institutions' => $institutions, 'systems' => $systems]);
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
            'name' => 'required',
            'system' => 'required',
            'institution' => 'required',
            'user_id' => 'required'
        ]);

        $school = School::create([
            'name' => $request->input('name'),
            'system_id' => $request->input('system'),
            'institution_id' => $request->input('institution'),
            'user_id' => $request->input('user_id')
        ]);

        if($school){
            return redirect()->route('schools.show',[$school->id])->with('success', 'School Created Succussfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return view('tertiary.schools.show', ['school' => $school]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        if(Auth::user()->role == 'superadmin'){
            $institutions = Institution::all();
        }else{
            $institutions = Institution::where('id', Auth::user()->institution_id)->get();
        }
        $systems = System::where(['type' => 'specific', 'for' => 'tertiary'])->get();
        return view('tertiary.schools.edit',['school' => $school, 'institutions' => $institutions, 'systems' => $systems]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $validatedRequest = $request->validate([
            'name' => 'required',
            'system' => 'required',
            'institution' => 'required'
        ]);

        $UpdatedSchool = $school->update([
            'name' => $request->input('name'),
            'system_id' => $request->input('system'),
            'institution_id' => $request->input('institution')
        ]);

        if($UpdatedSchool){
            return redirect()->route('schools.show',[$school->id])->with('success', 'School Updated Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        if($school->delete()){
            return redirect()->route('schools.index')->with('success','School Deleted Successfully');
        }
        return back();
    }
}
