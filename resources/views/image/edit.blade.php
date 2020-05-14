@extends('layouts.dashboard')

@section('title')
    Image
@endsection

@section('description')
    Edit
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
                    <div class="box-title">Fill the form to update Image Name</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('image.update', [$image->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input autocomplete="off" class="form-control" type="text" name="name" spellcheck="false" value="{{ $image->name }}">
                        </div>
                        <img class="img-responsive" src="{{ url('') }}<?= '/' ?>{{ $image->url }}">
                    </div>
                    <div class="box-footer">
                        <div class="col-md-4 pull-right">
                            <button class="btn btn-success btn-block" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

