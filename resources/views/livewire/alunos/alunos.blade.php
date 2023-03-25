<div class="container-fluid">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 mb-2">
        <button wire:click="showModal('Adicionar')" type="button" class="btn btn-primary float-end"><i class="icofont-ui-add"></i> Adicionar</button>
    </div>
    <fieldset class="border border-secondary p-3 mb-3">
        <legend  class="float-none w-auto">Alunos Adicionados</legend>
        @include('layouts.busca')
        @include('layouts.alertas')
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="100">Foto</th>
                        <th width="300">Nome</th>
                        <th width="200">Matrícula</th>
                        <th width="200">Telefone</th>
                        <th width="300">E-mail</th>
                        <th width="100">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunos as $aluno)
                    <tr class="text-nowrap bd-highlight">
                        <td class="align-middle" >
                            @if($aluno->foto)
                            <img style="width: 75px" class="img-thumbnail " src="{{ url("storage/{$aluno->foto}") }}"  alt="{{ $aluno->nome }}">
                            @else
                            <img style="width: 75px" class="img-thumbnail" src="{{ asset('imagens/aluno.png') }}" alt="{{ $aluno->nome }}">
                            @endif
                        </td>
                        <td class="align-middle"><span>{{ $aluno->nome }}</span></td>
                        <td class="align-middle">{{ $aluno->matricula }}</td>
                        <td class="align-middle">{{ $aluno->telefone }}</td>
                        <td class="align-middle">{{ $aluno->email }}</td>
                        <td class="align-middle">
                            <a type="button" wire:click="show({{ $aluno->id }})" class="mx-2 link-secondary text-decoration-none"><i title="Visualizar Dados" class="icofont-ui-file"></i></a>
                            <a type="button" wire:click="showModal('Editar', {{ $aluno->id }})" class="mx-2 link-secondary text-decoration-none"><i title="Editar Dados" class="icofont-ui-edit"></i></a>
                            <a type="button" wire:click="showModal('Deletar', {{ $aluno->id}})" class="mx-2 link-secondary text-decoration-none"><i title="Deletar Registro" class="icofont-ui-delete"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            @if(isset($search))
                {{ $alunos->appends($search)->links() }}
            @else
                {{ $alunos->links() }}
            @endif
        </div>
    </fieldset>
    @include('livewire.alunos.modal-aluno')
    @include('layouts.modal-deletar')
</div>
