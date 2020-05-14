@extends('layouts.dashboard')

@section('title')
    Institutions
@endsection

@section('description')
    View Detials
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('institutions.create') }}" class="btn bg-orange btn-block margin-bottom"><i class="fa fa-plus"></i> Add New School</a>
            <br>
            <a href="{{ route('institutions.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Institutions</a>
            <br>
            <a href="{{ route('institutions.edit',[$institution->id]) }}" class="btn bg-olive btn-block margin-bottom"><i class="fa fa-edit"></i> Edit This Institution</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Institutions</h3>
                </div>
                <div class="box-body">
                    <div class="row" style="text-space: 50px">
                        <h2><span class="col-md-4 text-right">Name:</span><span class="col-md-8">{{ $institution->name }}</span></h2>
                        <h4><span class="col-md-4 text-right">Address:</span><span class="col-md-8">{{ $institution->address }}</span></h4>
                        <h4><span class="col-md-4 text-right">Email:</span><span class="col-md-8">{{ $institution->email }}</span></h4>
                        <h4><span class="col-md-4 text-right">Number of Schools:</span><span class="col-md-8">{{ $institution->schools()->count() }}</span></h4>
                        <h4><span class="col-md-4 text-right">Created At:</span><span class="col-md-8">{{ $institution->created_at }}</span></h4>
                        <h4><span class="col-md-4 text-right">Last time Edited:</span><span class="col-md-8">{{ $institution->updated_at }}</span></h4>
                    </div>
                    <div class="col-md-3">

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection