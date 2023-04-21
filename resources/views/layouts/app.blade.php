@php
    $rotaAtual = Route::currentRouteName();
@endphp
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo') | {{ config('app.name', 'Laravel') }} </title>
    <link rel="icon" href="{{ asset('imagens/icone_corre.png') }}">
    <link rel="stylesheet" href="{{ asset('site/estilo.css') }}">
    <link rel="stylesheet" href="{{ asset('site/icofont/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
    @livewireStyles
</head>

<body>
    @include('layouts.cabecalho')

    @if (Auth::check() == true && $rotaAtual != 'login')
        @include('layouts.menu')
    @endif

    @yield('content')

    {{ isset($slot) }}
    {{-- {{ $slot }} --}}

    @include('layouts.rodape')

    <livewire:modals />
    <livewire:scripts />
    <script src="{{ asset('assets/jquery.js') }}"></script>
    <script src="{{ asset('assets/app.js') }}"></script>
</body>

</html>
