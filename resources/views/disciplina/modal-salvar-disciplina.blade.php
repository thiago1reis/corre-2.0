<div class="modal-dialog modal-xl">
    <div class="modal-content bg-modal">
        <div class="modal-header">
            <h5 class="modal-title">{{ $acao }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" wire:submit.prevent="save">
                <div class="row">
                    <div class="col-sm-6 my-2">
                        <label class="form-label">Nome <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('disciplina.nome') is-invalid @enderror"
                            wire:model.lazy="disciplina.nome" placeholder="Informe o nome da disciplina">
                        @error('disciplina.nome')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 my-2">
                        <label for="observacao" class="form-label">Observações</label>
                        <input type="text" class="form-control" wire:model.lazy="disciplina.observacao">
                    </div>
                </div>
                <div class="my-3 d-flex gap-3">
                    <button type="button" class="btn btn-outline-danger btn-fixed-size ms-auto"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button wire:click="save" type="submit" class="btn btn-success btn-fixed-size"
                        wire:loading.attr="disabled">
                        {{-- Texto padrão do botão --}}
                        <span wire:click="save" wire:loading.remove.delay.shortest>Salvar</span>
                        {{-- Efeito de carregamento quando o butão é acionado --}}
                        <span wire:click="save" wire:loading.delay.shortest
                            class="spinner-border spinner-border-sm text-white" role="status"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
