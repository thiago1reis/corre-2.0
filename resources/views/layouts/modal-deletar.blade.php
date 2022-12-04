<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" data-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Deletar {{ $modulo }}</h5>
                <button type="button" class="btn-close" wire:click="cancelDelete" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Tem certeza que deseja deletar ?</h6>
            </div>
            <div class="modal-footer">
                <button wire:click="cancelDelete" type="button" class="btn btn-danger btn-fixed-size" wire:loading.attr="disabled">
                    {{-- Texto padrão do botão--}}
                    <span wire:click="cancelDelete" wire:loading.remove.delay.shortest>Cancelar</span>
                    {{-- Efeito de carregamento quando o butão é acionado--}}
                    <div wire:click="cancelDelete" wire:loading.delay.shortest class="spinner-border spinner-border-sm text-white" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
                <button wire:click="destroy" type="button" class="btn btn-success btn-fixed-size" wire:loading.attr="disabled">
                    {{-- Texto padrão do botão--}}
                    <span wire:click="destroy" wire:loading.remove.delay.shortest>Confirmar</span>
                    {{-- Efeito de carregamento quando o butão é acionado--}}
                    <div wire:click="destroy" wire:loading.delay.shortest class="spinner-border spinner-border-sm text-white" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>