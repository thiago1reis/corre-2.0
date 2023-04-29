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
                        <input type="text" class="form-control @error('servidor.nome') is-invalid @enderror"
                            wire:model.lazy="servidor.nome" placeholder="Informe o nome do servidor">
                        @error('servidor.nome')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 my-2">
                        <label class="form-label">Tipo <span class="text-danger fw-bold">*</span></label>
                        <select class="form-select @error('servidor.tipo') is-invalid @enderror"
                            wire:model.lazy="servidor.tipo">
                            <option value="" selected>Selecione...</option>
                            @foreach ($tipos as $key => $valor)
                                <option value="{{ $key }}">{{ $valor }}</option>
                            @endforeach
                        </select>
                        @error('servidor.tipo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-12 my-2">
                        <label class="form-label">Observações:</label>
                        <input type="text" class="form-control" wire:model.lazy="servidor.observacao">
                    </div>
                </div>
                <div class=" my-3 float-end ">
                    <button type="button" class="btn btn-outline-danger btn-fixed-size"
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
