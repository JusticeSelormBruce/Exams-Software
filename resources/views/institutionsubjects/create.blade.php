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
    Create
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
                    <div class="box-title">Fill the form for the new Subject</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('subject.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body">
                        @if(Auth::user()->role == 'superadmin')
                        <div class="form-group">
                            <label for="name">institution</label>
                            <select class="form-control" name="institution" id="institution">
                                <option value="">Please Select a institution</option>
                                @foreach($institutions as $institution)
                                <option value="{{ $institution->id }}" @if(old('institution') == $institution->id) {{ 'selected' }} @endif>{{ $institution->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @else
                            <input type="hidden" name="institution" value={{ $institutions[0]->id }}>
                        @endif
                        <div id="for_block" class="form-group">
                            <label for="for">For</label>
                            <select class="form-control" name="for" id="for">
                                <option value="jhs">JHS</option>
                                <option value="primary">Primary</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name of Course/Subject</label>
                            <input autocomplete="off" class="form-control" type="text" name="name" spellcheck="false" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="code">Course/Subject Code</label>
                            <input autocomplete="off" class="form-control" type="text" name="code" spellcheck="false" value="{{ old('code') }}" placeholder="Optional">
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
        @if(Auth::user()->role == 'superadmin')
            $(function () {
                $('#for_block').hide();
            });
        @else
            if(institutions[0].type == 'basic'){
                $('#for_block').show();
            }else{
                $('#for_block').hide();
            }
        @endif
        

        $(document).ready(function () {

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

