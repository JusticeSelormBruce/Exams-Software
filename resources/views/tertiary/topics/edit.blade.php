@extends('layouts.dashboard')

@section('title')
    Topics
@endsection

@section('description')
    Edit
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('topics.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Topics</a>
            <br>
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form to update the Course/Subject</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('topics.update', [$topic->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Course/Subject Type</label>
                            <select class="form-control" name="type" id="type">
                                <option value="">Please Choose Subject Type</option>
                                <option value="institution" @if($topic->subject->subjectable_type == 'App\Institution') {{ 'selected' }} @endif>Institution's Course/Subject</option>
                                <option value="school" @if($topic->subject->subjectable_type == 'App\School') {{ 'selected' }} @endif>School's Course/Subject</option>
                                <option value="department" @if($topic->subject->subjectable_type == 'App\Department') {{ 'selected' }} @endif>Department's Course/Subject</option>
                            </select>
                        </div>
                        @if($topic->subject->subjectable_type == 'App\Institution')
                        <div class="form-group">
                            <label for="name">Institution</label>
                            <select class="form-control" name="institution" id="institution">
                                <option value="">Please Select an Institution</option>
                                @foreach($institutions as $institution)
                                    <option value="{{ $institution->id }}" @if($topic->subject->subjectable->id == $institution->id) {{ 'selected' }} @endif>{{ $institution->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="system">School</label>
                            <select class="form-control" name="school" id="school">
                                <option value="">Please Select a School</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Department</label>
                            <select class="form-control" name="department" id="department">
                                <option value="">Please Select a Department</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select class="form-control" name="subject" id="subject">
                                <option value="">Please Select a Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" @if($topic->subject->id == $subject->id) {{ 'selected' }} @endif>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @elseif($topic->subject->subjectable_type == 'App\School')
                        <div class="form-group">
                            <label for="name">Institution</label>
                            <select class="form-control" name="institution" id="institution">
                                <option value="">Please Select an Institution</option>
                                @foreach($institutions as $institution)
                                    <option value="{{ $institution->id }}" @if($topic->subject->subjectable->institution_id == $institution->id) {{ 'selected' }} @endif>{{ $institution->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="system">School</label>
                            <select class="form-control" name="school" id="school">
                                <option value="">Please Select a School</option>
                                @foreach($schools as $school)
                                    <option value="{{ $school->id }}" @if($topic->subject->subjectable->id == $school->id) {{ 'selected' }} @endif>{{ $school->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Department</label>
                            <select class="form-control" name="department" id="department">
                                <option value="">Please Select a Department</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select class="form-control" name="subject" id="subject">
                                <option value="">Please Select a Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" @if($topic->subject->id == $topic->subject->id) {{ 'selected' }} @endif>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @elseif($topic->subject->subjectable_type == 'App\Department')
                        <div class="form-group">
                            <label for="name">Institution</label>
                            <select class="form-control" name="institution" id="institution">
                                <option value="">Please Select an Institution</option>
                                @foreach($institutions as $institution)
                                    <option value="{{ $institution->id }}" @if($topic->subject->subjectable->school->institution->id == $institution->id) {{ 'selected' }} @endif>{{ $institution->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="system">School</label>
                            <select class="form-control" name="school" id="school">
                                <option value="">Please Select a School</option>
                                @foreach($schools as $school)
                                    <option value="{{ $school->id }}" @if($topic->subject->subjectable->school_id == $school->id) {{ 'selected' }} @endif>{{ $school->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Department</label>
                            <select class="form-control" name="department" id="department">
                                <option value="">Please Select a Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" @if($topic->subject->subjectable->id == $department->id) {{ 'selected' }} @endif>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select class="form-control" name="subject" id="subject">
                                <option value="">Please Select a Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" @if($topic->subject->id == $topic->subject->id) {{ 'selected' }} @endif>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @else
                            <div class="form-group">
                                <label for="name">Institution</label>
                                <select class="form-control" name="institution" id="institution">
                                    <option value="">Please Select an Institution</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="system">School</label>
                                <select class="form-control" name="school" id="school">
                                    <option value="">Please Select a School</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Department</label>
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
                        @endif
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input autocomplete="off" class="form-control" type="text" name="name" spellcheck="false" value="{{ $topic->name }}">
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
            if($('#type').val() === 'institution'){
                $('#institution, #school, #department').attr('disabled', false);
                $('#school, #department').attr('disabled', true);
            }else if($('#type').val() === 'school'){
                $('#institution, #school, #department').attr('disabled', false);
                $('#department').attr('disabled', true);
            }else if($('#type').val() === 'department'){
                $('#institution, #school, #department').attr('disabled', false);
            }else{
                $('#institution, #school, #department').attr('disabled', true);
            }

            $('#type').change(function () {
                var type = $(this).val();

                if(type){
                    if(type === 'institution'){
                        $('#institution, #school, #department').attr('disabled', false);
                        $('#school, #department').attr('disabled', true);
                        $('#school').empty().append('<option value="">Please Select a School</option>');
                        $('#department').empty().append('<option value="">Please Select a Department</option>');
                    }else if(type === 'school'){
                        $('#institution, #school, #department').attr('disabled', false);
                        $('#department').attr('disabled', true);
                        $('#school').empty().append('<option value="">Please Select a School</option>');
                        $('#department').empty().append('<option value="">Please Select a Department</option>');
                    }else if(type === 'department'){
                        $('#institution, #school, #department').attr('disabled', false);
                        $('#school').empty().append('<option value="">Please Select a School</option>');
                        $('#department').empty().append('<option value="">Please Select a Department</option>');
                    }else{
                        $('#institution, #school, #department').attr('disabled', true);
                        $('#school').empty().append('<option value="">Please Select a School</option>');
                        $('#department').empty().append('<option value="">Please Select a Department</option>');
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

