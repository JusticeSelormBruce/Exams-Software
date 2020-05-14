@extends('layouts.dashboard')

@section('title')
    Examinations
@endsection

@section('description')
    Setup
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form to create Objective Questions for a particular topic</div>
                </div>
                @include('partials.errors')
                <div class="box-body">
                    <form id="form" action="{{ url('exam/examination') }}" method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Course/Subject Type</label>
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
                                <label for="school">Exam Category</label>
                                <select class="form-control" name="category" id="category">
                                    <option value="">Please Select a Category</option>
                                    <option value="mock">Mock</option>
                                    <option value="term">Term</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="institution">Year</label>
                                <select class="form-control" name="year" id="year">
                                    <option value="">Please Select a Year</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="institution">Semester</label>
                                <select class="form-control" name="semester" id="semester">
                                    <option value="">Please Select a Semester</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="school">Exam Type</label>
                                <select class="form-control" name="exam" id="exam">
                                    <option value="">Please Select a School</option>
                                    <option value="objective">Objectives Only</option>
                                    <option value="theory">Theory Only</option>
                                    <option value="both">Both Objective and Theory</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="school">Difficulty Level</label>
                                <select class="form-control" name="difficulty" id="difficulty">
                                    <option value="">Select One</option>
                                    <option value="mix">Choose Mixed Difficulty</option>
                                    <option value="specify">Let me Specify Difficulty level</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="school">Examiner</label>
                                <select class="form-control" name="examiner" id="examiner">
                                    <option value="">Please Select an Examiner</option>
                                    <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>General instruction</label>
                                <textarea class="form-control" placeholder="Eg. Answer All Questions" id="header" name="header"></textarea>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="box-footer">
                    <div class="col-md-4 pull-right">
                        <a id="go" class="btn btn-success btn-block">Go Generate Questions</a>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#go').click(function () {
                var type = $('#type').val();
                var institution = $('#institution').val();
                var school = $('#school').val();
                var department = $('#department').val();
                var subject = $('#subject').val();
                var year = $('#year').val();
                var semester = $('#semester').val();
                var exam = $('#exam').val();
                var category = $('#category').val();
                var difficulty = $('#difficulty').val();
                var examiner = $('#examiner').val();
                var header = $('#header').val();

                if(examiner && category && difficulty && exam && semester && year && subject && type && header){
                    if(type === 'institution' && institution){
                        $('#form').submit();
                    }else if(type === 'school' && school && institution){
                        $('#form').submit();
                    }else if(type === 'department' && department && school && institution){
                        $('#form').submit();
                    }else{
                        alert('Almost done, check that every thing is right');
                    }
                }else{
                    alert('Please fill the form Correctly');
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

                        $.ajax({
                            url: '../../ajax/yeari/' + institution,
                            type: 'GET',
                            dataType: 'json'
                        }).done(function (data) {
                            $('#year').empty().append('<option value="">Please Select a Year</option>');
                            $.each(data, function () {
                                $('#year').append('<option value="'+ this.id +'" >' + this.name + '</option>');
                            })
                        }).fail(function () {
                            alert('The Page fail to reach the server');
                        });

                        $.ajax({
                            url: '../../ajax/semesteri/' + institution,
                            type: 'GET',
                            dataType: 'json'
                        }).done(function (data) {
                            $('#semester').empty().append('<option value="">Please Select a Semester</option>');
                            $.each(data, function () {
                                $('#semester').append('<option value="'+ this.id +'" >' + this.name + '</option>');
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



                    if(type !== 'institution'){
                        $.ajax({
                            url: '../../ajax/years/' + school,
                            type: 'GET',
                            dataType: 'json'
                        }).done(function (data) {
                            $('#year').empty().append('<option value="">Please Select a Year</option>');
                            $.each(data, function () {
                                $('#year').append('<option value="'+ this.id +'" >' + this.name + '</option>');
                            })
                        }).fail(function () {
                            alert('The Page fail to reach the server');
                        });

                        $.ajax({
                            url: '../../ajax/semesters/' + school,
                            type: 'GET',
                            dataType: 'json'
                        }).done(function (data) {
                            $('#semester').empty().append('<option value="">Please Select a Semester</option>');
                            $.each(data, function () {
                                $('#semester').append('<option value="'+ this.id +'" >' + this.name + '</option>');
                            })
                        }).fail(function () {
                            alert('The Page fail to reach the server');
                        });
                    }



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

            $('#subject').change(function () {
                var subject = $(this).val();

                if(subject){

                }
            });

            $('#topic').change(function () {
                var topic = $(this).val();

                if(topic){
                    $('#go').attr('href', '/objectives/create/' + topic);
                }
            });


        });
    </script>
@endsection

