@extends('layouts.dashboard')

@section('title')
    Institutions
@endsection

@section('description')
    Create
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
        <a href="{{ route('institutions.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Institutions</a>
        <br>
    </div>
    
    <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form for the new Institution</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('institutions.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name of Institution</label>
                            <input autocomplete="off" id="name" class="form-control" type="text" name="name" spellcheck="false" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="type">Type of Institution</label>
                            <br>
                            <label for="type">
                                <input class="flat-blue" type="radio" name="type" value="tertiary" @if(old('type') == 'tertiary') {{ 'checked' }} @endif> Tertiary
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="type">
                                <input class="flat-blue" type="radio" name="type" value="secondary" @if(old('type') == 'secondary') {{ 'checked' }} @endif> Secondary
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="type">
                                <input class="flat-blue" type="radio" name="type" value="basic" @if(old('type') == 'basic') {{ 'checked' }} @endif> Primary & JHS
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="type">
                                <input class="flat-blue" type="radio" name="type" value="jhs" @if(old('type') == 'jhs') {{ 'checked' }} @endif> JHS only
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="type">
                                <input class="flat-blue" type="radio" name="type" value="primary" @if(old('type') == 'primary') {{ 'checked' }} @endif> Primary only
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea rows="4" class="form-control" name="address" spellcheck="false">{{ old('address') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input autocomplete="off" class="form-control" type="email" name="email" spellcheck="false" value="{{ old('email')}}">
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
        $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass   : 'iradio_flat-blue'
        })
    </script>
@endsection

