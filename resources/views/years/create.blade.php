@extends('layouts.dashboard')

@section('style')
<script>
    var systems = @json($systems);
</script>
@endsection

@section('title')
    Years
@endsection

@section('description')
    Create
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
        <a href="{{ route('years.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Years</a>
        <br>
    </div>
    
    <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form for the new Year</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('years.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>School System</label>
                            <select class="form-control" name="system" id="system">
                                <option value="">Please select School System</option>
                                @foreach($systems as $system)
                                    <option value="{{ $system->id }}" @if(old('system') == $system->id) {{ 'selected' }} @endif
                                    @if($systemDefault == $system->id) {{ 'selected' }} @endif>{{ $system->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="for_block" class="form-group">
                            <label for="for">For</label>
                            <select class="form-control" name="for" id="for">
                                <option value="jhs">JHS</option>
                                <option value="primary">Primary</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name of Year</label>
                            <input autocomplete="off" id="name" class="form-control" type="text" name="name" spellcheck="false" value="{{ old('name') }}">
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

@endsection

@section('script')
    <script>
        $(function () {
            $('#for_block').hide();
        });

        $(document).ready(function () {
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
