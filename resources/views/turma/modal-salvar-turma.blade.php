<div class="modal-dialog modal-xl">
    <div class="modal-content bg-modal">
        <div class="modal-header">
            <h5 class="modal-title">{{ $acao }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" wire:submit.prevent="save">
                <div class="row">
                    <div class="col-sm-6 col-md-12 col-lg-4 my-2">
                        <label class="form-label">Modalidade / Etapa de ensino <span
                                class="text-danger fw-bold">*</span></label>
                        <select class="form-select @error('turma.etapa_modalidade') is-invalid @enderror"
                            wire:model.lazy="turma.etapa_modalidade">
                            <option value="" selected>Selecione...</option>
                            <option value="Técnico Integrado Ensino Médio">Técnico Integrado Ensino Médio</option>
                            <option value="Técnico Subsequente">Técnico Subsequente</option>
                            <option value="Proeja">Proeja</option>
                        </select>
                        @error('turma.etapa_modalidade')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 col-md-12 col-lg-4 my-2">
                        <label class="form-label">Módulo / Série <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('turma.modulo_serie') is-invalid @enderror"
                            wire:model.lazy="turma.modulo_serie" placeholder="Informe o módulo ou a série do curso">
                        @error('turma.modulo_serie')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 col-md-12 col-lg-4 my-2">
                        <label class="form-label">Curso <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('turma.curso') is-invalid @enderror"
                            wire:model.lazy="turma.curso" placeholder="Informe o nome do curso">
                        @error('turma.curso')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-12 my-2">
                        <label for="observacao" class="form-label">Observações</label>
                        <input type="text" class="form-control" wire:model.lazy="turma.observacao">
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
