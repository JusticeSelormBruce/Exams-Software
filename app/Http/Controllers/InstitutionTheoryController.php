<?php

namespace App\Http\Controllers;

use App\Institution;
use App\Theory;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstitutionTheoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'superadmin'){
            $theories = Theory::all();    
        }else if(Auth::user()->role == 'admin'){
            $institutions = Institution::where('id', Auth::user()->institution_id)->get();
            $users = User::whereIn('institution_id', $institutions)->pluck('id')->toArray();
            $theories = Theory::whereIn('user_id', $users)->get();
        }else{
            $theories = Theory::where('user_id', Auth::user()->id)->get();
        }
        return view('institutiontheories.index', ['theories' => $theories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $topic = Topic::find($id);
        return view('institutiontheories.create', ['topic' => $topic]);
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
            'topic_id' => 'required',
            'difficulty' => 'required',
            'user_id' => 'required'
        ]);

        $topic = Topic::find($request->input('topic_id'))->theories()->create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
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
     * @param  \App\Theory  $theory
     * @return \Illuminate\Http\Response
     */
    public function show($theory)
    {
        $theory = Theory::find($theory);
        return view('institutiontheories.show', ['theory' => $theory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Theory  $theory
     * @return \Illuminate\Http\Response
     */
    public function edit($theory)
    {
        $theory = Theory::find($theory);
        return view('institutiontheories.edit', ['theory' => $theory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Theory  $theory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $theory)
    {
        $theory = Theory::find($theory);
        $validatedRequest = $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'difficulty' => 'required'
        ]);

        $updatedTheory = $theory->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'difficulty' => $request->input('difficulty')
        ]);

        if($updatedTheory){
            return redirect()->route('theory.show', [$theory->id])->with('success', 'Theory Question Updated Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Theory  $theory
     * @return \Illuminate\Http\Response
     */
    public function destroy($theory)
    {
        $theory = Theory::find($theory);
        if($theory->delete()){
            return redirect()->route('theory.index')->with('success','Theory Question Deleted Successfully');
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
        return view('institutiontheories.setup', ['institutions' => $institutions]);
    }
}
