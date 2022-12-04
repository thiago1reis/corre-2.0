<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('imagens/icone_corre.png') }}">
    <link rel="stylesheet" href="{{ asset('site/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('site/estilo.css') }}">
    <link rel="stylesheet" href="{{ asset('site/icofont/icofont.min.css') }}">
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
    <script>
        window.addEventListener('close-modal', event =>{
            $('#createModal').modal('hide');
            $('#viewModal').modal('hide');
            $('#editModal').modal('hide');
            $('#deleteModal').modal('hide');
        });
        window.addEventListener('show-create-modal', event =>{
            $('#createModal').modal('show');
        });
        window.addEventListener('show-view-modal', event =>{
            $('#viewModal').modal('show');
        });
        window.addEventListener('show-edit-modal', event =>{
            $('#editModal').modal('show');
        });
        window.addEventListener('show-delete-modal', event =>{
            $('#deleteModal').modal('show');
        });
    </script>
    @livewireScripts
</body>
</html>