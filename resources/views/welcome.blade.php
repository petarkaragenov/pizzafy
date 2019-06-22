<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pizzafy</title>
        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
        <meta name="csrf-token" value="{{ csrf_token() }}" />
        <style>
            html, body {
                height: 100vh;
            }

            #app > img {
                opacity: 0.5;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                position: fixed;
                z-index: -1;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <img src="/storage/table-background.jpg" alt="">
            <pizza-app user="{{ auth()->user() }}"></pizza-app>
        </div>
        <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    </body>
</html>
