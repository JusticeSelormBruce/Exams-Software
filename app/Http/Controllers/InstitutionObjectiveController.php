<?php

namespace App\Http\Controllers;

use App\Institution;
use App\Objective;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstitutionObjectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'superadmin'){
            $objectives = Objective::all();    
        }else if(Auth::user()->role == 'admin'){
            $institutions = Institution::where('id', Auth::user()->institution_id)->get();
            $users = User::whereIn('institution_id', $institutions)->pluck('id')->toArray();
            $objectives = Objective::whereIn('user_id', $users)->get();
        }else{
            $objectives = Objective::where('user_id', Auth::user()->id)->get();
        }
        return view('institutionobjectives.index', ['objectives' => $objectives] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $topic = Topic::find($id);
        return view('institutionobjectives.create', ['topic' => $topic]);
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
            'question' => 'required',
            'answer' => 'required',
            'a' => 'required',
            'b' => 'required',
            'topic_id' => 'required',
            'difficulty' => 'required',
            'user_id' => 'required'
        ]);

        $topic = Topic::find($request->input('topic_id'))->objectives()->create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'a' => $request->input('a'),
            'b' => $request->input('b'),
            'c' => $request->input('c'),
            'd' => $request->input('d'),
            'e' => $request->input('e'),
            'difficulty' => $request->input('difficulty'),
            'user_id' => $request->input('user_id')
        ]);


        if($topic){
            return back()->with('success', 'Question Add Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function show($objective)
    {
        $objective = Objective::find($objective);
        return view('institutionobjectives.show', ['objective' => $objective]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function edit($objective)
    {
        $objective = Objective::find($objective);
        return view('institutionobjectives.edit', ['objective' => $objective]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $objective)
    {
        $objective = Objective::find($objective);
        $validatedRequest = $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'a' => 'required',
            'b' => 'required',
            'difficulty' => 'required'
        ]);

        $updatedObjective = $objective->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'a' => $request->input('a'),
            'b' => $request->input('b'),
            'c' => $request->input('c'),
            'd' => $request->input('d'),
            'e' => $request->input('e'),
            'difficulty' => $request->input('difficulty')
        ]);

        if($updatedObjective){
            return redirect()->route('objective.show', [$objective->id])->with('success', 'Objective Question Updated Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function destroy($objective)
    {
        $objective = Objective::find($objective);
        if($objective->delete()){
            return redirect()->route('objective.index')->with('success','Objective Question Deleted Successfully');
        }
        return back();
    }

    /**
     * Show the form for setting up to create a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setup()
    {
        if(Auth::user()->role == 'superadmin'){
            $institutions = Institution::all();
        }else{
            $institutions = Institution::where('id', Auth::user()->institution_id)->get();
        }
        return view('institutionobjectives.setup', ['institutions' => $institutions]);
    }
}
