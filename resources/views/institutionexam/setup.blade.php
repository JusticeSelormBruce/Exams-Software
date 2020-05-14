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
                    <div class="box-title">Fill the form to Set Examination Questions</div>
                </div>
                @include('partials.errors')
                <div class="box-body">
                    <form id="form" action="{{ url('exams/examination') }}" method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="institution">Institution</label>
                                <select class="form-control" name="institution" id="institution">
                                    <option value="">Please Select Institution</option>
                                    @foreach($institutions as $institution)
                                        <option value="{{ $institution->id }}" @if(old('institution') == $institution->id) {{ 'selected' }} @endif>{{ $institution->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select class="form-control" name="subject" id="subject">
                                    <option value="">Please Select a Subject</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="school">Exam Type</label>
                                <select class="form-control" name="exam" id="exam">
                                    <option value="">Please Select a Type</option>
                                    <option value="objective">Objectives Only</option>
                                    <option value="theory">Theory Only</option>
                                    <option value="both">Both Objective and Theory</option>
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
                                <label for="school">Difficulty Level</label>
                                <select class="form-control" name="difficulty" id="difficulty">
                                    <option value="">Select One</option>
                                    <option value="mix">Choose Mixed Difficulty</option>
                                    <option value="specify">Let me Specify Difficulty level</option>
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
                var institution = $('#institution').val();
                var subject = $('#subject').val();
                var year = $('#year').val();
                var semester = $('#semester').val();
                var exam = $('#exam').val();
                var category = $('#category').val();
                var difficulty = $('#difficulty').val();
                var header = $('#header').val();

                if(difficulty && category && exam && semester && year && subject && header){
                    $('#form').submit();
                }else{
                    alert('Please fill the form Correctly');
                }

            });

            $('#institution').change(function () {
                var institution = $(this).val();
				
				var AL = '{{ url("ajax/allsubjects") }}' + '/' + institution;
                $.ajax({
                    url: AL,
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
				
				var AY = '{{ url("ajax/yeari") }}' + '/' + institution;
                $.ajax({
                    url: AY,
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
				
				var AS = '{{ url("ajax/semesteri") }}' + '/' + institution;
                $.ajax({
                    url: AS,
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
            });

        });
    </script>
@endsection

