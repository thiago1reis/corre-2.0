<div class="container-fluid">
    <fieldset class="border border-secondary p-3 mb-3">
        <legend  class="float-none w-auto">Adicionar Disciplinas</legend>
        @include('layouts.alertas.alertasAdd') 
        <form method="POST" wire:submit.prevent="store">
            <div class="row">
                <div class="col-sm-3 my-2">
                    <label for="nome" class="form-label ">Nome: 
                        <span class="text-danger fw-bold">*</span>
                    </label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" wire:model="nome" placeholder="Digite o nome da disciplina">
                    @error('nome')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-sm-9 my-2">
                    <label for="observacao" class="form-label">Observações:</label>
                    <input type="text" class="form-control" id="observacao" wire:model="observacao">
                </div>
            </div>
            <div class="my-3 float-end">
                <button wire:target="store" type="submit" class="btn btn-success btn-fixed-size" wire:loading.attr="disabled">
                    {{-- Texto padrão do botão--}}
                    <span wire:target="store" wire:loading.remove.delay.shortest>Adicionar</span>
                    {{-- Efeito de carregamento quando o butão é acionado--}}
                    <div wire:target="store" wire:loading.delay.shortest class="spinner-border spinner-border-sm text-white" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </form> 
    </fieldset>
    <fieldset class="border border-secondary p-3 mb-3">
        <legend  class="float-none w-auto">Disciplinas Adicionadas</legend>
        <input type="text" class="form-control 4 mb-3" id="search " name="search " wire:model="search" placeholder="Busque por nome">
        @include('layouts.alertas.alertasList') 
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
                            <a type="button" wire:click="selectEdit({{ $disciplina->id }})" class="me-3 link-secondary text-decoration-none"><i title="Editar Dados" class="icofont-ui-edit"></i></a>
                            <a type="button" wire:click="deleteConfirm({{ $disciplina->id }})" class="me-3 link-secondary text-decoration-none"><i title="Deletar Registro" class="icofont-ui-delete"></i></a> 
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
    {{-- Modal Editar --}}
    @include('livewire.disciplinas.modals.modal-editar') 
    {{-- Modal  deletar --}}
    @include('livewire.disciplinas.modals.modal-deletar') 
</div>
@push('scripts')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#editModal').modal('hide');
            $('#deleteModal').modal('hide');
        });
        window.addEventListener('show-edit-modal', event =>{
            $('#editModal').modal('show');
        });
        window.addEventListener('show-delete-confirmation-modal', event =>{
            $('#deleteModal').modal('show');
        });
    </script>
@endpush