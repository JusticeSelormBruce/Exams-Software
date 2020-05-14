@extends('layouts.dashboard')

@section('title')
    Lecturers/Teachers
@endsection

@section('description')
    View Details
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('users.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Lecturer/Teachers</a>
            <br>
            <a href="{{ route('users.edit',[$user->id]) }}" class="btn bg-olive btn-block margin-bottom"><i class="fa fa-edit"></i> Edit This Lecturer/Teacher</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Lecturers/Teachers</h3>
                </div>
                <div class="box-body">
                    <div class="row" style="text-space: 50px">
                        <h2><span class="col-md-4 text-right">Name:</span><span class="col-md-8">{{ $user->name }}</span></h2>
                        <h4><span class="col-md-4 text-right">Email:</span><span class="col-md-8">{{ $user->email }}</span></h4>
                        <h4><span class="col-md-4 text-right">Number of Schools:</span><span class="col-md-8">{{ $user->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Created By:</span><span class="col-md-8">{{ $user->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Created At:</span><span class="col-md-8">{{ $user->created_at }}</span></h4>
                        <h4><span class="col-md-4 text-right">Last time Edited:</span><span class="col-md-8">{{ $user->updated_at }}</span></h4>
                    </div>
                    <div class="col-md-3">

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection