<!DOCTYPE html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/404.css')}}">
    <script src="https://kit.fontawesome.com/4b9ba14b0f.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="mainbox">
        <div class="err">4</div>
        <i class="far fa-question-circle fa-spin"></i>
        <div class="err2">4</div>
        <div class="msg">Page Not Found.. <br> Never existed in the first
            place?<p>Let's go <a href="{{route('home')}}">home</a> and try from there.</p>
        </div>
    </div>
