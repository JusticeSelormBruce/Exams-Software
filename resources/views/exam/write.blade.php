<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.3/MathJax.js?config=TeX-MML-AM_CHTML" async></script>
        <title>Examination</title>
        <style type="text/css">
               span p{
                     clear: none;
                     display: inline;
                     margin: 0px 12px;
                     text-align: justify;
                }
                span input{
                     clear: none;
                     display: inline;
                     margin: 4px 12px 0px 0px;   
                }

        </style>
</head>
<body >
        <div id='app'>
        
        {!! $exam->header !!}
        @if(json_decode($exam->section_a) && json_decode($exam->section_b))
        <h3>Section A</h3>
        
        @endif
        <form id="frm_question" action="{{ route('exam.submit_question') }}" method="POST">
                 {{ csrf_field() }}
                <input type="hidden" name="page" value="{{$page}}">
                <input type="hidden" name="exam_id" value="{{$exam_id}}">
                <input type="hidden" name="objectives_id" value="{{$objectives_id}}">
                <input type="hidden" name="exl" value="{{$exl}}">
                <h4>Question {!! $page !!}.</h4>
                 {!! $question !!}<br>
                <span><input type="radio" name="answer" value="a">a){!! $a !!}</span><br>
                <span><input type="radio" name="answer" value="b">b){!! $b !!}</span><br>
                <span><input type="radio" name="answer" value="c">@if($c)c){!! $c !!}</span><br>@endif
                <span><input type="radio" name="answer" value="d">@if($d)d){!! $d !!}</span><br>@endif
                <span><input type="radio" name="answer" value="e">@if($e)e){!! $e !!}</span><br>@endif
                <br>
                <span>Time: <p id="timer_view"></p>s</span><br><br>
                <button>Next</button>
       </form>
</div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
               // app.data.message = 'Hello';
             
            $(document).ready(function() {
                const question_time = {!! $question_time !!}
                var remaining_time = question_time;
                var countDown = setInterval(function() {
                     remaining_time--;
                     $('#timer_view').html(remaining_time);
                     if(remaining_time<=0){
                        clearInterval(countDown);
                        $('#frm_question').submit();
                        
                     }   
                },1000);
                
            });
        </script>
@yield('script')
</body>
</html>

