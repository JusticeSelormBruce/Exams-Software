@extends('layouts.dashboard')

@section('title')
    Profile
@endsection

@section('description')
    View
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
                    <div class="box-title">Fill the form to Change Password</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('profile.savepass') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="image">Old Password</label>
                            <input autocomplete="off" class="form-control" type="password" minlength="6" name="oldpassword" spellcheck="false" value="{{ old('oldpassword') }}">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input autocomplete="off" class="form-control" type="password" minlength="6" name="newpassword" spellcheck="false" value="{{ old('newpassword') }}">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input autocomplete="off" class="form-control" type="password" minlength="6" name="confirmpassword" spellcheck="false" value="{{ old('confirmpassword') }}">
                        </div>
                        <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
                    </div>
                    <div class="box-footer">
                        <div class="col-md-4 pull-right">
                            <button class="btn btn-success btn-block" type="submit">Modify</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>

@endsection