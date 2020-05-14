@extends('layouts.dashboard')

@section('title')
    Departments
@endsection

@section('description')
    View Detials
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('departments.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Departments</a>
            <br>
            <a href="{{ route('departments.edit',[$department->id]) }}" class="btn bg-olive btn-block margin-bottom"><i class="fa fa-edit"></i> Edit This Department</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Departments</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <h2><span class="col-md-4 text-right">Name:</span><span class="col-md-8">{{ $department->name }}</span></h2>
                        <h4><span class="col-md-4 text-right">School:</span><span class="col-md-8">{{ $department->school->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Institution:</span><span class="col-md-8">{{ $department->school->institution->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Number of General Subjects:</span><span class="col-md-8">{{ $department->subjects()->count() }}</span></h4>
                        <h4><span class="col-md-4 text-right">Created By:</span><span class="col-md-8">{{ $department->school->user->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Created At:</span><span class="col-md-8">{{ $department->created_at }}</span></h4>
                        <h4><span class="col-md-4 text-right">Last time Updated:</span><span class="col-md-8">{{ $department->updated_at }}</span></h4>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection