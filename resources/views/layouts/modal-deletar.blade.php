<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" data-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content bg-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Deletar {{ $modulo }}</h5>
                <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Tem certeza que deseja deletar ?</h6>
            </div>
            <div class="modal-footer">
                <button wire:click="closeModal" type="button" class="btn  btn-outline-danger btn-fixed-size" wire:loading.attr="disabled">
                    {{-- Texto padrão do botão--}}
                    <span wire:click="closeModal" wire:loading.remove.delay.shortest>Cancelar</span>
                    {{-- Efeito de carregamento quando o butão é acionado--}}
                    <span wire:click="closeModal" wire:loading.delay.shortest class="spinner-border spinner-border-sm text-danger" role="status"></span>
                </button>
                <button wire:click="delete" type="submit" class="btn btn-success btn-fixed-size" wire:loading.attr="disabled">
                    {{-- Texto padrão do botão--}}
                    <span wire:click="delete" wire:loading.remove.delay.shortest>Confirmar</span>
                    {{-- Efeito de carregamento quando o butão é acionado--}}
                    <span wire:click="delete" wire:loading.delay.shortest class="spinner-border spinner-border-sm text-white" role="status"></span>
                </button>
            </div>
        </div>
    </div>
</div>