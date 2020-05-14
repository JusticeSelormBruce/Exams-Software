@extends('layouts.dashboard')

@section('style')
<script>
    var systems = @json($systems);
</script>
@endsection

@section('title')
    System Subjects
@endsection

@section('description')
    Edit
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('system-subjects.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Subjects</a>
            <br>
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form to update the Subject</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('system-subjects.update', [$subject->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">System</label>
                            <select class="form-control" name="system" id="system">
                                <option value="">Please Select a System</option>
                                @foreach($systems as $system)
                                    <option value="{{ $system->id }}" @if($system->id == $subject->subjectable_id) {{ 'selected' }} @endif>{{ $system->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="for_block" class="form-group">
                            <label for="for">For</label>
                            <select class="form-control" name="for" id="for">
                                <option value="jhs" @if($subject->for == 'jhs') {{ 'selected' }} @endif>JHS</option>
                                <option value="primary" @if($subject->for == 'jhs') {{ 'selected' }} @endif>Primary</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name of Course/Subject</label>
                            <input autocomplete="off" class="form-control" type="text" name="name" spellcheck="false" value="{{ $subject->name }}">
                        </div>
                        <div class="form-group">
                            <label for="code">Course/Subject Code</label>
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

@endsection

@section('script')
    <script>
        $(function () {
            $('#for_block').hide();
        });

        $(document).ready(function () {
            var rd = $('#system').val();

            var temp = systems.filter(function (obj) {
                    return obj.id == rd;
                });
            if(temp[0].for == 'basic'){
                $('#for_block').show();
            }else{
                $('#for_block').hide();
            }

            $('#system').change(function () {
                var sys = $(this).val();

                var result = systems.filter(function (obj) {
                    return obj.id == sys;
                });
                
                if(result[0].for == 'basic'){
                    $('#for_block').show();
                }else{
                    $('#for_block').hide();
                }
            });

        })
    </script>
@endsection

