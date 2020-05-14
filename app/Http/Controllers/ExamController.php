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
use App\StudentExamLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
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
        return view('exam.index', ['exams' => $exams]);
    }
    public function setup()
    {
        if(Auth::user()->role == 'superadmin'){
            $institutions = Institution::all();
        }else{
            $institutions = Institution::where('id', Auth::user()->institution_id)->get();
        }
        return view('exam.setup', ['institutions' => $institutions]);
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
        $school = null;
        $department = null;

        if($request->get('type') == 'school'){
            $school = School::find($request->input('school'));
        }else if($request->get('type') == 'department'){
            $school = School::find($request->input('school'));
            $department = Department::find($request->input('department'));

        }

        $topics = Topic::where('subject_id', $request->input('subject'))->get();

        $topics_id = Topic::where('subject_id', $request->input('subject'))->pluck('id');

        $objectives = Objective::whereIn('topic_id', $topics_id)->get();

        $theories = Theory::whereIn('topic_id', $topics_id)->get();

        return view('exam.examination', ['institution' => $institution,
            'year' => $year, 'semester' => $semester, 'subject' => $subject,
            'examiner' => $examiner, 'difficulty' => $difficulty,
            'exam' => $exam, 'instruction' => $instruction,
            'school' => $school, 'department' => $department, 'topics' => $topics,
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
            return redirect()->route('exam')->with('success','Examination Question Generated Successfully');
        }

        return back()->withInput($request->input());
    }

    public function show($id)
    {
        $exam = Exam::find($id);
        $objectives = Objective::all();
        $theories = Theory::all();
        return view('exam.show', ['exam' => $exam,
            'objectives' => $objectives, 'theories' => $theories]);
    }
    public function write($id,Request $request)
    {
        $exam = Exam::find($id);
        $exam_section_a = json_decode($exam->section_a);
        if(sizeof($exam_section_a)<$request->input('page')){
            return view('exam.status', ['message'=>"End of Paper"] );
        }
        $exam_section_a_question = $exam_section_a[$request->input('page')-1];
        $objectives = Objective::all();
        $question = $objectives->find($exam_section_a_question->ques)->question;
        $a =  $objectives->find($exam_section_a_question->ques)->a;
        $b =  $objectives->find($exam_section_a_question->ques)->b;
        $c =  $objectives->find($exam_section_a_question->ques)->c;
        $d =  $objectives->find($exam_section_a_question->ques)->d;
        $e =  $objectives->find($exam_section_a_question->ques)->e;
        $theories = Theory::all();
        $exam_log = StudentExamLog::firstOrCreate([
            'exam_id' => $id,
            'objectives_id' => $objectives->find($exam_section_a_question->ques)->id,
            'student_id' => 1
        ]);
        return view('exam.write', ['exam' => $exam,
            'objectives' => $objectives, 
            'theories' => $theories,
            'question'=>$question,
            'exam_id'=>$id,
            'question_time'=> $exam_log->question_time,
            'exl'=>$exam_log->id,
            'objectives_id' => $objectives->find($exam_section_a_question->ques)->id,
            'page'=>$request->input('page'),
            'a'=>$a,
            'b'=>$b,
            'c'=>$c,
            'd'=>$d,
            'e'=>$e]);
    }
    public function submit_question(Request $request)
    {
        // $exam = Exam::find($id);
        $theories = Theory::all();
        $objectives = Objective::all();
        $exam_log = StudentExamLog::find($request->input('exl'));
        if($exam_log->objectives_id!=null && $exam_log->objective_answer!=null){
            //Already answered that question
            return redirect()->route('exam.write', array('id' => $request->input('exam_id'),'page'=>$request->input('page')+1 ));
        }
        $current_date_time = date("Y-m-d H:i:s");
        $start_dt = $exam_log->created_at;
        $duration=$exam_log->question_time;
        $start_dt_insec=strtotime($start_dt);
        $current_dt_insec=strtotime($current_date_time);
        $expected_end_dt_insec=$start_dt_insec+$duration;
        $expected_end_dt = date('Y-m-d H:i:s',$expected_end_dt_insec);

        if($current_date_time>$expected_end_dt){
            $exam_log->objective_answer = 'to';//timeout user unable to answer in time
            $exam_log->save();
            //return view('exam.status', ['message'=>"Timeout"] );
        }else{
           $upd =  $exam_log->update([
                'objective_answer'=>$request->input('answer')
            ]);
            
            $exam_log->objective_answer = $request->input('answer');
            //$exam_log->answer_time = $current_dt_insec-$start_dt_insec;
            $exam_log->save();
            //return view('exam.status', ['message'=>"Answered in Time"] );
        }
        
        return redirect()->route('exam.write', array('id' => $request->input('exam_id'),'page'=>$request->input('page')+1 ),301);
       

    }


    public function scheme($id)
    {
        $exam = Exam::find($id);
        $objectives = Objective::all();
        $theories = Theory::all();
        return view('exam.scheme', ['exam' => $exam,
            'objectives' => $objectives, 'theories' => $theories]);
    }

    public function destroy($id)
    {
        $exam = Exam::find($id);
        if($exam->delete()){
            return redirect()->route('exam')->with('success','Examination Question Deleted Successfully');
        }
        return back();
    }
}
