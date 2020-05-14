@extends('layouts.dashboard')

@section('title')
    Topics
@endsection

@section('description')
    View Detials
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('topics.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Topics</a>
            <br>
            <a href="{{ route('topics.edit',[$topic->id]) }}" class="btn bg-olive btn-block margin-bottom"><i class="fa fa-edit"></i> Edit This Topic</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Topics</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <h2><span class="col-md-4 text-right">Name:</span><span class="col-md-8">{{ $topic->name }}</span></h2>
                        <h4><span class="col-md-4 text-right">Subject:</span><span class="col-md-8">{{ $topic->subject->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Subject Type:</span><span class="col-md-8">
                                @if($topic->subject->subjectable_type == 'App\Institution') {{ 'Institution\'s' }}
                                @elseif($topic->subject->subjectable_type == 'App\School') {{ 'School\'s' }}
                                @elseif($topic->subject->subjectable_type == 'App\Department') {{ 'Department\'s' }}
                                @endif Subject
                            </span></h4>
                        <h4><span class="col-md-4 text-right">
                                @if($topic->subject->subjectable_type == 'App\Institution') {{ 'Institution' }}
                                @elseif($topic->subject->subjectable_type == 'App\School') {{ 'School' }}
                                @elseif($topic->subject->subjectable_type == 'App\Department') {{ 'Department' }}
                                @endif :
                            </span><span class="col-md-8">{{ $topic->subject->subjectable->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Created At:</span><span class="col-md-8">{{ $topic->created_at }}</span></h4>
                        <h4><span class="col-md-4 text-right">Last time Updated:</span><span class="col-md-8">{{ $topic->updated_at }}</span></h4>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection