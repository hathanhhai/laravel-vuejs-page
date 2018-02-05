<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Recipe Box</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

        <style>

            *{
                margin: 0;
                padding: 0;
            }

        </style>
    </head>
    <body>
        <div id="app">


        </div>
    </body>

    <script src="{{mix('js/app.js')}}"></script>
</html>
