@extends('layouts.app')
<br><br><br>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8" style="color: white;">
            <h1 style="font-size: 6em;"><b>Real Innovations</b></h1>
            <h3 style="font-size: 3em;text-align: center;"><b>Auto-exsett<br> (Automated Examination Setter)</b></h3>
        </div>
        <div class="col-md-4">
            <div style="background: rgba(40,120,85,.9);" class="panel panel-primary">

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <label for="email" class="control-label" style="color: white;">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="user@domain.com">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <label for="password" class="control-label" style="color: white;">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required placeholder="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label style="color: black;text-align: left;color: white;">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>

                                <a style="color: red;" class="btn btn-link pull-right" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
