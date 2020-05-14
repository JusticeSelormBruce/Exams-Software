@extends('layouts.dashboard')

@section('title')
    Images
@endsection

@section('description')
    Add
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
        <a href="{{ route('image.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Images</a>
        <br>
    </div>
    
    <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form to add a new Image</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input autocomplete="off" class="form-control" type="file" name="image" spellcheck="false" value="{{ old('image') }}">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input autocomplete="off" class="form-control" type="text" name="name" spellcheck="false" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-md-4 pull-right">
                            <button class="btn btn-success btn-block" type="submit">Add</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>

@endsection

