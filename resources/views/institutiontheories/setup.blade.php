@extends('layouts.dashboard')

@section('title')
    Theory Questions
@endsection

@section('description')
    Setup
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('theory.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Theory Questions</a>
            <br>
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form to create Theory Questions for a partitcular topic</div>
                </div>
                @include('partials.errors')
                    <div class="box-body">
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
                            <label for="subject">Subject</label>
                            <select class="form-control" name="subject" id="subject">
                                <option value="">Please Select a Subject</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="year">Year</label>
                            <select class="form-control" name="year" id="year">
                                <option value="">Please Select a Year</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="term">Term</label>
                            <select class="form-control" name="term" id="term">
                                <option value="">Please Select a Term</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="topic">Topic</label>
                            <select class="form-control" name="topic" id="topic">
                                <option value="">Please Select a Topic</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-md-4 pull-right">
                            <a id="go" class="btn btn-success btn-block">Go Set Questions</a>
                        </div>
                    </div>

            </div>
        </div>
    </div>


@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#institution').change(function () {
            var institution = $(this).val();

            var AL = '{{ url("ajax/allsubjects")}}' + '/'+ institution 
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

            var YI = '{{ url("ajax/yeari") }}' + '/' + institution;
            $.ajax({
                url: YI,
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

            var SI = '{{ url("ajax/semesteri") }}' + '/' + institution;
            $.ajax({
                url: SI,
                type: 'GET',
                dataType: 'json'
            }).done(function (data) {
                $('#term').empty().append('<option value="">Please Select a Term</option>');
                $.each(data, function () {
                    $('#term').append('<option value="'+ this.id +'" >' + this.name + '</option>');
                })
            }).fail(function () {
                alert('The Page fail to reach the server');
            });
        });

        $('#subject, #year, #term').change(function () {
            var subject = $('#subject').val();
            var year = $('#year').val();
            var term = $('#term').val();

            var SA = '{{ url("ajax/topics") }}' + '/' + subject + '/' + year + '/' + term;
            if(subject){
                $.ajax({
                    url: SA,
                    type: 'GET',
                    dataType: 'json'
                }).done(function (data) {
                    $('#topic').empty().append('<option value="">Please Select a Topic</option>');
                    $.each(data, function () {
                        $('#topic').append('<option value="'+ this.id +'" >' + this.name + '</option>');
                    })
                }).fail(function () {
                    //alert('The Page fail to reach the Topic server');
                });
            }
        });

        $('#topic').change(function () {
            var topic = $(this).val();

            var FN = '{{ url("theory/create") }}' + '/' + topic;
            if(topic){
                $('#go').attr('href', FN);
            }
        });


    });
</script>
@endsection

