@extends('layouts.dashboard')

@section('title')
    School Systems
@endsection

@section('description')
    Create
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
        <a href="{{ route('systems.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All School Systems</a>
        <br>
    </div>
    
    <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form for the new School System</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('systems.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name of School System</label>
                            <input autocomplete="off" id="name" class="form-control" type="text" name="name" spellcheck="false" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="4" class="form-control" name="description" spellcheck="false">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Type of System</label>
                            <select name="type" class="form-control">
                                <option value="">Please select a type</option>
                                <option value="general" @if(old('type') == 'general') {{ 'selected' }} @endif>General</option>
                                <option value="specific" @if(old('type') == 'specific') {{ 'selected' }} @endif>Specific</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>System for</label>
                            <select name="for" class="form-control">
                                <option value="">Please select a type</option>
                                <option value="tertiary" @if(old('for') == 'tertiary') {{ 'selected' }} @endif>Tertiary</option>
                                <option value="secondary" @if(old('for') == 'secondary') {{ 'selected' }} @endif>Secondary</option>
                                <option value="basic" @if(old('for') == 'basic') {{ 'selected' }} @endif>Primary & JHS</option>
                                <option value="jhs" @if(old('for') == 'jhs') {{ 'selected' }} @endif>JHS</option>
                                <option value="primary" @if(old('for') == 'primary') {{ 'selected' }} @endif>Primary</option>
                            </select>
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

