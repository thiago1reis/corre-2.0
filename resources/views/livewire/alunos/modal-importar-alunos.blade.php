<div wire:ignore.self class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true" data-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Importar Dados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            @include('layouts.alertas.alertasModal')
                <form method="POST" wire:submit.prevent="import()">
                    <div class="mb-3">
                        <label for="arquivo" class="form-label">Arquivo CSV: <span class="text-danger fw-bold">*</span></label>
                        <input class="form-control @error('arquivo') is-invalid @enderror" type="file" id="arquivoCSV" wire:model.prevent="arquivo">

                        @error('arquivo')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                    <div class=" my-3 float-end ">
                        <button wire:click="closeModal" type="button" class="btn  btn-outline-danger btn-fixed-size" wire:loading.attr="disabled" >
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
