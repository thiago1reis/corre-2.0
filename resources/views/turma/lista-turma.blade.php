@extends('layouts.app')

@section('titulo', 'TURMAS')

@section('content')
    <div class="container-fluid">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 mb-2">
            <button onclick="Livewire.emit('showModal', 'turmas')" type="button" class="btn btn-primary float-end"><i
                    class="icofont-ui-add"></i>
                Adicionar</button>
        </div>
        <fieldset class="border border-secondary p-3 mb-3">
            <legend class="float-none w-auto">Turmas Adicionadas</legend>
            <form action="{{ route('turma.index') }}" method="GET">
                <div class="row mb-3 gap-2">
                    <div class="col-sm-8 col-md-6 col-lg-6 col-xl-4">
                        <input type="text" class="form-control" name="busca" value="{{ $busca }}"
                            placeholder="Digite o que deseja buscar">
                    </div>
                    <div class="col-sm-2 col-md-1 col-lg-1 col-xl-1 d-grid ">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
            @include('layouts.alertas')
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="20%">Modalidade / Etapa de ensino</th>
                            <th width="20%">Módulo/Série</th>
                            <th width="20%">Curso</th>
                            <th width="36%">Observações</th>
                            <th width="04%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($turmas->count() > 0)
                            @foreach ($turmas as $item)
                                <tr class="text-nowrap bd-highlight">
                                    <td class="align-middle">{{ $item->etapa_modalidade }}</td>
                                    <td class="align-middle">{{ $item->modulo_serie }}</td>
                                    <td class="align-middle">{{ $item->curso }}</td>
                                    <td class="align-middle">{{ $item->observacao }}</td>
                                    <td class="align-middle">
                                        <a type="button"
                                            onclick="Livewire.emit('showModal', 'turmas', {{ $item->id }})"
                                            class="me-3 link-secondary text-decoration-none"><i title="Editar Dados"
                                                class="icofont-ui-edit"></i></a>
                                        <a type="button"
                                            onclick="Livewire.emit('showModal', 'deletar', '{{ $modulo = 'Turma' }}', '{{ route('turma.destroy', ['turma' => $item->id]) }}')"
                                            class="me-3 link-secondary text-decoration-none"><i title="Deletar Registro"
                                                class="icofont-ui-delete"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-nowrap bd-highlight">
                                <td colspan="5"class="align-middle text-center">Nenhum registro encontrado.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                @if (isset($busca))
                    {{ $turmas->appends($busca)->links() }}
                @else
                    {{ $turmas->links() }}
                @endif
            </div>
        </fieldset>
    </div>
@endsection
