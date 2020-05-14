<?php

namespace App\Http\Controllers;

use App\Department;
use App\Institution;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'superadmin'){
            $departments = Department::all();
        }else{
            $institutions = Institution::find(Auth::user()->institution_id);
            $schools = School::whereIn('institution_id', $institutions)->pluck('id');
            $departments = Department::whereIn('school_id', $schools)->get();
        }
        return view('tertiary.departments.index', ['departments' => $departments]);
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
            return view('tertiary.departments.create', ['institutions' => $institutions, 'schools' => $schools]);
        }
        return view('tertiary.departments.create', ['institutions' => $institutions]);
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
            'institution' => 'required',
            'school' => 'required'
        ]);

        $department = Department::create([
            'name' => $request->input('name'),
            'school_id' => $request->input('school')
        ]);

        if($department){
            return redirect()->route('departments.show',[$department->id])->with('success', 'Department Created Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('tertiary.departments.show', ['department' => $department]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        if(Auth::user()->role == 'superadmin'){
            $institutions = Institution::all();
        }else{
            $institutions = Institution::where('id', Auth::user()->institution_id)->get();
        }
        $schools = School::where('institution_id', $department->school->institution->id)->get();
        return view('tertiary.departments.edit', ['department' => $department, 'institutions' => $institutions, 'schools' => $schools]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $validatedRequest = $request->validate([
            'name' => 'required',
            'school' => 'required',
            'institution' => 'required'
        ]);

        $UpdatedDepartment = $department->update([
            'name' => $request->input('name'),
            'school_id' => $request->input('school')
        ]);

        if($UpdatedDepartment){
            return redirect()->route('departments.show',[$department->id])->with('success', 'Department Updated Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        if($department->delete()){
            return redirect()->route('departments.index')->with('success','Department Deleted Successfully');
        }
        return back();
    }
}
