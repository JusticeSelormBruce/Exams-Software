@extends('layouts.dashboard')

@section('style')
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea.box',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen media',
                'save table contextmenu directionality emoticons template paste textcolor',
                'tiny_mce_wiris table'
            ],
            toolbar1: 'bold italic underline strikethrough | styleselect fontsizeselect | alignleft ' +
            'aligncenter alignright alignjustify | bullist numlist outdent indent | undo redo',
            toolbar2: 'tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry tiny_mce_wiris_CAS | table | link image',
            statusbar: false,
            menubar: false,
            height: 250,
            //external_plugins: { tiny_mce_wiris: 'https://www.wiris.net/demo/plugins/tiny_mce/plugin.js' }
        });
    </script>
@endsection

@section('title')
    Theory Questions
@endsection

@section('description')
    Edit
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('theory.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Theory Questions</a>
            <br>
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form to Update Question</div>
                    <div>Topic : {{ $theory->topic->name }} | Course/Subject : {{ $theory->topic->subject->name }}</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('theory.update', [$theory->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Difficulty level</label>
                            <select name="difficulty" class="form-control">
                                <option value="">Please Select</option>
                                <option @if($theory->difficulty == 'easy') {{ 'selected' }} @endif value="easy">Easy</option>
                                <option @if($theory->difficulty == 'moderate') {{ 'selected' }} @endif value="moderate">Moderate</option>
                                <option @if($theory->difficulty == 'hard') {{ 'selected' }} @endif value="hard">Hard</option>
                                <option @if($theory->difficulty == 'unclassified') {{ 'selected' }} @endif value="unclassified">Unclassified</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Question</label>
                            <textarea class="form-control box" name="question" id="question">{!! $theory->question !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">Answer</label>
                            <textarea class="form-control box" name="answer" id="answer">{!! $theory->answer !!}</textarea>
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
    <script src="{{ asset('tinymce/plugins/tiny_mce_wiris/integration/WIRISplugins.js') }}"><script>
@endsection

