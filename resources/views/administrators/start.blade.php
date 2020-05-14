@extends('layouts.app')

@section('content')
<br><br><br>
<div class="container">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-primary" style="background: rgba(40,120,85,.9);">
            <div class="panel-heading">
            Institution Administrator
            </div>
            <div class="panel-body">
                <form>
                    <div class="form-group">
                        <input autocomplete="off" class="form-control" type="text" name="name" placeholder="Name of Administrator">
                    </div>
                    <div class="form-group">
                        <input autocomplete="off" class="form-control" type="text" name="email" placeholder="Email of Administrator">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
