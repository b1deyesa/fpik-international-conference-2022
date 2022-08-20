<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="color-scheme" content="only">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
        :root {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
        }
        body { margin: 0; padding: 0; }
        .mail {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
                -ms-flex-pack: center;
                    justify-content: center;
            background-color: transparent;
        }
        .mail .container {
            width: 100%;
            max-width: 50em;
            padding: 3em 4em;
            -webkit-box-sizing: border-box;
                    box-sizing: border-box;
            background: -webkit-gradient(linear,left top, left bottom,from(#367591),to(#152744));
            background: -o-linear-gradient(#367591,#152744);
            background: linear-gradient(#367591,#152744);
        }
        .mail img {
            display: block;
            margin: auto;
            width: 6em;
        }
        .mail .title {
            display: block;
            margin: auto;
            text-align: center;
            width: 100%;
            margin: 1em 0 .5em;
            color: #FFFFFF;
        }
        .mail .sub-title {
            font-weight: 400;
            text-align: center;
            width: 28em;
            max-width: 100%;
            margin: 0em auto 2em;
            color: #FFFFFF70;
        }
        .mail hr {
            border: 1px solid #FFFFFF09;
            margin: 0em 0 3em 
        }
        .mail p {
            text-align: left;
            width: 100%;
            max-width: 40rem;
            margin: 0 0 .5em;
            color: #f0f0f0CC
        }
        .mail .access-code {
            text-align: left;
            width: 100%;
            max-width: 40rem;
            margin: 1.5em 0 3em;
            color: #F4EEA9
        }
        .mail .foot {
            display: block;
            font-size: .7em;
            text-align: center;
            margin: auto;
            color: #FFFFFF30;
        }
        @media only screen and (max-width: 800px) {
            .mail .container {
                padding: 3em 2em 2em;
            }
        }
    </style>
</head>
<body>
    <div class="mail">
        <div class="container">
            <img src="{{ asset('img/logo.png') }}">
            <h2 class="title">Pattimura University<br>International Conference Series</h2>
            <h3 class="sub-title">"Promoting Blue Economy by Protection - Production Strategy"</h3>
            <hr>
            <p>Hello {{ $name }}</p>
            <p>Thanks for registering! We've reserved your space — see you there.</p>
            <h3 class="access-code"><i>Access Code</i>&nbsp;&nbsp;:&nbsp; {{ $access_code }}</h3>
            <small class="foot">Copyright &copy; 2022 by b1deyesa. All Rights Reserved.</small>
        </div>
    </div>
</body>
</html>