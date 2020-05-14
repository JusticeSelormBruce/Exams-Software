@extends('layouts.dashboard')

@section('title')
    Courses/Subjects
@endsection

@section('description')
    View Detials
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('subjects.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Courses/Subjects</a>
            <br>
            <a href="{{ route('subjects.edit',[$subject->id]) }}" class="btn bg-olive btn-block margin-bottom"><i class="fa fa-edit"></i> Edit This Courses/Subject</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Courses/Subjects</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <h2><span class="col-md-4 text-right">Name:</span><span class="col-md-8">{{ $subject->name }}</span></h2>
                        @if($subject->code)<h4><span class="col-md-4 text-right">Code:</span><span class="col-md-8">{{ $subject->code }}</span></h4>@endif
                        <h4><span class="col-md-4 text-right">Type:</span><span class="col-md-8">
                                @if($subject->subjectable_type == 'App\Institution') {{ 'Institution\'s' }}
                                @elseif($subject->subjectable_type == 'App\School') {{ 'School\'s' }}
                                @elseif($subject->subjectable_type == 'App\Department') {{ 'Department\'s' }}
                                @endif Subject
                            </span></h4>
                        <h4><span class="col-md-4 text-right">
                                @if($subject->subjectable_type == 'App\Institution') {{ 'Institution' }}
                                @elseif($subject->subjectable_type == 'App\School') {{ 'School' }}
                                @elseif($subject->subjectable_type == 'App\Department') {{ 'Department' }}
                                @endif :
                            </span><span class="col-md-8">{{ $subject->subjectable->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Number of General Subjects:</span><span class="col-md-8">{{ $subject->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Created At:</span><span class="col-md-8">{{ $subject->created_at }}</span></h4>
                        <h4><span class="col-md-4 text-right">Last time Updated:</span><span class="col-md-8">{{ $subject->updated_at }}</span></h4>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection