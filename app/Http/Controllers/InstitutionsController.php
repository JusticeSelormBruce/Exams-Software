<?php

namespace App\Http\Controllers;

use App\Mail\InstitutionInvite;
use App\Institution;
use App\System;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class InstitutionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = Institution::all();
        return view('institutions.index', ['institutions' => $institutions ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $systems = System::where('type', 'general')->get();
        return view('institutions.create', ['systems' => $systems]);
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
            'address' => 'required',
            'type' => 'required',
            'email' => 'required|unique:institutions',
            'system' => 'required'
        ]);

        $institution = Institution::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'type' => $request->input('type'),
            'system_id' => $request->input('system')
        ]);
        $length = rand(8, 10);
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        if ($institution){
            Mail::to($institution->email)->send(new InstitutionInvite($institution, $str));
			$user = User::create([
                'name' => 'Admin',
                'email' => $request->input('email'),
                'password' => bcrypt($str),
                'role' => 'admin',
                'institution_id' => $institution->id
            ]);
            
            return redirect()->route('institutions.show', [$institution->id])->with('success','Institution Created Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function show(Institution $institution)
    {
        return view('institutions.show', ['institution' => $institution]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function edit(Institution $institution)
    {
        $systems = System::where('type', 'general')->get();
        return view('institutions.edit', ['institution' => $institution, 'systems' => $systems]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Institution $institution)
    {
        $validatedRequest = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('institutions')->ignore($institution->id)
            ],
            'name' => 'required',
            'address' => 'required',
            'type' => 'required',
            'system' => 'required'
        ])->validate();

        $updatedInstitution = $institution->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'type' => $request->input('type'),
            'system_id' => $request->input('system')
        ]);

        if($updatedInstitution){
            return redirect()->route('institutions.show',[$institution->id])->with('success','Institution Updated Successfully');
        }
        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institution $institution)
    {
        if($institution->delete()){
            return redirect()->route('institutions.index')->with('success','Institution Deleted Successfully');
        }
        return back();
    }
}
