<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Aluno</h5>
                <button type="button" class="btn-close" wire:click="cancelEdit" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('layouts.alertas.alertasModal')
                <form method="POST" wire:submit.prevent="edit">
                    <div class="row">
                        <div class="col-sm-3 my-2">
                            <label for="editar_nome" class="form-label">Nome: <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control @error('editar_nome') is-invalid @enderror" id="editar_nome" wire:model="editar_nome" placeholder="Digite o nome da disciplina">
                            @error('editar_nome')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-9 my-2">
                            <label for="editar_observacao" class="form-label">Observações:</label>
                            <input type="text" class="form-control" id="edit_obeditar_observacaoservacao" wire:model="editar_observacao">
                        </div>
                    </div>
                    <div class=" my-3 float-end ">
                        <button wire:click="cancelEdit" type="button" class="btn btn-danger btn-fixed-size" wire:loading.attr="disabled">
                            {{-- Texto padrão do botão--}}
                            <span wire:click="cancelEdit" wire:loading.remove.delay.shortest>Cancelar</span>
                            {{-- Efeito de carregamento quando o butão é acionado--}}
                            <div wire:click="cancelEdit" wire:loading.delay.shortest class="spinner-border spinner-border-sm text-white" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                        <button wire:target="edit" type="submit" class="btn btn-success btn-fixed-size" wire:loading.attr="disabled">
                            {{-- Texto padrão do botão--}}
                            <span wire:target="edit" wire:loading.remove.delay.shortest>Editar</span>
                            {{-- Efeito de carregamento quando o butão é acionado--}}
                            <div wire:target="edit" wire:loading.delay.shortest class="spinner-border spinner-border-sm text-white" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>