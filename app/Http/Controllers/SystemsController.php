<?php

namespace App\Http\Controllers;

use App\System;
use Illuminate\Http\Request;

class SystemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $systems = System::all();
        return view('systems.index',['systems' => $systems]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('systems.create');
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
            'description' => 'required',
            'type' => 'required',
            'for' => 'required'
        ]);

        $system = System::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => $request->input('user_id'),
            'type' => $request->input('type'),
            'for' => $request->input('for')
        ]);

        if($system){
            return redirect()->route('systems.show',[$system->id])->with('success', 'School System Created Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\System  $system
     * @return \Illuminate\Http\Response
     */
    public function show(System $system)
    {
        return view('systems.show',['system' => $system]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\System  $system
     * @return \Illuminate\Http\Response
     */
    public function edit(System $system)
    {
        return view('systems.edit', ['system' => $system]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\System  $system
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, System $system)
    {
        $validatedRequest = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required'
        ]);

        $UpdatedSystem = $system->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'type' => $request->input('type')
        ]);

        if($UpdatedSystem){
            return redirect()->route('systems.show', [$system->id])->with('success', 'School System Updated Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\System  $system
     * @return \Illuminate\Http\Response
     */
    public function destroy(System $system)
    {
        if($system->delete()){
            return redirect()->route('systems.index')->with('success','School System Deleted Successfully');
        }
        return back();
    }
}
