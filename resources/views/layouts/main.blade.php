<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Cybertill Developer Test') }}</title>
    <link rel="stylesheet" href="{{ url('dist/app.css') }}" />
</head>
<body>
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-md-12" id="app">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ url('dist/app.js') }}"></script>
</body>
</html>
