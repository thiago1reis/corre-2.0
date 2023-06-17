<div class="modal-dialog modal-md">
    <div class="modal-content bg-modal">
        <div class="modal-header">
            <h5 class="modal-title">{{ $acao }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" wire:submit.prevent="save">
                <div class="row">
                    <div class="col-sm-12 my-2">
                        <label class="form-label">Tipo <span class="text-danger fw-bold">*</span></label>
                        <select class="form-select @error('usuario.tipo') is-invalid @enderror"
                            wire:model.lazy="usuario.tipo">
                            <option value="" selected>Selecione...</option>
                            <option value="1">Administrador</option>
                            <option value="0">Padrão</option>
                        </select>
                        @error('usuario.tipo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-12 my-2">
                        <label class="form-label">Nome <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('usuario.name') is-invalid @enderror"
                            wire:model.lazy="usuario.name" placeholder="Informe o nome do usuário">
                        @error('usuario.name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 my-2">
                        <label for="email" class="form-label">Email <span
                                class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control  @error('usuario.email') is-invalid @enderror"
                            wire:model.lazy="usuario.email" placeholder="nome@email.com">
                        @error('usuario.email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 my-2">
                        <label class="form-label">Senha <span
                                class="text-danger fw-bold {{ $usuario->id ? 'd-none' : '' }}">*</span></label>
                        <input type="password" class="form-control @error('senha') is-invalid @enderror"
                            wire:model.lazy="senha" placeholder="Informe uma senha temporária para o usuário">
                        @error('senha')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 my-2">
                        <label class="form-label">Status <span class="text-danger fw-bold">*</span></label>
                        <select class="form-select @error('usuario.status') is-invalid @enderror"
                            wire:model.lazy="usuario.status">
                            <option value="" selected>Selecione...</option>
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                        @error('usuario.status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
