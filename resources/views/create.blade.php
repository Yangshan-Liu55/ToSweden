<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Skapa</h1>
    {!! Form::open(['action'=>'shareroutesController@store', 'method'=>'POST']) !!}
        <div class="form-group">
            {{Form::label('title','title')}}
            {{Form::textarea('textin','',['class'=>'form-controll'])}}
        </div>
        {{Form::submit('submit')}}
    {!! Form::close() !!}
</body>
</html>