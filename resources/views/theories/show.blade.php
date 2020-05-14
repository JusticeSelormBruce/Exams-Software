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
    Theory Questions
@endsection

@section('description')
    View Detials
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('theories.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Theory Questions</a>
            <br>
            <a href="{{ route('theories.edit',[$theory->id]) }}" class="btn bg-olive btn-block margin-bottom"><i class="fa fa-edit"></i> Edit This Theory Question</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Theory Questions</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <h4><span class="col-md-4 text-right">Question:</span><span class="col-md-8">{!! $theory->question !!}</span></h4>
                        <h4><span class="col-md-4 text-right">Answer:</span><span class="col-md-8">{!! $theory->answer !!}</span></h4>
                        <h4><span class="col-md-4 text-right">Topic:</span><span class="col-md-8">{{ $theory->topic->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Subject Type:</span><span class="col-md-8">
                                @if($theory->topic->subject->subjectable_type == 'App\Institution') {{ 'Institution\'s' }}
                                @elseif($theory->topic->subject->subjectable_type == 'App\School') {{ 'School\'s' }}
                                @elseif($theory->topic->subject->subjectable_type == 'App\Department') {{ 'Department\'s' }}
                                @endif Subject
                            </span></h4>
                        <h4><span class="col-md-4 text-right">
                                @if($theory->topic->subject->subjectable_type == 'App\Institution') {{ 'Institution' }}
                                @elseif($theory->topic->subject->subjectable_type == 'App\School') {{ 'School' }}
                                @elseif($theory->topic->subject->subjectable_type == 'App\Department') {{ 'Department' }}
                                @endif :
                            </span><span class="col-md-8">{{ $theory->topic->subject->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Created At:</span><span class="col-md-8">{{ $theory->created_at }}</span></h4>
                        <h4><span class="col-md-4 text-right">Last time Updated:</span><span class="col-md-8">{{ $theory->updated_at }}</span></h4>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection