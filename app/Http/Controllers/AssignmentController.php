<?php

namespace App\Http\Controllers;

use App\Institution;
use App\InstitutionUser;
use App\Subject;
use App\SubjectUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function institution()
    {
        if(Auth::user()->role == 'superadmin'){
            $institutions = Institution::all();
        }else{
            $institutions = Auth::user()->assignedInstitutions()->get();
        }
        $users = User::where('role', 'admin')->get();
        return view('assignment.institution', ['institutions' => $institutions, 'users' => $users]);
    }

    public function institution2()
    {
        if(Auth::user()->role == 'superadmin'){
            $institutions = Institution::all();
            $users = User::where('role', 'lecturer')->get();
        }else{
            $institutions = Auth::user()->assignedInstitutions()->get();
            $users = User::where(['role' => 'lecturer', 'created_by' => Auth::user()->id])->get();
        }
        return view('assignment.institution2', ['institutions' => $institutions, 'users' => $users]);
    }

    public function storeInstitution(Request $request)
    {

        $validatedRequest = $request->validate([
            'user' => 'required',
            'institution' => 'required'
        ]);

        $user = User::find($request->input('user'));
        $institution = Institution::find($request->input('institution'));
        $institutionUser = InstitutionUser::where([
            'institution_id' => $request->input('institution'),
            'user_id' => $request->input('user')
        ])->get()->count();
        if($institutionUser){
            return back()->with('warning','Assignment already Exist Successfully');
        }else{
            $user->assignedInstitutions()->attach($institution);
        }

        if ($user && $institution){
            return back()->with('success','Assignment Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    public function destroyInstitution($id)
    {
        $institutionUser = InstitutionUser::find($id);

        if($institutionUser->delete()){
            return back()->with('success','User Remove from Institution Successfully');
        }
        return back();
    }

    public function subject()
    {
        if(Auth::user()->role == 'superadmin'){
            $institutions = Institution::all();
            $users = User::where('role', 'lecturer')->get();
        }else{
            $institutions = Institution::where('id', Auth::user()->institution_id)->get();
            $users = User::where(['role' => 'lecturer', 'institution_id' => Auth::user()->institution_id])->get();
        }
        return view('assignment.subject', ['institutions' => $institutions, 'users' => $users]);
    }

    public function subject2()
    {
        if(Auth::user()->role == 'superadmin'){
            $institutions = Institution::all();
            $users = User::where('role', 'lecturer')->get();
        }else{
            $institutions = Institution::where('id', Auth::user()->institution_id)->get();
            $users = User::where(['role' => 'lecturer', 'institution_id' => Auth::user()->institution_id])->get();
        }
        return view('assignment.subject2', ['institutions' => $institutions, 'users' => $users]);
    }

    public function storeSubject(Request $request)
    {

        $validatedRequest = null;
        if($request->get('type') == 'institution'){
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'user' => 'required',
                'subject' => 'required',
                'institution' => 'required'
            ]);
        }else if($request->get('type') == 'school'){
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'user' => 'required',
                'subject' => 'required',
                'institution' => 'required',
                'school' => 'required'
            ]);
        }else if($request->get('type') == 'department'){
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'user' => 'required',
                'institution' => 'required',
                'school' => 'required',
                'subject' => 'required',
                'department' => 'required'
            ]);
        }else{
            global $validatedRequest;
            $validatedRequest = $request->validate([
                'user' => 'required',
                'subject' => 'required'
            ]);
        }

        $user = User::find($request->input('user'));
        $subject = Subject::find($request->input('subject'));
        $subjectUser = SubjectUser::where([
            'subject_id' => $request->input('subject'),
            'user_id' => $request->input('user')
        ])->get()->count();
        if($subjectUser){
            return back()->with('warning','Assignment already Exist Successfully');
        }else{
            $user->assignedSubjects()->attach($subject);
        }

        if ($user && $subject){
            return back()->with('success','Assignment Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    public function destroySubject($id)
    {
        $subjectUser = SubjectUser::find($id);

        if($subjectUser->delete()){
            return back()->with('success','User Remove from Subject Successfully');
        }
        return back();
    }
}
