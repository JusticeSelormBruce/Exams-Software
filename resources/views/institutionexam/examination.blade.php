@extends('layouts.dashboard')

@section('style')
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#header',
            toolbar: 'bold | italic | underline | strikethrough | alignleft | ' +
            'aligncenter | alignright | alignjustify  | undo redo | styleselect |' +
            ' fontsizeselect | subscript | blockquote',
            statusbar: false,
            menubar: false,
            height: 300
        });

        var secNo = 0;

    </script>
    <script>
        var topics = @json($topics);
        var exam = @json($exam);
        var objectives = @json($objectives);
        var theories = @json($theories);
    </script>

    <style>
        .modal-dialog{
            width: 80%;
        }
    </style>
@endsection

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
                    <div class="box-title">Examination</div>
                </div>
                @include('partials.errors')
                <div class="box-body">
                    <form id="examform" action="{{ url('exams/store') }}" METHOD="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="subject" value="{{ $subject->id }}">
                        <div class="modal modal-default fade" id="header-modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Page Header</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Page Header</label>
                                            <textarea id="header" name="header">
                                                <h1 style="text-align: center;">{{ $institution->name }}</h1>
                                                @if($category == 'term')
                                                <h3 style="text-align: center;">{{ $year->name }}: {{ $semester->name }} <?= date("Y") ?> Academic Year</h3>
                                                @else
                                                    <h3 style="text-align: center;">Mock Examination <?= date("Y") ?></h3>
                                                @endif
                                                <h3 style="text-align: center;">{{ $subject->code }} @if($subject->code):@endif {{ $subject->name }}</h3>
                                                <h4>INSTRUCTIONS: <span style="text-decoration: underline;">{{ $instruction }}</span></h4>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn bg-orange" data-toggle="modal" data-target="#header-modal">
                                    <i class="fa fa-eye"></i> Preview Examination Question Header
                                </button>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Total Number Of Questions</span>
                                    <input autocomplete="off" id="total" type="number" class="form-control">
                                    <span class="input-group-btn">
                                        <button id="section" class="btn btn-primary" type="button"><i class="fa fa-thumbs-up"></i> Endose</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div id="content" class="col-md-12">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        @if($exam == 'objective' || $exam == 'both')<li class="active"><a href="#tab_1" data-toggle="tab">Objectives</a></li>@endif
                                        @if($exam == 'theory' || $exam == 'both')<li @if($exam == 'theory') class="active" @endif><a href="#tab_2" data-toggle="tab">Theory</a></li>@endif
                                    </ul>
                                    <div class="tab-content">
                                        @if($exam == 'objective' || $exam == 'both')
                                        <div class="tab-pane active" id="tab_1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Total Number Of Questions for Objectives</span>
                                                        <input autocomplete="off" id="total_a" type="number" class="form-control">
                                                        <span class="input-group-btn">
                                                            <button id="section_a" class="btn btn-primary" type="button"><i class="fa fa-thumbs-up"></i> Endose</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-md-offset-3">
                                                    <div class="dropdown">
                                                        <button id="topic_a" type="button" class="btn bg-purple btn-block dropdown-toggle"
                                                                data-toggle="dropdown"><i class="fa fa-plus"></i> Add Topic</button>
                                                        <ul class="dropdown-menu">
                                                            @foreach($topics as $topic)
                                                            <li><a href="#" onclick="getTopic('{{ $topic->id }}', 'a');">{{ $topic->name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <br>
                                            <table id="table_a" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 20px;text-align: center;">Action</th>
                                                        <th>Topic</th>
                                                        <th>Available Questions</th>
                                                        <th>No. of Question</th>
                                                        <th>Marks Per Question</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($topics as $topic)
                                                    <tr class="topic_a_all" id="topic_a_{{ $topic->id }}">
                                                        <td style="width: 20px;text-align: center;"><a onclick="removeTopic('{{ $topic->id }}','a');"><i class="fa fa-remove"></i></a></td>
                                                        <td>{{ $topic->name }}</td>
                                                        <td style="text-align: center;">{{ $objectives->where('topic_id', $topic->id)->count() }}</td>
                                                        <td><input autocomplete="off" type="number" id="no_a_{{ $topic->id }}" name="no_a_{{ $topic->id }}" class="form-control"></td>
                                                        <td><input autocomplete="off" type="number" id="marks_a_{{ $topic->id }}" name="marks_a_{{ $topic->id }}" class="form-control"></td>
                                                        <td style="text-align: center;"></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        @endif


                                        @if($exam == 'theory' || $exam == 'both')
                                        <div class="tab-pane @if($exam == 'theory') {{ 'active' }}@endif" id="tab_2">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Total Number Of Questions for Theory</span>
                                                        <input autocomplete="off" id="total_b" type="number" class="form-control">
                                                        <span class="input-group-btn">
                                                            <button id="section_b" class="btn btn-primary" type="button"><i class="fa fa-thumbs-up"></i> Endose</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-md-offset-3">
                                                    <div class="dropdown">
                                                        <button id="topic_b" type="button" class="btn bg-purple btn-block dropdown-toggle"
                                                                data-toggle="dropdown"><i class="fa fa-plus"></i> Add Topic</button>
                                                        <ul class="dropdown-menu">
                                                            @foreach($topics as $topic)
                                                                <li><a href="#" onclick="getTopic('{{ $topic->id }}', 'b');">{{ $topic->name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <br>
                                            <table id="table_b" class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th style="width: 20px;text-align: center;">Action</th>
                                                    <th>Topic</th>
                                                    <th>Available Questions</th>
                                                    <th>No. of Question</th>
                                                    <th>Marks Per Question</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($topics as $topic)
                                                    <tr class="topic_b_all" id="topic_b_{{ $topic->id }}">
                                                        <td style="width: 20px;text-align: center;"><a onclick="removeTopic('{{ $topic->id }}','b');"><i class="fa fa-remove"></i></a></td>
                                                        <td>{{ $topic->name }}</td>
                                                        <td style="text-align: center;">{{ $theories->where('topic_id', $topic->id)->count() }}</td>
                                                        <td><input autocomplete="off" type="number" id="no_b_{{ $topic->id }}" name="no_b_{{ $topic->id }}" class="form-control"></td>
                                                        <td><input autocomplete="off" type="number" id="marks_b_{{ $topic->id }}" name="marks_b_{{ $topic->id }}" class="form-control"></td>
                                                        <td style="text-align: center;"></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="box-footer">
                    <div class="col-md-4 pull-right">
                        <a id="go" onclick="verify();" class="btn btn-success btn-block">Go Generate Questions</a>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        $(function () {
            $('.topic_a_all, .topic_b_all').hide();
            $('input[type="number"]').val(0);
        });

        $(document).ready(function () {
            $('#topic_a, #topic_b, #section_a, #section_b, #total_a, #total_b').attr('disabled', true);

            $('#section').click(function () {
                var total = $('#total').val();

                if(total > 0){
                    if(total <= (objectives.length + theories.length) && exam === 'both'){
                        $('#total, #section').attr('disabled', true);
                        $('#total_a, #total_b, #section_a, #section_b').attr('disabled', false);
                    }else if(total <= objectives.length && exam === 'objective'){
                        $('#total, #section').attr('disabled', true);
                        //$('#total_a, #total_b, #section_a, #section_b').attr('disabled', false);
                        $('#total_a').val($('#total').val());
                        $('#topic_a, #topic_b').attr('disabled', false);
                    }else if(total <= theories.length && exam === 'theory'){
                        $('#total, #section').attr('disabled', true);
                        //$('#total_a, #total_b, #section_a, #section_b').attr('disabled', false);
                        $('#total_b').val($('#total').val());
                        $('#topic_a, #topic_b').attr('disabled', false)
                    }else{
                        alert('Questions asked for is more than those in the database');
                    }
                }else{
                    alert('Please Specify total number of Questions');
                }


            });

            $('#section_a').click(function () {
                var total = $('#total').val();
                var total_a = $('#total_a').val();

                if(total && total_a >= 0){
                    if(total_a <= total && exam === 'both'){
                        if(total_a <= objectives.length){
                            if((total - total_a) <= theories.length){
                                $('#total_a, #total_b, #section_a, #section_b').attr('disabled', true);
                                $('#total_b').val(total - $('#total_a').val());
                                $('#topic_a, #topic_b').attr('disabled', false);
                            }else{
                                alert('Theory Questions are not up to the remainder');
                            }
                        }else{
                            alert('Question asked for is more than those in the database');
                        }
                    }else if(total_a === total && exam === 'objective'){
                        $('#total_a, #total_b, #section_a, #section_b').attr('disabled', true);
                        $('#total_b').val(total - $('#total_a').val());
                        $('#topic_a, #topic_b').attr('disabled', false);
                    }else if(total_a <= total && exam === 'objective'){
                        alert('Question should be equal to Total');
                    }else{
                        alert('Questions cant be more than the total');
                    }
                }else{
                    alert('Please Specify the total number of question');
                }
            });

            $('#section_b').click(function () {
                var total = $('#total').val();
                var total_b = $('#total_b').val();

                if(total && total_b >= 0){
                    if(total_b <= total && exam === 'both'){
                        if(total_b <= theories.length){
                            if((total - total_b) <= objectives.length){
                                $('#total_a, #total_b, #section_a, #section_b').attr('disabled', true);
                                $('#total_a').val(total - $('#total_b').val());
                                $('#topic_a, #topic_b').attr('disabled', false);
                            }else{
                                alert('Objective Questions are not up to the remainder');
                            }
                        }else{
                            alert('Question asked for is more than those in the database');
                        }
                    }else if(total_b === total && exam === 'theory'){
                        $('#total_a, #total_b, #section_a, #section_b').attr('disabled', true);
                        $('#total_a').val(total - $('#total_b').val());
                        $('#topic_a, #topic_b').attr('disabled', false);
                    }else if(total_b <= total && exam === 'theory'){
                        alert('Question should be equal to Total');
                    }else{
                        alert('Questions cant be more than the total');
                    }
                }else{
                    alert('Please Specify the total number of question');
                }
            });

        });
    </script>
    <script>
        function getTopic(num, letter){
            $('#topic_' + letter + '_' + num).show();
        }

        function removeTopic(num, letter) {
            $('#no_' + letter + '_' + num).val(0);
            $('#marks_' + letter + '_' + num).val(0);
            $('#topic_' + letter + '_' + num).hide();
        }

        function verify() {
            var T = 0;
            var Y = 0;
            var ACheck = false;
            var BCheck = false;
            $.each(topics, function () {
                T += parseInt($('#no_a_' + this.id).val(), 10);
            });
            $.each(topics, function () {
                Y += parseInt($('#no_b_' + this.id).val(), 10);
            });

            if(T == $('#total_a').val()){
                ACheck = true;
            }
            if(Y == $('#total_b').val()){
                BCheck = true;
            }

            if(exam === 'both' && ACheck && BCheck){
                $('#examform').submit();
            }else if(exam === 'objective' && ACheck){
                $('#examform').submit();
            }else if(exam === 'theory' && BCheck){
                $('#examform').submit();
            }
        }
    </script>
@endsection

