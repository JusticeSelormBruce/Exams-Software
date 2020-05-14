@extends('layouts.dashboard')

@section('style')
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#question',
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
        tinymce.init({
            selector: 'input.answer',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen media',
                'save table contextmenu directionality emoticons template paste textcolor',
                'tiny_mce_wiris table'
            ],
            toolbar: 'bold italic underline strikethrough | tiny_mce_wiris_formulaEditor ' + 
            'tiny_mce_wiris_formulaEditorChemistry tiny_mce_wiris_CAS | link image',
            statusbar: false,
            menubar: false,
            height: 50,
            //external_plugins: { tiny_mce_wiris: 'https://www.wiris.net/demo/plugins/tiny_mce/plugin.js' }
        });
    </script>
@endsection

@section('title')
    Objective Questions
@endsection

@section('description')
    Create
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
        <a href="{{ route('objective.index') }}" class="btn bg-purple btn-block margin-bottom"><i class="fa fa-list"></i> View All Objective Questions</a>
        <br>
    </div>
    
    <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Fill the form to Add a New Question</div>
                    <div>Topic : {{ $topic->name }} | Course/Subject : {{ $topic->subject->name }}</div>
                </div>
                @include('partials.errors')
                <form action="{{ route('objectives.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Difficulty level</label>
                            <select name="difficulty" class="form-control">
                                <option value="">Please Select</option>
                                <option value="easy">Easy</option>
                                <option value="moderate">Moderate</option>
                                <option value="hard">Hard</option>
                                <option value="unclassified">Unclassified</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Question</label>
                            <textarea class="form-control" name="question" id="question">{{ old('question') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">Answer Options (tick the right answer)</label>
                            <div class="input-group">
                                <span class="input-group-addon"><b>A</b></span>
                                <input autocomplete="off" class="answer form-control" type="text" name="a" spellcheck="false" value="{{ old('a') }}" placeholder="Compulsory">
                                <span class="input-group-addon"><input type="radio" name="answer" value="a" class="flat-blue" @if(old('answer') == 'a') {{ 'checked' }} @endif></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><b>B</b></span>
                                <input autocomplete="off" class="answer form-control" type="text" name="b" spellcheck="false" value="{{ old('b') }}" placeholder="Compulsory">
                                <span class="input-group-addon"><input type="radio" name="answer" value="b" class="flat-blue" @if(old('answer') == 'b') {{ 'checked' }} @endif></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><b>C</b></span>
                                <input autocomplete="off" class="answer form-control" type="text" name="c" spellcheck="false" value="{{ old('c') }}" placeholder="Optional">
                                <span class="input-group-addon"><input type="radio" name="answer" value="c" class="flat-blue" @if(old('answer') == 'c') {{ 'checked' }} @endif></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><b>D</b></span>
                                <input autocomplete="off" class="answer form-control" type="text" name="d" spellcheck="false" value="{{ old('d') }}" placeholder="Optional">
                                <span class="input-group-addon"><input type="radio" name="answer" value="d" class="flat-blue" @if(old('answer') == 'd') {{ 'checked' }} @endif></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><b>E</b></span>
                                <input autocomplete="off" class="answer form-control" type="text" name="e" spellcheck="false" value="{{ old('e') }}" placeholder="Optional">
                                <span class="input-group-addon"><input type="radio" name="answer" value="e" class="flat-blue" @if(old('answer') == 'e') {{ 'checked' }} @endif></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="box-footer">
                        <div class="col-md-4 pull-right">
                            <button class="btn btn-success btn-block" type="submit">Add</button>
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
    <script src="{{ asset('tinymce/plugins/tiny_mce_wiris/integration/WIRISplugins.js') }}"><script>
@endsection



