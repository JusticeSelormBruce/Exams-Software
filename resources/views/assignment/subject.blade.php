@extends('layouts.dashboard')

@section('title')
    Assignment
@endsection

@section('description')
    Courses and Lecturers
@endsection

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Info Box</div>
                </div>
                <div id="info" class="box-body">
                    <p>Information of Lecturer will be displayed here.</p>
                </div>
                <div class="box-footer">
                    footer
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Assign Lecturer to Course(s)</div>
                </div>
                @include('partials.errors')
                <form action="{{ url('/assignment2') }}" method="POST">
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
                            <label for="subject">Course</label>
                            <select class="form-control" name="subject" id="subject">
                                <option value="">Please Select a Subject</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="system">Lecturer</label>
                            <select class="form-control" name="user" id="user">
                                <option value="">Please Select a Lecturer/Teacher</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" @if(old('user') == $user->id) {{ 'selected' }} @endif>{{ $user->name }}</option>
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
    <script>

    </script>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#user').change(function () {
                var user = $(this).val();

                if(user){
                    $('#info').load('{{ url("ajax/user2") }}' + '/' + user);
                }
            });

            $('#institution').change(function () {
                var institution = $(this).val();

                if(institution){
                    $.ajax({
                        url: '{{ url("ajax/lecturer") }}' + '/' + institution,
                        type: 'GET',
                        dataType: 'json'
                    }).done(function (data) {
                        $('#user').empty().append('<option value="">Please Select a Lecturer/Teacher</option>');
                        $.each(data, function () {
                            $('#user').append('<option value="'+ this.id +'" >' + this.name + '</option>');
                        })
                    }).fail(function () {
                        alert('The Page fail to reach the server');
                    });
                }
            });

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
                        url: '{{ url("ajax/schools") }}' + '/' + institution,
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
                            url: '{{ url("ajax/subjecti") }}' + '/' + institution,
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
                        url: '{{ url("ajax/departments") }}' + '/' + school,
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
                            url: '{{ url("ajax/subjects") }}' + '/' + school,
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
                            url: '{{ url("ajax/subjectd") }}' + '/' + department,
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

