@extends('layouts.dashboard')

@section('title')
    Topics
@endsection

@section('description')
    Create
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
        <a href="{{ route('subjects.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Topics</a>
        <br>
    </div>
    
    <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form for the new Topic</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('topics.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Topic Type</label>
                            <select class="form-control" name="type" id="type">
                                <option value="">Please Choose Subject Type</option>
                                <option value="institution">Institution's Course/Subject</option>
                                <option value="school">School's Course/Subject</option>
                                <option value="department">Department's Course/Subject</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="institution">Institution</label>
                            <select class="form-control" name="institution" id="institution">
                                <option value="">Please Select an Institution</option>
                                @foreach($institutions as $institution)
                                <option value="{{ $institution->id }}" @if(old('institution') == $institution->id) {{ 'selected' }} @endif>{{ $institution->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="school">School</label>
                            <select class="form-control" name="school" id="school">
                                <option value="">Please Select a School</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <select class="form-control" name="department" id="department">
                                <option value="">Please Select a Department</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select class="form-control" name="subject" id="subject">
                                <option value="">Please Select a Subject</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name of Topic</label>
                            <input autocomplete="off" class="form-control" type="text" name="name" spellcheck="false" value="{{ old('name') }}">
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
    <script>

    </script>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#type').change(function () {
                var type = $(this).val();

                if(type){
                    if(type === 'institution'){
                        $('#institution, #school, #department').attr('disabled', false);
                        $('#school, #department').attr('disabled', true);
                        $('#school').empty().append('<option value="">Please Select a School</option>');
                        $('#department').empty().append('<option value="">Please Select a Department</option>');
                        $('#subject').empty().append('<option value="">Please Select a Subject</option>');
                    }else if(type === 'school'){
                        $('#institution, #school, #department').attr('disabled', false);
                        $('#department').attr('disabled', true);
                        $('#school').empty().append('<option value="">Please Select a School</option>');
                        $('#department').empty().append('<option value="">Please Select a Department</option>');
                        $('#subject').empty().append('<option value="">Please Select a Subject</option>');
                    }else if(type === 'department'){
                        $('#institution, #school, #department').attr('disabled', false);
                        $('#school').empty().append('<option value="">Please Select a School</option>');
                        $('#department').empty().append('<option value="">Please Select a Department</option>');
                        $('#subject').empty().append('<option value="">Please Select a Subject</option>');
                    }else{
                        $('#institution, #school, #department').attr('disabled', true);
                        $('#school').empty().append('<option value="">Please Select a School</option>');
                        $('#department').empty().append('<option value="">Please Select a Department</option>');
                        $('#subject').empty().append('<option value="">Please Select a Subject</option>');
                    }


                }
            });

            $('#institution').change(function () {
                var institution = $(this).val();
                var type = $('#type').val();

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
                    }).fail(function () {
                        alert('The Page fail to reach the server');
                    });

                    if(type === 'institution'){
                        $.ajax({
                            url: '../../ajax/subjecti/' + institution,
                            type: 'GET',
                            dataType: 'json'
                        }).done(function (data) {
                            $('#subject').empty().append('<option value="">Please Select a Subject</option>');
                            $.each(data, function () {
                                $('#subject').append('<option value="'+ this.id +'" >' + this.name + '</option>');
                            })
                        }).fail(function () {
                            alert('The Page fail to reach the server');
                        });
                    }
                }else {
                    $('#school').empty();
                }
            });

            $('#school').change(function () {
                var school = $(this).val();
                var type = $('#type').val();

                if(school){
                    $.ajax({
                        url: '../../ajax/departments/' + school,
                        type: 'GET',
                        dataType: 'json'
                    }).done(function (data) {
                        $('#department').empty().append('<option value="">Please Select a Department</option>');
                        $.each(data, function () {
                            $('#department').append('<option value="'+ this.id +'" >' + this.name + '</option>');
                        })
                    }).fail(function () {
                        alert('The Page fail to reach the server');
                    });

                    if(type === 'school'){
                        $.ajax({
                            url: '../../ajax/subjects/' + school,
                            type: 'GET',
                            dataType: 'json'
                        }).done(function (data) {
                            $('#subject').empty().append('<option value="">Please Select a Subject</option>');
                            $.each(data, function () {
                                $('#subject').append('<option value="'+ this.id +'" >' + this.name + '</option>');
                            })
                        }).fail(function () {
                            alert('The Page fail to reach the server');
                        });
                    }
                }else {
                    $('#department').empty();
                }
            });


            $('#department').change(function () {
                var department = $(this).val();
                var type = $('#type').val();

                if(department){
                    if(type === 'department'){
                        $.ajax({
                            url: '../../ajax/subjectd/' + department,
                            type: 'GET',
                            dataType: 'json'
                        }).done(function (data) {
                            $('#subject').empty().append('<option value="">Please Select a Subject</option>');
                            $.each(data, function () {
                                $('#subject').append('<option value="'+ this.id +'" >' + this.name + '</option>');
                            })
                        }).fail(function () {
                            alert('The Page fail to reach the server');
                        });
                    }
                }
            });
        })
    </script>
@endsection

