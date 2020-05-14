@extends('layouts.dashboard')

@section('title')
    School Systems
@endsection

@section('description')
    View Detials
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="../../years/create/{{ $system->id }}" class="btn bg-orange btn-block margin-bottom"><i class="fa fa-plus"></i> Add New Year</a>
            <br>
            <a href="../../terms/create/{{ $system->id }}" class="btn bg-orange btn-block margin-bottom"><i class="fa fa-plus"></i> Add New Semester/Term</a>
            <br>
            <a href="{{ route('systems.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All School Systems</a>
            <br>
            <a href="{{ route('systems.edit',[$system->id]) }}" class="btn bg-olive btn-block margin-bottom"><i class="fa fa-edit"></i> Edit This School System</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">School Systems</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <h2><span class="col-md-4 text-right">Name:</span><span class="col-md-8">{{ $system->name }}</span></h2>
                        <h4><span class="col-md-4 text-right">Description:</span><span class="col-md-8">{{ $system->description }}</span></h4>
                        <h4><span class="col-md-4 text-right">Years:</span><span class="col-md-8">{{ $system->years()->count() }}</span></h4>
                        <h4><span class="col-md-4 text-right">Semester/Term:</span><span class="col-md-8">{{ $system->terms()->count() }}</span></h4>
                        <h4><span class="col-md-4 text-right">Number of Schools Using:</span><span class="col-md-8">{{ $system->schools()->count() }}</span></h4>
                        <h4><span class="col-md-4 text-right">Created At:</span><span class="col-md-8">{{ $system->created_at }}</span></h4>
                        <h4><span class="col-md-4 text-right">Last time Edited:</span><span class="col-md-8">{{ $system->updated_at }}</span></h4>
                    </div>
                    <div class="col-md-3">

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection