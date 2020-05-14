<?php

namespace App\Http\Controllers;

use App\Department;
use App\Exam;
use App\Institution;
use App\Objective;
use App\School;
use App\Subject;
use App\Term;
use App\Theory;
use App\Topic;
use App\User;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstitutionExamController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 'superadmin'){
            $exams = Exam::all();   
        }else if(Auth::user()->role == 'admin'){
            $users = User::where('institution_id', Auth::user()->institution_id)->pluck('id')->toArray();
            $exams = Exam::whereIn('user_id', $users)->get();
        }else{
            $exams = Auth::user()->exams()->get();
        }
        return view('institutionexam.index', ['exams' => $exams]);
    }
    public function setup()
    {
        if(Auth::user()->role == 'superadmin'){
            $institutions = Institution::all();
        }else{
            $institutions = Institution::where('id', Auth::user()->institution_id)->get();
        }
        return view('institutionexam.setup', ['institutions' => $institutions]);
    }

    public function examination(Request $request)
    {
        $institution = Institution::find($request->input('institution'));
        $year = Year::find($request->input('year'));
        $semester = Term::find($request->input('semester'));
        $subject = Subject::find($request->input('subject'));
        $examiner = User::find($request->input('examiner'));
        $difficulty = $request->input('difficulty');
        $exam = $request->input('exam');
        $category = $request->input('category');
        $instruction = $request->input('header');

        $topics = Topic::where(['subject_id' => $request->input('subject'), 'year_id' => $request->input('year'), 'term_id' => $request->input('semester'), 'user_id' => Auth::user()->id])->get();

        $topics_id = $topics->pluck('id');

        $objectives = Objective::whereIn('topic_id', $topics_id)->get();

        $theories = Theory::whereIn('topic_id', $topics_id)->get();

        return view('institutionexam.examination', ['institution' => $institution,
            'year' => $year, 'semester' => $semester, 'subject' => $subject,
            'examiner' => $examiner, 'difficulty' => $difficulty,
            'exam' => $exam, 'instruction' => $instruction,
            'topics' => $topics,
            'objectives' => $objectives, 'theories' => $theories,
            'category' => $category]);
    }

    public function store(Request $request)
    {

        $sectionA = [];
        $sectionB = [];
        $topics = Topic::where('subject_id', $request->input('subject'))->get();
        foreach ($topics as $topic){
            $objectives = Objective::where('topic_id', $topic->id)->pluck('id')->toArray();
            shuffle($objectives);
            for($i = 0;$i < intval($request->input('no_a_'.$topic->id));$i++){
                $object = new class {};
                $object->ques = isset($objectives[$i]) ? $objectives[$i] : null;
                $object->mark = $request->input('marks_a_'.$topic->id);
                array_push($sectionA, $object);
            }
        }

        foreach ($topics as $topic){
            $theories = Theory::where('topic_id', $topic->id)->pluck('id')->toArray();
            shuffle($theories);
            for($u = 0;$u < intval($request->input('no_b_'.$topic->id));$u++){
                $object = new class {};
                $object->ques = isset($theories[$u]) ? $theories[$u] : null;
                $object->mark = $request->input('marks_b_'.$topic->id);
                array_push($sectionB, $object);
            }
        }

        $exam = Exam::create([
            'header' => $request->input('header'),
            'section_a' => json_encode($sectionA),
            'section_b' => json_encode($sectionB),
            'user_id' => Auth::user()->id,
            'subject_id' => $request->input('subject')
        ]);

        if ($exam){
            return redirect()->route('institutionexam')->with('success','Examination Question Generated Successfully');
        }

        return back()->withInput($request->input());
    }

    public function show($id)
    {
        $exam = Exam::find($id);
        $objectives = Objective::all();
        $theories = Theory::all();
        return view('institutionexam.show', ['exam' => $exam,
            'objectives' => $objectives, 'theories' => $theories]);
    }

    public function scheme($id)
    {
        $exam = Exam::find($id);
        $objectives = Objective::all();
        $theories = Theory::all();
        return view('institutionexam.scheme', ['exam' => $exam,
            'objectives' => $objectives, 'theories' => $theories]);
    }

    public function destroy($id)
    {
        $exam = Exam::find($id);
        if($exam->delete()){
            return redirect()->route('institutionexam')->with('success','Examination Question Deleted Successfully');
        }
        return back();
    }
}
