@extends('layouts.app')

@section('titulo', 'Lista de Ocorrência')

@section('content')
    <div class="container-fluid">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 mb-2">
            <a type="button" href="{{ route('ocorrencia.pdf', ['ocorrenciaIdOrBusca' => $busca]) }}" target="blank"
                class="btn btn-outline-primary float-end">
                <i class="icofont-ui-file"></i>
                Relatório PDF
            </a>
        </div>
        <fieldset class="border border-secondary p-3 mb-3">
            <legend class="float-none w-auto">Ocorrências Cadastradas</legend>
            <form action="{{ route('ocorrencia.index') }}" method="GET">
                <div class="row mb-3 gap-2">
                    <div class="col-sm-8 col-md-6 col-lg-6 col-xl-4">
                        <input type="text" class="form-control" name="busca" value="{{ $busca }}"
                            placeholder="Digite o que deseja buscar">
                    </div>
                    <div class="col-sm-2 col-md-1 col-lg-1 col-xl-1 d-grid">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
            @include('layouts.alertas')
            @if ($ocorrencias->count() > 0)
                @foreach ($ocorrencias as $item)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-3 col-lg-1 col-xl-1 my-1">
                                    <span class="card-text fw-semibold ">Foto</span><br>
                                    @if ($item->aluno->foto)
                                        <img style="width: 4.6rem" class="img-thumbnail"
                                            src="{{ url("storage/{$item->aluno->foto}") }}" alt="{{ $item->aluno->nome }}">
                                    @else
                                        <img style="width: 4.6rem" class="img-thumbnail"
                                            src="{{ asset('imagens/aluno.png') }}" alt="{{ $item->aluno->nome }}">
                                    @endif
                                </div>
                                <div class="col-sm-6 col-md-5 col-lg-3 col-xl-3 my-1">
                                    <span class="card-text fw-semibold ">Nome</span><br>
                                    <span class="card-text">{{ $item->aluno->nome }}</span>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 my-1">
                                    <span class="card-text fw-semibold ">Matrícula</span><br>
                                    <span class="card-text">{{ $item->aluno->matricula }}</span>
                                </div>
                                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 my-1">
                                    <span class="card-text fw-semibold ">Data de Nascimento</span><br>
                                    <span class="card-text">
                                        {{ date('d/m/Y', strtotime($item->aluno->data_nascimento)) }}
                                    </span>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 my-1">
                                    <span class="card-text fw-semibold ">Sexo</span><br>
                                    <span class="card-text">{{ $item->aluno->sexo }}</span>
                                </div>
                            </div>
                            <hr class="text-secondary text-opacity-25">
                            <div class="row">
                                <div class="col-sm-6 col-md-12 col-lg-4 col-xl-4 my-2">
                                    <span class="card-text fw-semibold ">Turma</span><br>
                                    <span class="card-text">
                                        {{ $item->turma->etapa_modalidade }}
                                        {{ $item->turma->curso }} -
                                        {{ $item->turma->modulo_serie }}
                                    </span>
                                </div>
                                <div class="col-sm-6 col-md-12 col-lg-3 col-xl-3 my-2">
                                    <span class="card-text fw-semibold ">Bolsa do Aluno</span><br>
                                    <span class="card-text">{{ $item->bolsa_aluno ? $item->bolsa_aluno : '-' }}</span>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 my-2">
                                    <span class="card-text fw-semibold ">Disciplina</span><br>
                                    <span class="card-text">{{ $item->disciplina->nome }}</span>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-2 col-xl-2 my-2">
                                    <span class="card-text fw-semibold ">Data</span><br>
                                    <span class="card-text">{{ date('d/m/Y', strtotime($item->data)) }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 my-2">
                                    <span class="card-text fw-semibold ">Tipo</span><br>
                                    <span class="card-text">{{ $item->tipo }}</span>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 my-2">
                                    <span class="card-text fw-semibold ">Encaminhada Por</span><br>
                                    <span class="card-text">
                                        {{ $item->servidor->nome }}
                                        ({{ $item->servidor->tipo }})
                                    </span>
                                </div>
                                <div class="col-sm-6 col-md-12 col-lg-5 col-xl-5 my-2">
                                    <span class="card-text fw-semibold ">Setor Encaminhado</span><br>
                                    <span class="card-text">
                                        {{ $item->setor_encaminhado }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 my-2">
                                    <span class="card-text fw-semibold ">Descrição</span><br>
                                    <span class="card-text">{{ $item->descricao }}</span>
                                </div>
                                <div class="col-sm-12 my-2">
                                    <span class="card-text fw-semibold ">Medida Adotada</span><br>
                                    <span class="card-text">{{ $item->medida_adotada }}</span>
                                </div>
                                <div class="col-sm-12 my-2">
                                    <span class="card-text fw-semibold ">Obeservações</span><br>
                                    <span class="card-text">{{ $item->observacao ? $item->observacao : '-' }}</span>
                                </div>
                            </div>
                            <hr class="text-secondary text-opacity-25">
                            <div class="row">
                                <div class="col-sm-12 my-1">
                                    <span class="card-text fw-semibold">Dados do Cadastro / Ações</span><br>
                                    <small class="text-muted">
                                        {{ $item->usuario->name }} em
                                        {{ $item->created_at->format('d/m/Y H:i:s') }}
                                    </small>
                                    <small class="text-muted mx-1">|</small>
                                    <small class="fs-6">
                                        <a href="{{ route('ocorrencia.pdf', ['ocorrenciaIdOrBusca' => $item->id]) }}"
                                            target="blank" type="button" class="mx-2 link-primary text-decoration-none">
                                            <i title="Imprimir Ocorrência" class="icofont-ui-file"></i>
                                        </a>

                                        @php
                                            $usuarioCadastro = $item->usuario_id == auth()->user()->id;
                                            $usuarioAdministrador = auth()->user()->tipo == 1;
                                        @endphp

                                        @if ($usuarioCadastro || $usuarioAdministrador)
                                            <a href="{{ route('ocorrencia.create', ['ocorrenciaId' => $item->id]) }}"
                                                type="button" class="mx-2 link-primary text-decoration-none">
                                                <i title="Editar Ocorrência" class="icofont-ui-edit"></i>
                                            </a>
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="card mb-3">
                    <div class="card-body">
                        <p class="card-text text-center my-2">Nenhum registro encontrado.</p>
                    </div>
                </div>
            @endif
            <div class="d-flex justify-content-center">
                @if (isset($busca))
                    {{ $ocorrencias->appends($busca)->links() }}
                @else
                    {{ $ocorrencias->links() }}
                @endif
            </div>
        </fieldset>
    </div>
@endsection
