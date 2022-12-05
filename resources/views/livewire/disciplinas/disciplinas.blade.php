<div class="container-fluid">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 mb-2">
        <button wire:click="showModal('Adicionar')" type="button" class="btn btn-primary float-end"><i class="icofont-ui-add"></i> Adicionar</button>
    </div>
    <fieldset class="border border-secondary p-3 mb-3">
        <legend  class="float-none w-auto">Disciplinas Adicionadas</legend>
        @include('layouts.busca') 
        @include('layouts.alertas') 
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="300">Nome</th>
                        <th width="800">Observações</th>
                        <th width="100">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($disciplinas as $disciplina)
                    <tr class="text-nowrap bd-highlight">
                        <td class="align-middle"><span>{{ $disciplina->nome }}</span></td>
                        <td class="align-middle">{{ $disciplina->observacao }}</td> 
                        <td class="align-middle"> 
                            <a type="button" wire:click="showModal('Editar', {{ $disciplina->id }})" class="me-3 link-secondary text-decoration-none"><i title="Editar Dados" class="icofont-ui-edit"></i></a>
                            <a type="button" wire:click="showModal('Deletar', {{ $disciplina->id }})" class="me-3 link-secondary text-decoration-none"><i title="Deletar Registro" class="icofont-ui-delete"></i></a> 
                        </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            @if(isset($search))
            {{ $disciplinas->appends($search)->links() }}
            @else
            {{ $disciplinas->links() }}
            @endif 
        </div>
    </fieldset>
    @include('livewire.disciplinas.modal-disciplina') 
    @include('layouts.modal-deletar') 
</div>