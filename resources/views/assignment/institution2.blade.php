@extends('layouts.dashboard')

@section('title')
    Assignment
@endsection

@section('description')
    Institutions and Lecturers/Teachers
@endsection

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="box-title">Info Box</div>
            </div>
            <div id="info" class="box-body">
                <p>Information of Lecturer/Teacher will be displayed here.</p>
            </div>
            <div class="box-footer">
                footer
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="box-title">Assign Lecturer/Teacher to Institution</div>
            </div>
            @include('partials.errors')
            <form action="{{ url('/assignment') }}" method="POST">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="system">Administrator</label>
                        <select class="form-control" name="user" id="user">
                            <option value="">Please Select a Lecturer/Teacher</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if(old('user') == $user->id) {{ 'selected' }} @endif>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Institution</label>
                        <select class="form-control" name="institution" id="institution">
                            <option value="">Please Select an Institution</option>
                            @foreach($institutions as $institution)
                                <option value="{{ $institution->id }}" @if(old('institution') == $institution->id) {{ 'selected' }} @endif>{{ $institution->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-md-4 pull-right">
                        <button class="btn btn-success btn-block" type="submit">Assign</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('#user').change(function () {
                var user = $(this).val();

                if(user){
                    $('#info').load('{{ url("ajax/user") }}' + '/' + user);
                }
            });

        })
    </script>
@endsection
