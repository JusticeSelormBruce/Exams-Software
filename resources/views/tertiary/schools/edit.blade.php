@extends('layouts.dashboard')

@section('title')
    Schools
@endsection

@section('description')
    Edit
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('schools.create') }}" class="btn bg-orange btn-block margin-bottom"><i class="fa fa-plus"></i> Add New Department</a>
            <br>
            <a href="{{ route('schools.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Schools</a>
            <br>
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form to update the School</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('schools.update', [$school->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="box-body">
                        @if(Auth::user()->role == "superadmin")
                        <div class="form-group">
                            <label for="name">Institution</label>
                            <select class="form-control" name="institution">
                                <option value="">Please Select an Institution</option>
                                @foreach($institutions as $institution)
                                    <option value="{{ $institution->id }}" @if($school->institution->id == $institution->id) {{ 'selected' }} @endif
                                    >{{ $institution->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @else
                            <input type="hidden" name="institution" value="{{ $school->institution->id }}">
                        @endif
                        <div class="form-group">
                            <label for="name">Name of School</label>
                            <input autocomplete="off" class="form-control" type="text" name="name" spellcheck="false" value="{{ $school->name }}">
                        </div>
                        <div class="form-group">
                            <label for="system">School System</label>
                            <select class="form-control" name="system">
                                <option value="">Please Select a Year System</option>
                                @foreach($systems as $system)
                                    <option value="{{ $system->id }}" @if($school->system->id == $system->id) {{ 'selected' }} @endif>{{ $system->name }}</option>
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

