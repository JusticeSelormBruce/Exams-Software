<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Objective;
use App\Subject;
use App\Theory;
use App\Institution;
use App\School;
use App\Department;
use App\User;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'superadmin'){
            $subjects = Subject::all();
            $objectives = Objective::all();
            $theories = Theory::all();
            $exam = Exam::all();
        }else if(Auth::user()->role == 'admin'){
            $institution = Auth::user()->institution->id;
            $schools = School::where('institution_id', $institution)->pluck('id');
            $departments = Department::whereIn('school_id', $schools)->pluck('id');
            $subjects1 = Subject::where('subjectable_id', $institution)->where('subjectable_type', 'App\Institution')->get();
            $subjects2 = Subject::whereIn('subjectable_id', $schools)->where('subjectable_type', 'App\School')->get();
            $subjects3 = Subject::whereIn('subjectable_id', $departments)->where('subjectable_type', 'App\Department')->get();
            $subjects = $subjects1->concat($subjects2)->concat($subjects3);
            $users = User::where('institution_id', $institution)->pluck('id')->toArray();
            $objectives = Objective::whereIn('user_id', $users)->get();
            $theories = Theory::whereIn('user_id', $users)->get();
            $exam = Exam::whereIn('user_id', $users)->get();
        }
        else if(Auth::user()->role == 'student'){
            $student = Student::where('user_id', Auth::user()->id)->first();
            //$subjects = Auth::user()->assignedSubjects;
            //$objectives = Objective::where('user_id', Auth::user()->id);
            //$theories = Theory::where('user_id', Auth::user()->id);
            $exams = Exam::all();
            //var_dump($student);
            return view('student_welcome', ['exams' => $exams,'student' => $student]);
        }
        else{
            $subjects = Auth::user()->assignedSubjects;
            $objectives = Objective::where('user_id', Auth::user()->id);
            $theories = Theory::where('user_id', Auth::user()->id);
            $exam = Exam::where('user_id', Auth::user()->id);
        }
        return view('home', ['subjects' => $subjects,
            'objectives' => $objectives, 'theories' => $theories, 'exam' => $exam]);
    }
}
