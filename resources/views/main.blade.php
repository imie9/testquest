<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <!-- Styles -->
    <style>
        html, body {
            background-color: whitesmoke;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        .header {
            height: 50px;
            background-color: #dfd8d9;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>
<body>
<div id="app">
    <div class="content">
        <div class="header">Some shop</div>
        <main-component></main-component>
    </div>
</div>
</body>
</html>
