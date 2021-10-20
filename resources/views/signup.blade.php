<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('send-bulk-mail')}}" method="post">
        @csrf
        Name : <input type="text" name="name" id="name"><br>
        Email : <input type="text" name="email" id="email"><br>
        password: <input type="password" name="password" id="password"><br>
        <input type="submit" value="Insert">
    </form>
</body>
</html>