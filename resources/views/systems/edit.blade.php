@extends('layouts.dashboard')

@section('title')
    School Systems
@endsection

@section('description')
    Edit
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('systems.create') }}" class="btn bg-orange btn-block margin-bottom"><i class="fa fa-plus"></i> Add New Year</a>
            <br>
            <a href="{{ route('systems.create') }}" class="btn bg-orange btn-block margin-bottom"><i class="fa fa-plus"></i> Add New Semester/Term</a>
            <br>
            <a href="{{ route('systems.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All School Systems</a>
            <br>
        </div>
        @include('partials.errors')
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form to update the School System</div>
                </div>

                <form action="{{ route('systems.update', [$system->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name of School System</label>
                            <input autocomplete="off" id="name" class="form-control" type="text" name="name" value="{{ $system->name }}" spellcheck="false">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="4" class="form-control" name="description" spellcheck="false">{{ $system->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Type of System</label>
                            <select name="type" class="form-control">
                                <option value="">Please select a type</option>
                                <option value="general" @if($system->type == 'general') {{ 'selected' }} @endif>General</option>
                                <option value="specific" @if($system->type == 'specific') {{ 'selected' }} @endif>Specific</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Type of System</label>
                            <select name="for" class="form-control">
                                <option value="">Please select a type</option>
                                <option value="tertiary" @if($system->for == 'tertiary') {{ 'selected' }} @endif>Tertiary</option>
                                <option value="secondary" @if($system->for == 'secondary') {{ 'selected' }} @endif>Secondary</option>
                                <option value="basic" @if($system->for == 'basic') {{ 'selected' }} @endif>Primary & JHS</option>
                                <option value="jhs" @if($system->for == 'jhs') {{ 'selected' }} @endif>JHS</option>
                                <option value="primary" @if($system->for == 'primary') {{ 'selected' }} @endif>Primary</option>
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

