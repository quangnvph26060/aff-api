<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel with Vue Router</title>
        <meta name="csrf-token" content={{ csrf_token() }}>
        @vite(['resources/js/app.js'])
    </head>
    <body>
        <div id="app">
            <router-view></router-view>
        </div>

        <script type="module" src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
