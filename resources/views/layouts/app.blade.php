<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
    <livewire:styles/>
</head>
<body>

@include('layouts.nav')

<div class="container mx-auto">
    @yield('content')
</div>

<livewire:scripts/>

</body>
</html>
