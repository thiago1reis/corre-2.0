@extends('layouts.app')

@section('titulo', 'Painel')

@section('content')
    <div class="container">
        <div class="row my-3">
            <div class="col-sm-6 col-md-6 col-lg-4 col-xxl-4">
                <div class="card my-3" style="height: 25rem">
                    <div class="card-body position-relative">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge rounded-pill bg-icon-card-painel p-3">
                                <i class="icofont-ui-add fs-2"></i>
                            </span>
                            <span class="mx-3">
                                <h4 class="card-title">Adicionar</h4>
                                <h6 class="card-subtitle mb-2 text-muted">Adiciona novos dados ao sistema</h6>
                            </span>
                        </div>
                        <p class="card-text"> Neste card, você pode adicionar novos dados ao sistema selecionando uma das
                            opções disponíveis:
                            Aluno, Disciplinas, Servidores, Turmas e Usuários. Cada opção permite que você preencha um
                            formulário com as informações necessárias para incluir esses elementos no sistema.</p>
                        <div class="mb-3 position-absolute bottom-0 ">
                            <a href="{{ route('aluno.index') }}" class="card-link ms-0 me-3">Alunos</a>
                            <a href="#" class="card-link ms-0 me-3">Disciplinas</a>
                            <a href="#" class="card-link ms-0 me-3">Servidores</a>
                            <a href="{{ route('turma.index') }}" class="card-link ms-0 me-3">Turmas</a>
                            <a href="#" class="card-link ms-0 me-3">Usuários</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xxl-4">
                <div class="card my-3" style="height: 25rem">
                    <div class="card-body ">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge rounded-pill bg-icon-card-painel p-3">
                                <i class="icofont-ui-note fs-2"></i>
                            </span>
                            <span class="mx-3">
                                <h4 class="card-title">Cadastrar</h4>
                                <h6 class="card-subtitle mb-2 text-muted">Cadastra nova ocorrência no sistema</h6>
                            </span>
                        </div>
                        <p class="card-text">Neste card, você pode cadastrar uma nova ocorrência escolar para manter um
                            registro de eventos importantes que ocorrem no ambiente escolar. Utilize essa funcionalidade
                            para documentar situações como atrasos, faltas, comportamentos inadequados ou outras ocorrências
                            relevantes para a escola.
                        </p>
                        <div class="position-absolute bottom-0 py-3">
                            <a href="#" class="card-link ms-0 me-3">Ocorrência</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xxl-4">
                <div class="card my-3" style="height: 25rem">
                    <div class="card-body ">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge rounded-pill bg-icon-card-painel p-3">
                                <i class="icofont-ui-search fs-2"></i>
                            </span>
                            <span class="mx-3">
                                <h4 class="card-title">Consultar</h4>
                                <h6 class="card-subtitle mb-2 text-muted">Consulta informações no sistema</h6>
                            </span>
                        </div>
                        <p class="card-text"> Neste card, você pode consultar as ocorrências registradas no sistema. Utilize
                            a opção 'Alunos' para buscar informações sobre as ocorrências
                            relacionadas a um aluno específico. Já a opção 'Ocorrências' permite que você visualize uma
                            lista completa de todas
                            as ocorrências registradas no sistema.</p>
                        <div class="position-absolute bottom-0 py-3">
                            <a href="#" class="card-link ms-0 me-3">Alunos</a>
                            <a href="#" class="card-link ms-0 me-3">Ocorrências</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
