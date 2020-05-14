<?php

namespace App\Http\Controllers;

use App\System;
use App\Year;
use Illuminate\Http\Request;

class YearsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = Year::all();
        return view('years.index', ['years' => $years]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $systems = System::all();
        return view('years.create', ['systems' => $systems, 'systemDefault' => $id]);
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
            'system' => 'required'
        ]);
        
        $system = System::find($request->input('system'));
        if($system->for == 'basic'){
            $year = Year::create([
                'name' => $request->input('name'),
                'for' => $request->input('for'),
                'system_id' => $request->input('system'),
                'user_id' => $request->input('user_id')
            ]);
        }else{
            $year = Year::create([
                'name' => $request->input('name'),
                'for' => $system->for,
                'system_id' => $request->input('system'),
                'user_id' => $request->input('user_id')
            ]);
        }
        

        if ($year){
            return redirect()->route('years.show', [$year->id])->with('success','Year Created Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function show(Year $year)
    {
        return view('years.show',['year' => $year]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function edit(Year $year)
    {
        $systems = System::all();
        return view('years.edit',['year' => $year, 'systems' => $systems ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Year $year)
    {
        $validatedRequest = $request->validate([
            'name' => 'required',
            'system' => 'required'
        ]);

        $system = System::find($request->input('system'));
        if($system->for == 'basic'){
            $UpdatedYear = $year->update([
                'name' => $request->input('name'),
                'for' => $request->input('for'),
                'system_id' => $request->input('system')
            ]);
        }else{
            $UpdatedYear = $year->update([
                'name' => $request->input('name'),
                'for' => $system->for,
                'system_id' => $request->input('system')
            ]);
        }

        if($UpdatedYear){
            return redirect()->route('years.show',[$year->id])->with('success', 'Year Updated Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function destroy(Year $year)
    {
        if($year->delete()){
            return redirect()->route('years.index')->with('success','Year Deleted Successfully');
        }
        return back();
    }
}
