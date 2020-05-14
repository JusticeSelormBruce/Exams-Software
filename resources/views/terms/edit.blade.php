@extends('layouts.dashboard')

@section('style')
<script>
    var systems = @json($systems);
</script>
@endsection

@section('title')
    Terms
@endsection

@section('description')
    Edit
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('terms.create') }}" class="btn bg-orange btn-block margin-bottom"><i class="fa fa-plus"></i> Add New Term</a>
            <br>
            <a href="{{ route('terms.create') }}" class="btn bg-orange btn-block margin-bottom"><i class="fa fa-plus"></i> Add New Semester/Term</a>
            <br>
            <a href="{{ route('terms.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Terms</a>
            <br>
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form to update the Term</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('terms.update',[$term->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="box-body">
                        <div class="form-group">
                            <label>School System</label>
                            <select class="form-control" name="system" id="system">
                                <option value="">Please select Term</option>
                                @foreach($systems as $system)
                                    <option value="{{ $system->id }}" @if($system->id == $term->system_id) {{ 'selected' }} @endif>{{ $system->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="for_block" class="form-group">
                            <label for="for">For</label>
                            <select class="form-control" name="for" id="for">
                                <option value="jhs" @if($system->for == 'jhs') {{ 'selected' }} @endif>JHS</option>
                                <option value="primary" @if($system->for == 'jhs') {{ 'selected' }} @endif>Primary</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name of Term</label>
                            <input autocomplete="off" id="name" class="form-control" type="text" name="name" value="{{ $term->name }}" spellcheck="false">
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

