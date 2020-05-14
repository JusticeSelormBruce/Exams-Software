@extends('layouts.dashboard')

@section('title')
    Schools
@endsection

@section('description')
    Create
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
        <a href="{{ route('schools.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Schools</a>
        <br>
    </div>
    
    <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form for the new School</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('schools.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body">
                        @if(Auth::user()->role == "superadmin")
                        <div class="form-group">
                            <label for="name">Institution</label>
                            <select class="form-control" name="institution">
                                <option value="">Please Select an Institution</option>
                                @foreach($institutions as $institution)
                                <option value="{{ $institution->id }}" @if(old('institution') == $institution->id) {{ 'selected' }} @endif>{{ $institution->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @else
                            <input type="hidden" name="institution" value="{{ $institutions[0]->id }}">
                        @endif
                        <div class="form-group">
                            <label for="name">Name of School</label>
                            <input autocomplete="off" class="form-control" type="text" name="name" spellcheck="false" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="system">School System</label>
                            <select class="form-control" name="system">
                                <option value="">Please Select a Year System</option>
                                @foreach($systems as $system)
                                    <option value="{{ $system->id }}" @if(old('system') == $system->id) {{ 'selected' }} @endif>{{ $system->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
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

