<?php

namespace App\Http\Controllers;

use App\Department;
use App\Institution;
use App\School;
use App\Subject;
use App\Term;
use App\Topic;
use App\User;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function school($id)
    {
        $schools = School::where('institution_id', $id)->get();
        return json_encode($schools);
    }

    public function department($id)
    {
        $departments = Department::where('school_id', $id)->get();
        return json_encode($departments);
    }

    public function subject($id)
    {
        $institution = Institution::find($id);
		if(Auth::user()->role == 'lecturer'){
            $subject1 = Auth::user()->subjects()->where(['subjectable_id'=> $institution->system_id, 'subjectable_type' => 'App\System'])->get();
            $subject2 = Auth::user()->subjects()->where(['subjectable_id'=> $id, 'subjectable_type' => 'App\Institution'])->get();
            $subjects = $subject1->concat($subject2)->all();
        }else{
            $subject1 = Subject::where(['subjectable_id' => $institution->system_id, 'subjectable_type' => 'App\System'])->get();
            $subject2 = Subject::where(['subjectable_id' => $id, 'subjectable_type' => 'App\Institution'])->get();
            $subjects = $subject1->concat($subject2)->all();
        }
        return json_encode($subjects);
    }

    public function subjectInstitution($id)
    {
        if(Auth::user()->role == 'lecturer'){
            $subjects = Auth::user()->assignedSubjects()->where(['subjectable_id'=> $id, 'subjectable_type' => 'App\Institution'])->get();
        }else{
            $subjects = Subject::where(['subjectable_id'=> $id, 'subjectable_type' => 'App\Institution'])->get();
        }
        return json_encode($subjects);
    }

    public function subjectSchool($id)
    {
        if(Auth::user()->role == 'lecturer'){
            $subjects = Auth::user()->assignedSubjects()->where(['subjectable_id'=> $id, 'subjectable_type' => 'App\School'])->get();
        }else{
            $subjects = Subject::where(['subjectable_id'=> $id, 'subjectable_type' => 'App\School'])->get();
        }
        return json_encode($subjects);
    }

    public function subjectDepartment($id)
    {
        if(Auth::user()->role == 'lecturer'){
            $subjects = Auth::user()->assignedSubjects()->where(['subjectable_id'=> $id, 'subjectable_type' => 'App\Department'])->get();
        }else{
            $subjects = Subject::where(['subjectable_id'=> $id, 'subjectable_type' => 'App\Department'])->get();
        }
        return json_encode($subjects);
    }

    public function topic($id)
    {
        $topics = Topic::where('subject_id', $id)->get();
        return json_encode($topics);
    }

    public function specifictopic($id, $de, $fe)
    {
        $topics = Topic::where(['subject_id' => $id, 'year_id' => $de, 'term_id' => $fe, 'user_id' => Auth::user()->id])->get();
        return json_encode($topics);
    }

    public function user($id)
    {
        $user = User::find($id);
        return view('assignment.info', ['user' => $user]);
    }

    public function user2($id)
    {
        $user = User::find($id);
        return view('assignment.info2', ['user' => $user]);
    }

    public function lecturer($id)
    {
        $institution = Institution::find($id);
        if(Auth::user()->role == 'superadmin'){
            $users = $institution->usersAssigned()->where('role', 'lecturer')->get();
        }else{
            $users = $institution->usersAssigned()->where(['role' => 'lecturer', 'created_by' => Auth::user()->id])->get();
        }
        return json_encode($users);
    }

    public function year($id)
    {
        $school = School::find($id);
        $system = $school->system->id;
        $years = Year::where('system_id', $system)->get();
        return json_encode($years);
    }

    public function semester($id)
    {
        $school = School::find($id);
        $system = $school->system->id;
        $semesters = Term::where('system_id', $system)->get();
        return json_encode($semesters);
    }

    public function yearI($id)
    {
        $institution = Institution::find($id);
        $system = $institution->system->id;
        $years = Year::where('system_id', $system)->get();
        return json_encode($years);
    }

    public function semesterI($id)
    {
        $institution = Institution::find($id);
        $system = $institution->system->id;
        $semesters = Term::where('system_id', $system)->get();
        return json_encode($semesters);
    }
}
