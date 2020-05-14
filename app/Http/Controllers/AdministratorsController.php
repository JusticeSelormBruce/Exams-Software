<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AdministratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 'admin')->get();
        return view('administrators.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrators.create');
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
            'role' => 'required',
            'email' => 'required|unique:users',
            'created_by' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'role' => $request->input('role'),
            'email' => $request->input('email'),
            'created_by' => $request->input('created_by'),
            'password' => bcrypt($request->input('password'))
        ]);
        if ($user){
            return redirect()->route('administrators.show', [$user->id])->with('success','Administrator Created Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $user = User::find($user);
        return view('administrators.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $user = User::find($user);
        return view('administrators.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $user = User::find($user);
        $validatedRequest = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'name' => 'required'
        ])->validate();

        $updatedUser = $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);

        if($updatedUser){
            return redirect()->route('administrators.show',[$user->id])->with('success','Administrator Updated Successfully');
        }
        return back()->withInput($request->input())->withErrors($validatedRequest);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user = User::find($user);
        if($user->delete()){
            return redirect()->route('administrators.index')->with('success','Administrator Deleted Successfully');
        }
        return back();
    }
}
