<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Weather App</title>


        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <script src="https://rawgithub.com/darkskyapp/skycons/master/skycons.js"></script>

    </head>
    <body class="bg-blue-200">
        <div id="app" class="flex justify-center pt-5">
            <weather-app></weather-app>
        </div>
    </body>
</html>
