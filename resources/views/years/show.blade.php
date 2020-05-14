@extends('layouts.dashboard')

@section('title')
    Years
@endsection

@section('description')
    View Detials
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('years.create') }}" class="btn bg-orange btn-block margin-bottom"><i class="fa fa-plus"></i> Add New Year</a>
            <br>
            <a href="{{ route('years.create') }}" class="btn bg-orange btn-block margin-bottom"><i class="fa fa-plus"></i> Add New Semester/Term</a>
            <br>
            <a href="{{ route('years.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Years</a>
            <br>
            <a href="{{ route('years.edit',[$year->id]) }}" class="btn bg-olive btn-block margin-bottom"><i class="fa fa-edit"></i> Edit This Year</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Years</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <h2><span class="col-md-4 text-right">Name:</span><span class="col-md-8">{{ $year->name }}</span></h2>
                        <h4><span class="col-md-4 text-right">System:</span><span class="col-md-8">{{ $year->system->name }}</span></h4>
                        <h4><span class="col-md-4 text-right">Created At:</span><span class="col-md-8">{{ $year->created_at }}</span></h4>
                        <h4><span class="col-md-4 text-right">Last time Edited:</span><span class="col-md-8">{{ $year->updated_at }}</span></h4>
                    </div>
                    <div class="col-md-3">

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection