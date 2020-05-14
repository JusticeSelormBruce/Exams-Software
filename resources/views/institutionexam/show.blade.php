<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.3/MathJax.js?config=TeX-MML-AM_CHTML" async></script>
        <title>Examination Question</title>
</head>
<body>
        {!! $exam->header !!}
        @if(json_decode($exam->section_a) && json_decode($exam->section_b))
        <h3>Section A</h3>
        @endif
        <ol>
        @foreach(json_decode($exam->section_a) as $obj)
                <li>{!! $objectives->find($obj->ques)->question !!}</li>
                a){!! $objectives->find($obj->ques)->a !!}<br>
                b){!! $objectives->find($obj->ques)->b !!}<br>
                @if($objectives->find($obj->ques)->c)c){!! $objectives->find($obj->ques)->c !!}<br>@endif
                @if($objectives->find($obj->ques)->d)d){!! $objectives->find($obj->ques)->d !!}<br>@endif
                @if($objectives->find($obj->ques)->e)e){!! $objectives->find($obj->ques)->e !!}<br>@endif
        @endforeach
        </ol>
        @if(json_decode($exam->section_a) && json_decode($exam->section_b))
        <h3>Section B</h3>
        @endif
        <ol>
        @foreach(json_decode($exam->section_b) as $obj)
                <li>{!! $theories->find($obj->ques)->question !!}</li>
        @endforeach
        </ol>  
</body>
</html>

