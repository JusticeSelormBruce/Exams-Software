@extends('layouts.dashboard')

@section('title')
    Image
@endsection

@section('description')
    View Details
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('image.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Images</a>
            <br>
            <a href="{{ route('image.edit',[$image->id]) }}" class="btn bg-olive btn-block margin-bottom"><i class="fa fa-edit"></i> Edit This Image</a>
            <br>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Image</h3>
                </div>
                <div class="box-body">
                    <div class="row" style="text-space: 50px">
                        <h2><span class="col-md-4 text-right">Name:</span><span class="col-md-8">{{ $image->name }}</span></h2>
                        <h4><span class="col-md-4 text-right">Image:</span><span class="col-md-8"><img class="img-responsive" src="{{ url('') }}<?= '/' ?>{{ $image->url }}"></span></h4>
                        <h4><span class="col-md-4 text-right">Created At:</span><span class="col-md-8">{{ $image->created_at }}</span></h4>
                        <h4><span class="col-md-4 text-right">Last time Edited:</span><span class="col-md-8">{{ $image->updated_at }}</span></h4>
                    </div>
                    <div class="col-md-3">

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection