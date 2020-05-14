<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.3/MathJax.js?config=TeX-MML-AM_CHTML" async></script>
        <title>Student</title>
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
            #app{
                width: 500px;
                margin: 20px auto;
            }
        </style>
</head>
<body >
        <div id='app'>
        
        <h4>Welcome {!! $student->other_names !!} {!! $student->last_name !!}</h4>
        <h5>Available Exams</h5>
         <ol>
        @foreach($exams as $exam)
                <li><a href="{{ route('exam.write',array('id'=>$exam->subject->id,'page'=>1)) }}">{!! $exam->subject->name !!}</a></li>
          
        @endforeach
        @if(sizeof($exams)==0)
        <p>Sorry No Exams Available</p>
        @endif

        <br><br>
        
        <form action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
            <button type="submit">Logout</button>
        </form>
      
</div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
               // app.data.message = 'Hello';
             
            $(document).ready(function() {
                //const stu = {!! $student !!}
                //console.log(stu);
                
            });
        </script>
@yield('script')
</body>
</html>

