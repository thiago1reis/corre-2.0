<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CORRE</title>
    <link rel="stylesheet" href="{{ asset('site/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('site/estilo.css') }}">
    @livewireStyles
</head>
<body>
   
    {{--Acopla o cabeçalho no app--}}
    @include('layouts.cabecalho') 

    {{--Acopla o menu no app caso seja feita a autenticação --}}
    @if(Auth::check() == true)  
        @include('layouts.menu') 
    @endif

    {{--Renderiza o componente Livewire--}}
    {{ $slot }} 

    {{--Acopla o rodapé no app--}}
    @include('layouts.rodape') 
    
    <script src="{{ asset('site/jquery.js') }}"></script> 
    <script src="{{ asset('site/bootstrap.js') }}"></script> 
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script> 
    <script nomodule src="https://unpkg .com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    @livewireScripts
</body>
</html>