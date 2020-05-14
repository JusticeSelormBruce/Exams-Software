@extends('layouts.dashboard')

@section('style')
    <style>
        img{
            max-width: 100%;
            height: auto;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.3/MathJax.js?config=TeX-MML-AM_CHTML" async></script>
@endsection

@section('title')
    Objective Questions
@endsection

@section('description')
    View Detials
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('objective.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Objective Questions</a>
            <br>
            <a href="{{ route('objective.edit',[$objective->id]) }}" class="btn bg-olive btn-block margin-bottom"><i class="fa fa-edit"></i> Edit This Objective Question</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Objective Questions</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <h4><span class="col-md-4 text-right">Question:</span><span class="col-md-8">{!! $objective->question !!}</span></h4>
                        <h4><span class="col-md-4 text-right">A:</span><span class="col-md-8">{!! $objective->a !!}</span></h4>
                        <h4><span class="col-md-4 text-right">B:</span><span class="col-md-8">{!! $objective->b !!}</span></h4>
                        @if($objective->c)<h4><span class="col-md-4 text-right">C:</span><span class="col-md-8">{!! $objective->c !!}</span></h4>@endif
                        @if($objective->d)<h4><span class="col-md-4 text-right">D:</span><span class="col-md-8">{!! $objective->d !!}</span></h4>@endif
                        @if($objective->e)<h4><span class="col-md-4 text-right">E:</span><span class="col-md-8">{!! $objective->e !!}</span></h4>@endif
                        <h4><span class="col-md-4 text-right">Answer:</span><span class="col-md-8">{{ strtoupper($objective->answer) }}</span></h4>
                        <h4><span class="col-md-4 text-right">Topic:</span><span class="col-md-8">{{ $objective->topic->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Subject Type:</span><span class="col-md-8">
                                @if($objective->topic->subject->subjectable_type == 'App\Institution') {{ 'Institution\'s' }}
                                @elseif($objective->topic->subject->subjectable_type == 'App\School') {{ 'School\'s' }}
                                @elseif($objective->topic->subject->subjectable_type == 'App\Department') {{ 'Department\'s' }}
                                @endif Subject
                            </span></h4>
                        <h4><span class="col-md-4 text-right">
                                @if($objective->topic->subject->subjectable_type == 'App\Institution') {{ 'Institution' }}
                                @elseif($objective->topic->subject->subjectable_type == 'App\School') {{ 'School' }}
                                @elseif($objective->topic->subject->subjectable_type == 'App\Department') {{ 'Department' }}
                                @endif :
                            </span><span class="col-md-8">{{ $objective->topic->subject->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Created At:</span><span class="col-md-8">{{ $objective->created_at }}</span></h4>
                        <h4><span class="col-md-4 text-right">Last time Updated:</span><span class="col-md-8">{{ $objective->updated_at }}</span></h4>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection