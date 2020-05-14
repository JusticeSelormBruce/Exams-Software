@extends('layouts.dashboard')

@section('title')
    Departments
@endsection

@section('description')
    Edit
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('departments.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Departments</a>
            <br>
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form to update the Department</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('departments.update',[$department->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="box-body">
                        @if(Auth::user()->role == 'superadmin')
                        <div class="form-group">
                            <label for="name">Institution</label>
                            <select class="form-control" name="institution" id="institution">
                                <option value="">Please Select an Institution</option>
                                @foreach($institutions as $institution)
                                    <option value="{{ $institution->id }}" @if($department->school->institution->id == $institution->id) {{ 'selected' }} @endif>{{ $institution->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="form-group">
                            @if(Auth::user()->role == 'admin')
                                <input type="hidden" name="institution" value="{{ $department->school->institution->id }}">
                            @endif
                            <label for="system">School</label>
                            <select class="form-control" name="school" id="school">
                                <option value="">Please Select a School</option>
                                @foreach($schools as $school)
                                    <option value="{{ $school->id }}" @if($department->school->id == $school->id) {{ 'selected' }} @endif>{{ $school->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name of Department</label>
                            <input autocomplete="off" class="form-control" type="text" name="name" spellcheck="false" value="{{ $department->name }}">
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

@section('script')
    <script>
        $(document).ready(function () {
            $('#institution').change(function () {
                var institution = $(this).val();

                if(institution){
                    $.ajax({
                        url: '../../ajax/schools/' + institution,
                        type: 'GET',
                        dataType: 'json'
                    }).done(function (data) {
                        $('#school').empty().append('<option value="">Please Select a School</option>');
                        $.each(data, function () {
                            $('#school').append('<option value="'+ this.id +'" >' + this.name + '</option>');
                        })
                        console.log(data);
                    }).fail(function () {
                        alert('The Page fail to reach the server');
                    })
                }else {
                    $('#school').empty();
                }
            });
        })
    </script>
@endsection

