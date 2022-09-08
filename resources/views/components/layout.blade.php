<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">

    {{-- CSS Links --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/main.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css?v=3.0') }}">

    {{-- JavaScript Links --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://kit.fontawesome.com/4419d23bf4.js" crossorigin="anonymous"></script>
</head>
<body>
    <video class="video-background" autoplay muted loop>
        <source src="{{ asset('img/video.mp4') }}" type="video/mp4">
    </video>
    
    {{ $slot }}

    <footer>Copyright &copy; 2022 by b1deyesa. All Rights Reserved.</footer>
</body>
</html>