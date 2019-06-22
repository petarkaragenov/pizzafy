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
        </style>
    </head>
    <body>
        <div id="adminPanel">
          <admin-panel></admin-panel>
        </div>
        <script src="{{ mix('js/admin.js') }}" type="text/javascript"></script>
    </body>
</html>