{!! $exam->header !!}
<h1>Marking Scheme</h1>
@if(json_decode($exam->section_a) && json_decode($exam->section_b))
<h3>Section A</h3>
@endif
<ol>
    @foreach(json_decode($exam->section_a) as $obj)
        <li>{!! $objectives->find($obj->ques)->answer !!}</li>
    @endforeach
</ol>
@if(json_decode($exam->section_a) && json_decode($exam->section_b))
<h3>Section B</h3>
@endif
<ol>
    @foreach(json_decode($exam->section_b) as $obj)
        <li>{!! $theories->find($obj->ques)->answer !!}</li>
    @endforeach
</ol>