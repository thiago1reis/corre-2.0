@extends('layouts.app')

@section('titulo', 'Cadastro de Ocorrência')

@section('content')
    <div class="container-fluid">

        <fieldset class="border border-secondary p-3 my-3">
            <legend class="float-none w-auto">Cadastro de Ocorrência</legend>
            @include('layouts.alertas')
            @livewire('ocorrencias')
        </fieldset>
    </div>
@endsection
