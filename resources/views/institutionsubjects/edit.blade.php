@extends('layouts.dashboard')

@section('style')
<script>
    var institutions = @json($institutions);
</script>
@endsection

@section('title')
    Subjects
@endsection

@section('description')
    Edit
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('subject.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Subjects</a>
            <br>
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form to update the Subject</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('subject.update', [$subject->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="box-body">
                        @if(Auth::user()->role == 'superadmin')
                        <div class="form-group">
                            <label for="name">Institution</label>
                            <select class="form-control" name="institution" id="institution">
                                <option value="">Please Select an Institution</option>
                                @foreach($institutions as $institution)
                                    <option value="{{ $institution->id }}" @if($institution->id == $subject->subjectable_id) {{ 'selected' }} @endif>{{ $institution->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @else
                            <input type="hidden" name="institution" value={{ $institutions[0]->id }}>
                        @endif
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
            @if(Auth::user()->role == 'superadmin')
            var rd = $('#institution').val();

            var temp = institutions.filter(function (obj) {
                    return obj.id == rd;
                });
            if(temp[0].type == 'basic'){
                $('#for_block').show();
            }else{
                $('#for_block').hide();
            }
            @else
            if(institutions[0].type == 'basic'){
                $('#for_block').show();
            }else{
                $('#for_block').hide();
            }
            @endif
            $('#institution').change(function () {
                var sys = $(this).val();

                var result = institutions.filter(function (obj) {
                    return obj.id == sys;
                });
                
                if(result[0].type == 'basic'){
                    $('#for_block').show();
                }else{
                    $('#for_block').hide();
                }
            });

        })
    </script>
@endsection

