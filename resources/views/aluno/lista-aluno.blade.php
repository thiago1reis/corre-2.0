@extends('layouts.app')

@section('titulo', 'Alunos')

@section('content')
    <div class="container-fluid">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 mb-2">
            <button wire:click="showModal('Importar')" type="button" class="btn btn-outline-primary float-end"><i
                    class="icofont-ui-copy"></i> Importar</button>
            <button onclick="Livewire.emit('showModal', 'alunos')" type="button" class="btn btn-primary float-end"><i
                    class="icofont-ui-add"></i>
                Adicionar</button>
        </div>

        <fieldset class="border border-secondary p-3 mb-3">
            <legend class="float-none w-auto">Alunos Adicionados</legend>
            <form action="{{ route('aluno.index') }}" method="GET">
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
                            <th width="07%">Foto</th>
                            <th width="30%">Nome</th>
                            <th width="20%">Matrícula</th>
                            <th width="17%">Telefone</th>
                            <th width="26%">E-mail</th>
                            <th width="04%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($alunos->count() > 0)
                            @foreach ($alunos as $item)
                                <tr class="text-nowrap bd-highlight">
                                    <td class="align-middle">
                                        @if ($item->foto)
                                            <img style="width: 75px" class="img-thumbnail "
                                                src="{{ url("storage/{$item->foto}") }}" alt="{{ $item->nome }}">
                                        @else
                                            <img style="width: 75px" class="img-thumbnail"
                                                src="{{ asset('imagens/aluno.png') }}" alt="{{ $item->nome }}">
                                        @endif
                                    </td>
                                    <td class="align-middle"><span>{{ $item->nome }}</span></td>
                                    <td class="align-middle">{{ $item->matricula }}</td>
                                    <td class="align-middle">{{ $item->telefone }}</td>
                                    <td class="align-middle">{{ $item->email }}</td>
                                    <td class="align-middle">
                                        <a type="button"
                                            onclick="Livewire.emit('showModal', 'alunos', {{ $item->id }})"
                                            class="me-3 link-secondary text-decoration-none"><i title="Editar Dados"
                                                class="icofont-ui-edit"></i></a>
                                        <a type="button"
                                            onclick="Livewire.emit('showModal', 'deletar', '{{ $modulo = 'Aluno' }}', '{{ route('aluno.destroy', ['aluno' => $item->id]) }}')"
                                            class="me-3 link-secondary text-decoration-none"><i title="Deletar Registro"
                                                class="icofont-ui-delete"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-nowrap bd-highlight">
                                <td colspan="6"class="align-middle text-center">Nenhum registro encontrado.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                @if (isset($search))
                    {{ $alunos->appends($search)->links() }}
                @else
                    {{ $alunos->links() }}
                @endif
            </div>
        </fieldset>
    </div>
@endsection
