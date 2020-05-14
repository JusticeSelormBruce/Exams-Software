@extends('layouts.dashboard')

@section('title')
    Administrators
@endsection

@section('description')
    Edit
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('administrators.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Administrators</a>
            <br>
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form to update the Administrator</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('administrators.update', [$user->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name of Administrator</label>
                            <input autocomplete="off" class="form-control" type="text" name="name" spellcheck="false" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input autocomplete="off" class="form-control" type="email" name="email" spellcheck="false" value="{{ $user->email }}">
                        </div>
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

