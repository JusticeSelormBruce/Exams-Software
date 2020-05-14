@extends('layouts.dashboard')

@section('title')
    Administrators
@endsection

@section('description')
    Create
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
                    <div class="box-title">Fill the form for the new Administrator</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('administrators.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name of Administrator</label>
                            <input autocomplete="off" class="form-control" type="text" name="name" spellcheck="false" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input autocomplete="off" class="form-control" type="email" name="email" spellcheck="false" value="{{ old('email') }}">
                        </div>
                        <input type="hidden" name="role" value="admin">
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label>Password</label>
                            <input autocomplete="off" class="form-control" type="password" name="password">
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-md-4 pull-right">
                            <button class="btn btn-success btn-block" type="submit">Create</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>

@endsection

