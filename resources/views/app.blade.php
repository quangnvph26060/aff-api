<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Affliate</title>
        <meta name="csrf-token" content={{ csrf_token() }}>
        @vite(['resources/js/aff-fe/src/main.js'])
        {{-- css  --}}
        @foreach(File::glob(public_path('css/*.css')) as $cssFile)
            <link rel="stylesheet" href="{{ asset('css/' . basename($cssFile)) }}">
        @endforeach
        {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
        <script type="application/javascript" src="{{config('APP_URL')}}"></script>
        {{-- bootstap --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="app" class="vue">
        </div>
        {{-- <script type="application/javascript" src="{{ mix('js/app.js') }}"></script> --}}
    </body>
</html>
