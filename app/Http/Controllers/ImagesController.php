<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'superadmin'){
            $images = Image::all();
        }else{
            $images = Image::where('user_id', Auth::user()->id)->get();
        }
        return view('image.index', ['images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required'
        ]);

        $pic = $request->file('image');

        $length = rand(8, 10);
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        $picname = $str.$pic->getClientOriginalName();
        if($pic->move('examimages', $picname)){
            $image = Image::create([
                'name' => $request->name,
                'url' => 'examimages/'.$picname,
                'user_id' => Auth::user()->id
            ]);
            if($image){
                return redirect()->route('image.show', [$image->id])->with('success', 'Image Add Successfully');
            }
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return view('image.show', ['image' => $image]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        return view('image.edit', ['image' => $image]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        $validatedRequest = $request->validate([
            'name' => 'required'
        ]);

        $UpdatedImage = $image->update([
            'name' => $request->input('name')
        ]);

        if($UpdatedImage){
            return redirect()->route('image.show',[$image->id])->with('success', 'Image Updated Successfully');
        }

        return back()->withInput($request->input())->withErrors($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $pic = public_path().'/'.$image->url;
        if(file_exists($pic)){
            echo 'yeah';
            @unlink($pic);
        }else{
            echo 'lol';
        }
        if($image->delete()){
            return redirect()->route('image.index')->with('success','Image Deleted Successfully');
        }
        return back();
    }
}
