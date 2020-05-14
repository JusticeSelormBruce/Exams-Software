@extends('layouts.dashboard')

@section('title')
    System Subjects
@endsection

@section('description')
    View Detials
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('system-subjects.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Subjects</a>
            <br>
            <a href="{{ route('system-subjects.edit',[$subject->id]) }}" class="btn bg-olive btn-block margin-bottom"><i class="fa fa-edit"></i> Edit This Subject</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Subjects</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <h2><span class="col-md-4 text-right">Name:</span><span class="col-md-8">{{ $subject->name }}</span></h2>
                        @if($subject->code)<h4><span class="col-md-4 text-right">Code:</span><span class="col-md-8">{{ $subject->code }}</span></h4>@endif
                        <h4><span class="col-md-4 text-right">For:</span><span class="col-md-8">{{ $subject->subjectable->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Created At:</span><span class="col-md-8">{{ $subject->created_at }}</span></h4>
                        <h4><span class="col-md-4 text-right">Last time Updated:</span><span class="col-md-8">{{ $subject->updated_at }}</span></h4>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection