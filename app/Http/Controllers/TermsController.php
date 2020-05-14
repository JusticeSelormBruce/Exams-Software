<?php

namespace App\Http\Controllers;

use App\System;
use App\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Term::all();
        return view('terms.index', ['terms' => $terms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $systems = System::all();
        return view('terms.create', ['systems' => $systems, 'systemDefault' => $id ]);
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
            $term = Term::create([
                'name' => $request->input('name'),
                'for' => $request->input('for'),
                'system_id' => $request->input('system'),
                'user_id' => $request->input('user_id')
            ]);
        }else{
            $term = Term::create([
                'name' => $request->input('name'),
                'for' => $system->for,
                'system_id' => $request->input('system'),
                'user_id' => $request->input('user_id')
            ]);
        }
        

        if ($term){
            return redirect()->route('terms.show', [$term->id])->with('success','Term Created Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        return view('terms.show', ['term' => $term]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        $systems = System::all();
        return view('terms.edit',['term' => $term, 'systems' => $systems ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
        $validatedRequest = $request->validate([
            'name' => 'required',
            'system' => 'required'
        ]);

        $system = System::find($request->input('system'));
        if($system->for == 'basic'){
            $UpdatedTerm = $term->update([
                'name' => $request->input('name'),
                'for' => $request->input('for'),
                'system_id' => $request->input('system')
            ]);
        }else{
            $UpdatedTerm = $term->update([
                'name' => $request->input('name'),
                'for' => $system->for,
                'system_id' => $request->input('system')
            ]);
        }

        if($UpdatedTerm){
            return redirect()->route('terms.show',[$term->id])->with('success', 'Term Updated Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        if($term->delete()){
            return redirect()->route('terms.index')->with('success','Term Deleted Successfully');
        }
        return back();
    }
}
