<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Socialmedia</title>

        <!-- Styles and Scripts -->
        @include('includes.stylesscripts')
</head>
<body>
    <div class="container">
        <ul>
        @foreach ($tasks as $task)
        <li>
            <a href="/share/{{$task->id}}">{{$task->body}}</a>
        </li>
        @endforeach
        </ul>


        <form method="POST" action="/toSweden/share">
            {{ csrf_field() }}
            <div class="form-group">

              <input type="text" class="form-control"  name="body">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
    </div>
</body>
</html>