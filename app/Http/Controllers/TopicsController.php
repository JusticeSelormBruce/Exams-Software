<?php

namespace App\Http\Controllers;

use App\Institution;
use App\Subject;
use App\Topic;
use App\School;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
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
            $institutions = Institution::find(Auth::user()->institution_id);
            $schools = School::whereIn('institution_id', $institutions)->get();
            $departments = Department::whereIn('school_id', $schools)->pluck('id');
            $subjects1 = Subject::whereIn('subjectable_id', $institutions)->where('subjectable_type', 'App\Institution')->get();
            $subjects2 = Subject::whereIn('subjectable_id', $schools)->where('subjectable_type', 'App\School')->get();
            $subjects3 = Subject::whereIn('subjectable_id', $departments)->where('subjectable_type', 'App\Department')->get();
            $subjects = $subjects1->concat($subjects2)->concat($subjects3)->pluck('id');
            $topics = Topic::whereIn('subject_id', $subjects)->get();
        }
        return view('tertiary.topics.index', ['topics' => $topics]);
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
        return view('tertiary.topics.create', ['institutions' => $institutions]);
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
                'subject' => 'required',
                'institution' => 'required'
            ]);
        }else if($request->get('type') == 'school'){
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'subject' => 'required',
                'institution' => 'required',
                'school' => 'required'
            ]);
        }else if($request->get('type') == 'department'){
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'institution' => 'required',
                'school' => 'required',
                'subject' => 'required',
                'department' => 'required'
            ]);
        }else{
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'institution' => 'required',
                'school' => 'required',
                'department' => 'required',
                'subject' => 'required',
                'type' => 'required'
            ]);
        }

        $topic = Topic::create([
            'name' => $request->input('name'),
            'subject_id' => $request->input('subject'),
            'year_id' => 1,
            'term_id' => 1,
            'user_id' => Auth::user()->id
        ]);

        if($topic){
            return redirect()->route('topics.show', [$topic->id])->with('success', 'Topic Created Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return view('tertiary.topics.show', ['topic' => $topic]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        if(Auth::user()->role == 'superadmin'){
            $institutions = Institution::all();
        }else{
            $institutions = Institution::where('id', Auth::user()->institution_id)->get();
        }

        if($topic->subject->subjectable_type == 'App\School'){
            $schools = School::where('institution_id', $topic->subject->subjectable->institution_id)->get();
            $subjects = Subject::where('subjectable_id',$topic->subject->subjectable->id)->get();
            return view('topics.edit', ['topic' => $topic, 'subject' => $subjects, 'institutions' => $institutions, 'schools' => $schools, 'subjects' => $subjects]);
        }else if($topic->subject->subjectable_type == 'App\Department'){
            $departments = Department::where('school_id', $topic->subject->subjectable->school_id)->get();
            $department = Department::where('school_id', $topic->subject->subjectable->school_id)->get()->first();
            $schools = School::where('institution_id', $department->school->institution->id)->get();
            $subjects = Subject::where('subjectable_id',$topic->subject->subjectable->id)->get();
            return view('topics.edit', ['topic' => $topic, 'institutions' => $institutions, 'schools' => $schools, 'departments' => $departments, 'subjects' => $subjects]);
        }

        $subjects = Subject::where('subjectable_id',$topic->subject->subjectable->id)->get();
        return view('tertiary.topics.edit', ['topic' => $topic, 'institutions' => $institutions, 'subjects' => $subjects]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $validatedRequest = null;
        if($request->get('type') == 'institution'){
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'institution' => 'required',
                'subject' => 'required'
            ]);
        }else if($request->get('type') == 'school'){
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'institution' => 'required',
                'school' => 'required',
                'subject' => 'required'
            ]);
        }else if($request->get('type') == 'department'){
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'institution' => 'required',
                'school' => 'required',
                'department' => 'required',
                'subject' => 'required'
            ]);
        }else{
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'name' => 'required',
                'institution' => 'required',
                'school' => 'required',
                'department' => 'required',
                'type' => 'required',
                'subject' => 'required'
            ]);
        }

        $updatedTopic = $topic->update([
            'name' => $request->input('name'),
            'subject_id' => $request->input('subject')
        ]);

        if($updatedTopic){
            return redirect()->route('topics.show', [$topic->id])->with('success', 'Topic Updated Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        if($topic->delete()){
            return redirect()->route('topics.index')->with('success','Topic Deleted Successfully');
        }
        return back();
    }
}
