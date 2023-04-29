@extends('layouts.app')

@section('titulo', 'Usuários')

@section('content')
    <div class="container-fluid">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 mb-2">
            <button onclick="Livewire.emit('showModal', 'usuarios')" type="button" class="btn btn-primary float-end"><i
                    class="icofont-ui-add"></i>
                Adicionar</button>
        </div>
        <fieldset class="border border-secondary p-3 mb-3">
            <legend class="float-none w-auto">Usuários Adicionados</legend>
            <form action="{{ route('usuario.index') }}" method="GET">
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
                            <th width="20%">Tipo</th>
                            <th width="28%">Nome</th>
                            <th width="28%">Email</th>
                            <th width="20%">Status</th>
                            <th width="04%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($usuarios->count() > 0)
                            @foreach ($usuarios as $item)
                                <tr class="text-nowrap bd-highlight">
                                    <td class="align-middle">{{ $item->tipo ? 'Administrador' : 'Padrão' }}</td>
                                    <td class="align-middle">{{ $item->name }}</td>
                                    <td class="align-middle">{{ $item->email }}</td>
                                    <td class="align-middle">{{ $item->status ? 'Ativo' : 'Inativo' }}</td>
                                    <td class="align-middle">
                                        <a type="button"
                                            onclick="Livewire.emit('showModal', 'usuarios', {{ $item->id }})"
                                            class="me-3 link-secondary text-decoration-none"><i title="Editar Dados"
                                                class="icofont-ui-edit"></i></a>
                                        <a type="button"
                                            onclick="Livewire.emit('showModal', 'deletar', '{{ $modulo = 'Usuário' }}', '{{ route('usuario.destroy', ['usuario' => $item->id]) }}')"
                                            class="me-3 link-secondary text-decoration-none {{ $item->id == auth()->user()->id ? 'd-none' : '' }}"><i
                                                title="Deletar Registro" class="icofont-ui-delete"></i></a>
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
                    {{ $usuarios->appends($busca)->links() }}
                @else
                    {{ $usuarios->links() }}
                @endif
            </div>
        </fieldset>
    </div>
@endsection
