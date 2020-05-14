@extends('layouts.dashboard') @section('title') Courses @endsection @section('description') Edit @endsection @section('content')

<div class="row">
    <div class="col-md-3">
        <a href="{{ route('subjects.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Courses</a>
        <br>
    </div>

    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="box-title">Fill the form to update the Course</div>
            </div>
            @include('partials.errors')
            <form action="{{ route('subjects.update', [$subject->id]) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Course Type</label>
                        <select class="form-control" name="type" id="type">
                                <option value="">Please Choose Course Type</option>
                                <option value="institution" @if($subject->subjectable_type == 'App\Institution') {{ 'selected' }} @endif>Institution's Course</option>
                                <option value="school" @if($subject->subjectable_type == 'App\School') {{ 'selected' }} @endif>School's Course</option>
                                <option value="department" @if($subject->subjectable_type == 'App\Department') {{ 'selected' }} @endif>Department's Course</option>
                            </select>
                    </div>
                    @if($subject->subjectable_type == 'App\Institution') @if (Auth::user()->role == 'superadmin')
                    <div class="form-group">
                        <label for="name">Institution</label>
                        <select class="form-control" name="institution" id="institution">
                                <option value="">Please Select an Institution</option>
                                @foreach($institutions as $institution)
                                    <option value="{{ $institution->id }}" @if($subject->subjectable->id == $institution->id) {{ 'selected' }} @endif>{{ $institution->name }}</option>
                                @endforeach
                            </select>
                    </div>
                    @else
                    <input type="hidden" name="institution" value="{{ $institutions[0]->id }}" id="institution"> @endif
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
                    @elseif($subject->subjectable_type == 'App\School') @if (Auth::user()->role == 'superadmin')
                    <div class="form-group">
                        <label for="name">Institution</label>
                        <select class="form-control" name="institution" id="institution">
                                <option value="">Please Select an Institution</option>
                                @foreach($institutions as $institution)
                                    <option value="{{ $institution->id }}" @if($subject->subjectable->institution_id == $institution->id) {{ 'selected' }} @endif>{{ $institution->name }}</option>
                                @endforeach
                            </select>
                    </div>
                    @else
                    <input type="hidden" name="institution" value="{{ $institutions[0]->id }}" id="institution"> @endif
                    <div class="form-group">
                        <label for="system">School</label>
                        <select class="form-control" name="school" id="school">
                                <option value="">Please Select a School</option>
                                @foreach($schools as $school)
                                    <option value="{{ $school->id }}" @if($subject->subjectable->id == $school->id) {{ 'selected' }} @endif>{{ $school->name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Department</label>
                        <select class="form-control" name="department" id="department">
                                <option value="">Please Select a Department</option>
                            </select>
                    </div>
                    @elseif($subject->subjectable_type == 'App\Department') @if (Auth::user()->role == 'superadmin')
                    <div class="form-group">
                        <label for="name">Institution</label>
                        <select class="form-control" name="institution" id="institution">
                                <option value="">Please Select an Institution</option>
                                @foreach($institutions as $institution)
                                    <option value="{{ $institution->id }}" @if($subject->subjectable->school->institution->id == $institution->id) {{ 'selected' }} @endif>{{ $institution->name }}</option>
                                @endforeach
                            </select>
                    </div>
                    @else
                    <input type="hidden" name="institution" value="{{ $institutions[0]->id }}" id="institution"> @endif
                    <div class="form-group">
                        <label for="system">School</label>
                        <select class="form-control" name="school" id="school">
                                <option value="">Please Select a School</option>
                                @foreach($schools as $school)
                                    <option value="{{ $school->id }}" @if($subject->subjectable->school_id == $school->id) {{ 'selected' }} @endif>{{ $school->name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Department</label>
                        <select class="form-control" name="department" id="department">
                                <option value="">Please Select a Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" @if($subject->subjectable->id == $department->id) {{ 'selected' }} @endif>{{ $department->name }}</option>
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
                    @endif
                    <div class="form-group">
                        <label for="name">Name of Course</label>
                        <input autocomplete="off" class="form-control" type="text" name="name" spellcheck="false" value="{{ $subject->name }}">
                    </div>
                    <div class="form-group">
                        <label for="code">Course Code</label>
                        <input autocomplete="off" class="form-control" type="text" name="code" spellcheck="false" value="{{ $subject->code }}" placeholder="Optional">
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

@endsection @section('script')
<script>
    $(document).ready(function() {
        if ($('#type').val() === 'institution') {
            $('#institution, #school, #department').attr('disabled', false);
            $('#school, #department').attr('disabled', true);
        } else if ($('#type').val() === 'school') {
            $('#institution, #school, #department').attr('disabled', false);
            $('#department').attr('disabled', true);
        } else if ($('#type').val() === 'department') {
            $('#institution, #school, #department').attr('disabled', false);
        } else {
            $('#institution, #school, #department').attr('disabled', true);
        }

        $('#type').change(function() {
            var type = $(this).val();

            if (type) {
                if (type === 'institution') {
                    $('#institution, #school, #department').attr('disabled', false);
                    $('#school, #department').attr('disabled', true);
                    @if(Auth::user()->role == 'superadmin')
                    $('#school').empty().append('<option value="">Please Select a School</option>');
                    @endif
                    $('#department').empty().append('<option value="">Please Select a Department</option>');
                } else if (type === 'school') {
                    $('#institution, #school, #department').attr('disabled', false);
                    $('#department').attr('disabled', true);
                    @if(Auth::user()->role == 'superadmin')
                    $('#school').empty().append('<option value="">Please Select a School</option>');
                    @endif
                    $('#department').empty().append('<option value="">Please Select a Department</option>');
                } else if (type === 'department') {
                    $('#institution, #school, #department').attr('disabled', false);
                    @if(Auth::user()->role == 'superadmin')
                    $('#school').empty().append('<option value="">Please Select a School</option>');
                    @endif
                    $('#department').empty().append('<option value="">Please Select a Department</option>');
                } else {
                    $('#institution, #school, #department').attr('disabled', true);
                    @if(Auth::user()->role == 'superadmin')
                    $('#school').empty().append('<option value="">Please Select a School</option>');
                    @endif
                    $('#department').empty().append('<option value="">Please Select a Department</option>');
                }
            }
        });

        $('#institution').change(function() {
            var institution = $(this).val();

            if (institution) {
                $.ajax({
                    url: '../../ajax/schools/' + institution,
                    type: 'GET',
                    dataType: 'json'
                }).done(function(data) {
                    $('#school').empty().append('<option value="">Please Select a School</option>');
                    $.each(data, function() {
                        $('#school').append('<option value="' + this.id + '" >' + this.name + '</option>');
                    })
                }).fail(function() {
                    alert('The Page fail to reach the server');
                });

            } else {
                $('#school').empty();
            }
        });

        $('#school').change(function() {
            var school = $(this).val();

            if (school) {
                $.ajax({
                    url: '../../ajax/departments/' + school,
                    type: 'GET',
                    dataType: 'json'
                }).done(function(data) {
                    $('#department').empty().append('<option value="">Please Select a Department</option>');
                    $.each(data, function() {
                        $('#department').append('<option value="' + this.id + '" >' + this.name + '</option>');
                    })
                }).fail(function() {
                    alert('The Page fail to reach the server');
                });

            } else {
                $('#department').empty();
            }
        });
    })
</script>
@endsection