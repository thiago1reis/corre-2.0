<div class="modal-dialog modal-xl ">
    <div class="modal-content bg-modal">
        <div class="modal-header">
            <h5 class="modal-title">Importar dados dos alunos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" wire:submit.prevent="save" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Arquivo CSV: <span class="text-danger fw-bold">*</span></label>
                    <input class="form-control @error('arquivo') is-invalid @enderror" type="file"
                        wire:model.lazy="arquivo">
                    @error('arquivo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
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
