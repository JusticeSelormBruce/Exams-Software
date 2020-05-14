@extends('layouts.dashboard')

@section('title')
    Institutions
@endsection

@section('description')
    Edit
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('institutions.create') }}" class="btn bg-orange btn-block margin-bottom"><i class="fa fa-plus"></i> Add New School</a>
            <br>
            <a href="{{ route('institutions.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Institutions</a>
            <br>
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form to update the Institution</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('institutions.update', [$institution->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input autocomplete="off" id="name" class="form-control" type="text" name="name" value="{{ $institution->name }}" spellcheck="false">
                        </div>
                        <div class="form-group">
                            <label for="type">Type of Institution</label>
                            <br>
                            <label for="type">
                                <input class="flat-blue" type="radio" name="type" value="tertiary" @if($institution->type == 'tertiary') {{ 'checked' }} @endif> Tertiary
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="type">
                                <input class="flat-blue" type="radio" name="type" value="secondary" @if($institution->type == 'secondary') {{ 'checked' }} @endif> Secondary
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="type">
                                <input class="flat-blue" type="radio" name="type" value="basic" @if($institution->type == 'basic') {{ 'checked' }} @endif> Primary & JHS
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="type">
                                <input class="flat-blue" type="radio" name="type" value="jhs" @if($institution->type == 'jhs') {{ 'checked' }} @endif> JHS only
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="type">
                                <input class="flat-blue" type="radio" name="type" value="primary" @if($institution->type == 'primary') {{ 'checked' }} @endif> Primary only
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea rows="4" class="form-control" name="address" spellcheck="false">{{ $institution->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input autocomplete="off" class="form-control" type="email" name="email" value="{{ $institution->email }}" spellcheck="false">
                        </div>
                        <div class="form-group">
                            <label for="system">School System</label>
                            <select class="form-control" name="system">
                                <option value="">Please Select a Year System</option>
                                @foreach($systems as $system)
                                    <option value="{{ $system->id }}" @if($institution->system_id == $system->id) {{ 'selected' }} @endif>{{ $system->name }}</option>
                                @endforeach
                            </select>
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
        $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass   : 'iradio_flat-blue'
        })
    </script>
@endsection