@extends('layouts.dashboard')

@section('title')
    Dashboard
@endsection

@section('description')
    Welcome
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $subjects->count() }}</h3>

                    <p>Subjects/Courses</p>
                </div>
                <div class="icon">
                    <i class="fa fa-book"></i>
                </div>
                <a href="{{ route('subjects.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $objectives->count() }}</h3>

                    <p>Objective Questions</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href="{{ route('objectives.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $theories->count() }}</h3>

                    <p>Theory Questions</p>
                </div>
                <div class="icon">
                    <i class="fa fa-file-word-o"></i>
                </div>
                <a href="{{ route('theories.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $exam->count() }}</h3>

                    <p>Examinations</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calculator"></i>
                </div>
                <a href="{{ route('exam') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-8">
            <div class="jumbotron" style=";outline: solid;outline-width: 1px;outline-color: skyblue">
                <h2>About</h2>
                <h4>Mon School help make Setting Questions easy. Lecturers are given to 
                    opportunity to store all their questions in a database. They can then 
                    set a full examination question or quiz within few minutes with just 
                    a click of button.
                </h4>
                <button class="btn btn-success">Learn More</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Quick Info
                </div>
                <div class="panel-body">
                    <h4>Assigned Courses/Subjects <span class="label label-info pull-right">{{ Auth::user()->assignedSubjects()->count() }}</span></h4>
                    <ul>
                    @foreach(Auth::user()->assignedSubjects as $sub)
                        <li>{{ $sub->name }}</li>
                    @endforeach
                    </ul>
                </div>
        </div>
    </div>
@endsection
