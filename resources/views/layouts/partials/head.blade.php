<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/icons/favicon.png')}}"/>
    @yield('styles')
</head>
