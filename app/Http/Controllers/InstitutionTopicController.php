<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Year;
use App\Term;
use App\Subject;
use App\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstitutionTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'superadmin'){
            $topics = Topic::all();
        }else{
            //$subjects = Subject::where(['subjectable_id' => Auth::user()->institution_id, 'subjectable_type' => 'App\Institution'])->pluck('id');
            $topics = Topic::where('user_id', Auth::user()->id)->get();
        }
        return view('institutiontopics.index', ['topics' => $topics]);
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
        return view('institutiontopics.create', ['institutions' => $institutions]);
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
            'subject' => 'required',
            'institution' => 'required',
            'year' => 'required',
            'term' => 'required'
        ]);

        $topic = Topic::create([
            'name' => $request->input('name'),
            'subject_id' => $request->input('subject'),
            'year_id' => $request->input('year'),
            'term_id' => $request->input('term'),
            'user_id' => Auth::user()->id
        ]);

        if($topic){
            return redirect()->route('topic.show', [$topic->id])->with('success', 'Topic Created Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show($topic)
    {
        $topic = Topic::find($topic);
        return view('institutiontopics.show', ['topic' => $topic]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit($topic)
    {   
        if(Auth::user()->role == 'superadmin'){
            $institutions = Institution::all();
        }else{
            $institutions = Institution::where('id', Auth::user()->institution_id)->get();
        }
        $topic = Topic::find($topic);
        $subject1 = Subject::where(['subjectable_id' => $topic->subject->subjectable->id, 'subjectable_type' => 'App\System'])->get();
        $subject2 = Subject::where(['subjectable_id' => $topic->subject->subjectable->id, 'subjectable_type' => 'App\Institution'])->get();
        $subjects = $subject1->concat($subject2)->all();
        $years = Year::where(['system_id' => $topic->year->system->id])->get();
        $terms = Term::where(['system_id' => $topic->term->system->id])->get();
        return view('institutiontopics.edit', ['topic' => $topic, 'institutions' => $institutions, 'subjects' => $subjects, 'years' => $years, 'terms' => $terms]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $topic)
    {
        $topic = Topic::find($topic);
        $validatedRequest = $request->validate([
            'name' => 'required',
            'institution' => 'required',
            'subject' => 'required',
            'year' => 'required',
            'term' => 'required'
        ]);

        $updatedTopic = $topic->update([
            'name' => $request->input('name'),
            'subject_id' => $request->input('subject'),
            'term_id' => $request->input('term'),
            'year_id' => $request->input('year')
        ]);

        if($updatedTopic){
            return redirect()->route('topic.show', [$topic->id])->with('success', 'Topic Updated Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy($topic)
    {
        $topic = Topic::find($topic);
        if($topic->delete()){
            return redirect()->route('topics.index')->with('success','Topic Deleted Successfully');
        }
        return back();
    }
}
