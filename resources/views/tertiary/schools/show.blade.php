@extends('layouts.dashboard')

@section('title')
    Schools
@endsection

@section('description')
    View Detials
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('schools.create') }}" class="btn bg-orange btn-block margin-bottom"><i class="fa fa-plus"></i> Add New Department</a>
            <br>
            <a href="{{ route('schools.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Schools</a>
            <br>
            <a href="{{ route('schools.edit',[$school->id]) }}" class="btn bg-olive btn-block margin-bottom"><i class="fa fa-edit"></i> Edit This School</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Schools</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <h2><span class="col-md-4 text-right">Name:</span><span class="col-md-8">{{ $school->name }}</span></h2>
                        <h4><span class="col-md-4 text-right">Institution:</span><span class="col-md-8">{{ $school->institution->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">School System:</span><span class="col-md-8">{{ $school->system->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Number of Departments:</span><span class="col-md-8">{{ $school->departments()->count() }}</span></h4>
                        <h4><span class="col-md-4 text-right">Number of General Subjects:</span><span class="col-md-8">{{ $school->subjects()->count() }}</span></h4>
                        <h4><span class="col-md-4 text-right">Created By:</span><span class="col-md-8">{{ $school->user->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Created At:</span><span class="col-md-8">{{ $school->created_at }}</span></h4>
                        <h4><span class="col-md-4 text-right">Last time Updated:</span><span class="col-md-8">{{ $school->updated_at }}</span></h4>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection