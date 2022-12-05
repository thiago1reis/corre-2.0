
    {{-- Modal para importar dados --}}
    <div wire:ignore.self class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true" data-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Importar Dados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('layouts.alertas.alertasModal')
                    <form method="POST" wire:submit.prevent="import">
                        <div class="mb-3">
                            <label for="arquivo" class="form-label">Arquivo CSV: <span class="text-danger fw-bold">*</span></label>
                            <input class="form-control" type="file" id="arquivoCSV" wire:model="arquivo">
                            @error('arquivo')<span class="text-danger" >{{$message}}</span>@enderror
                        </div>
                        <div class=" my-3 float-end ">
                            {{-- Efeite de carregamento quando enviar o formulário--}}
                            <div wire:loading.delay.shortest class="spinner-border spinner-border-sm text-secondary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            {{-- Frase de carregamento quando enviar o formulário--}}
                            <span class="text-secondary " wire:loading.delay.shortest>Carregando...</span> <!-- 50ms -->
                            {{-- botões do formulário --}}
                            <button type="button" data-bs-dismiss="modal" class="btn btn-primary" wire:loading.attr="disabled" wire:loading.class.remove="btn-primary" wire:loading.class="btn-secondary">Cancelar</button>
                            <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:loading.class.remove="btn-success" wire:loading.class="btn-secondary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>