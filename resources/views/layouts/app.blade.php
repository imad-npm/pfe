<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>My App</title>
</head>
<body class=" text-gray-800 font-[430] ">
    @if (auth('teacher')->check())
        @include('teacher.partials.nav')
    @endif
    @if (auth('admin')->check())
    @include('admin.partials.nav')

    @endif
    @if (auth('team')->check())
    @include('team.partials.nav')

    @endif
    @if (session('info') )

    <x-alert.info > {{session('info')}}</x-alert.info>

@endif

@if (session('error') )
<x-alert.error > {{session('error')}}</x-alert.error>

@endif
    @yield('content')
</body>
</html>