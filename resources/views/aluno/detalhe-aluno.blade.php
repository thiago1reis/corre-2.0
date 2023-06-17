@extends('layouts.app')

@section('titulo', 'Detalhes do Aluno')

@section('content')
    <div class="container-fluid">
        <fieldset class="border border-secondary p-3 my-3">
            <legend class="float-none w-auto">Informações do Aluno</legend>
            <form action="{{ route('aluno.show') }}" method="GET">
                <div class="row mb-3 gap-2">
                    <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2">
                        <input type="text" class="form-control" name="busca" value="{{ old('busca', $busca) }}"
                            maxLength="14" placeholder="Informe a matrícula do aluno">
                    </div>
                    <div class="col-sm-2 col-md-1 col-lg-1 col-xl-1 d-grid">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
            @include('layouts.alertas')
            @if ($aluno)
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2">
                        <div class="card mb-3">
                            <div class="card-body d-flex flex-column">
                                <span class="card-text fw-semibold ">Foto</span>
                                @if ($aluno->foto)
                                    <img style="width: 10rem" class="img-thumbnail mb-3"
                                        src="{{ url("storage/{$aluno->foto}") }}" alt="{{ $aluno->nome }}">
                                @else
                                    <img style="width: 10rem" class="img-thumbnail mb-3"
                                        src="{{ asset('imagens/aluno.png') }}" alt="{{ $aluno->nome }}">
                                @endif
                                <span class="card-text fw-semibold ">Nome</span>
                                <span class="card-text mb-3">{{ $aluno->nome }}</span>

                                <span class="card-text fw-semibold ">Matrícula</span>
                                <span class="card-text mb-3">{{ $aluno->matricula }}</span>

                                <span class="card-text fw-semibold ">Data de Nascimento</span>
                                <span class="card-text mb-3">
                                    {{ date('d/m/Y', strtotime($aluno->data_nascimento)) }}
                                </span>

                                <span class="card-text fw-semibold ">Sexo</span>
                                <span class="card-text mb-3">{{ $aluno->sexo }}</span>

                                <span class="card-text fw-semibold ">Telefone</span>
                                <span class="card-text mb-3">{{ $aluno->telefone ? $aluno->telefone : '-' }}</span>

                                <span class="card-text fw-semibold ">E-mail</span>
                                <span class="card-text mb-3">{{ $aluno->email ? $aluno->email : '-' }}</span>

                                <span class="card-text fw-semibold ">Responsável</span>
                                <span class="card-text mb-3">{{ $aluno->responsavel ? $aluno->responsavel : '-' }}</span>

                                <span class="card-text fw-semibold ">Telefone do Responsável</span>
                                <span
                                    class="card-text mb-3">{{ $aluno->telefone_responsavel ? $aluno->telefone_responsavel : '-' }}
                                </span>

                                <span class="card-text fw-semibold ">Observações</span>
                                <span class="card-text mb-3">{{ $aluno->observacao ? $aluno->observacao : '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-9 col-xl-10">
                        @if (count($aluno->ocorrencias) >= 1)
                            @foreach ($aluno->ocorrencias as $ocorrencia)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-12 col-lg-4 col-xl-4 my-2">
                                                <span class="card-text fw-semibold ">Turma</span><br>
                                                <span class="card-text">
                                                    {{ $ocorrencia->turma->etapa_modalidade }}
                                                    {{ $ocorrencia->turma->curso }} -
                                                    {{ $ocorrencia->turma->modulo_serie }}
                                                </span>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-3 col-xl-3 my-2">
                                                <span class="card-text fw-semibold ">Bolsa do Aluno</span><br>
                                                <span
                                                    class="card-text">{{ $ocorrencia->bolsa_aluno ? $ocorrencia->bolsa_aluno : '-' }}</span>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 my-2">
                                                <span class="card-text fw-semibold ">Disciplina</span><br>
                                                <span class="card-text">{{ $ocorrencia->disciplina->nome }}</span>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-2 col-xl-2 my-2">
                                                <span class="card-text fw-semibold ">Data</span><br>
                                                <span
                                                    class="card-text">{{ date('d/m/Y', strtotime($ocorrencia->data)) }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 my-2">
                                                <span class="card-text fw-semibold ">Tipo</span><br>
                                                <span class="card-text">{{ $ocorrencia->tipo }}</span>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 my-2">
                                                <span class="card-text fw-semibold ">Encaminhada Por</span><br>
                                                <span class="card-text">
                                                    {{ $ocorrencia->servidor->nome }}
                                                    ({{ $ocorrencia->servidor->tipo }})
                                                </span>
                                            </div>
                                            <div class="col-sm-6 col-md-12 col-lg-5 col-xl-5 my-2">
                                                <span class="card-text fw-semibold ">Setor Encaminhado</span><br>
                                                <span class="card-text">
                                                    {{ $ocorrencia->setor_encaminhado }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 my-2">
                                                <span class="card-text fw-semibold ">Descrição</span><br>
                                                <span class="card-text">{{ $ocorrencia->descricao }}</span>
                                            </div>
                                            <div class="col-sm-12 my-2">
                                                <span class="card-text fw-semibold ">Medida Adotada</span><br>
                                                <span class="card-text">{{ $ocorrencia->medida_adotada }}</span>
                                            </div>
                                            <div class="col-sm-12 my-2">
                                                <span class="card-text fw-semibold ">Obeservações</span><br>
                                                <span
                                                    class="card-text">{{ $ocorrencia->observacao ? $ocorrencia->observacao : '-' }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 my-1">
                                                <span class="card-text fw-semibold">Dados do Cadastro</span><br>
                                                <small class="text-muted">
                                                    {{ $ocorrencia->usuario->name }} em
                                                    {{ $ocorrencia->created_at->format('d/m/Y H:i:s') }}
                                                </small>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text text-center my-auto">
                                        Esse aluno não possui nenhuma ocorrência cadastrada.
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="card ">
                    <div class="card-body">
                        <p class="card-text text-center my-2">Nenhum registro encontrado.</p>
                    </div>
                </div>
            @endif
        </fieldset>
    </div>
@endsection
