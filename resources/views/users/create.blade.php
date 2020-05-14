@extends('layouts.dashboard')

@section('title')
    Lecturers/Teachers
@endsection

@section('description')
    Create
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
        <a href="{{ route('users.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Lecturers/Teachers</a>
        <br>
    </div>
    
    <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form for the new Lecturer/Teacher</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('users.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name of Lecturer/Teacher</label>
                            <input autocomplete="off" class="form-control" type="text" name="name" spellcheck="false" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input autocomplete="off" class="form-control" type="email" name="email" spellcheck="false" value="{{ old('email') }}">
                        </div>
                        <input type="hidden" name="role" value="lecturer">
                        <input type="hidden" name="institution" value="{{ Auth::user()->institution_id }}">
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

