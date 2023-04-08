<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('imagens/icone_corre.png') }}">
    <link rel="stylesheet" href="{{ asset('site/estilo.css') }}">
    <link rel="stylesheet" href="{{ asset('site/icofont/icofont.min.css') }}">
    @livewireStyles
</head>

<body>
    @include('layouts.cabecalho')

    @if (Auth::check() == true)
        @include('layouts.menu')
    @endif

    {{-- @yield('content') --}}

    {{ $slot }}

    @include('layouts.rodape')

    <livewire:modals />
    <livewire:scripts />
</body>

</html>
