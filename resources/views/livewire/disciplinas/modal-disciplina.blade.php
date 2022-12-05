<div wire:ignore.self class="modal fade" id="saveModal" tabindex="-1" data-bs-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="saveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl " role="document">
        <div class="modal-content bg-modal">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modal }} Disciplina</h5>
                <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" wire:submit.prevent="save">
                    <div class="row">
                        <div class="col-sm-6 my-2">
                            <label for="nome" class="form-label">Nome: <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control @error('disciplina.nome') is-invalid @enderror" wire:model.lazy="disciplina.nome" placeholder="Digite o nome da disciplina">
                            @error('disciplina.nome')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-6 my-2">
                            <label for="observacao" class="form-label">Observações:</label>
                            <input type="text" class="form-control" wire:model.lazy="disciplina.observacao">
                        </div>
                    </div>
                    <div class=" my-3 float-end ">
                        <button wire:click="closeModal" type="button" class="btn  btn-outline-danger btn-fixed-size" wire:loading.attr="disabled">
                            {{-- Texto padrão do botão--}}
                            <span wire:click="closeModal" wire:loading.remove.delay.shortest>Cancelar</span>
                            {{-- Efeito de carregamento quando o butão é acionado--}}
                            <span wire:click="closeModal" wire:loading.delay.shortest class="spinner-border spinner-border-sm text-danger" role="status"></span>
                        </button>
                        <button wire:click="save" type="submit" class="btn btn-success btn-fixed-size" wire:loading.attr="disabled">
                            {{-- Texto padrão do botão--}}
                            <span wire:click="save" wire:loading.remove.delay.shortest>Salvar</span>
                            {{-- Efeito de carregamento quando o butão é acionado--}}
                            <span wire:click="save" wire:loading.delay.shortest class="spinner-border spinner-border-sm text-white" role="status"></span>
                        </button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>