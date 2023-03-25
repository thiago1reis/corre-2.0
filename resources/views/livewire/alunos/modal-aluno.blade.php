<div wire:ignore.self class="modal fade" id="saveModal" tabindex="-1" data-bs-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="saveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content bg-modal">
            <div class="modal-header">
                <h5 class="modal-title">{{$modal}} Aluno</h5>
                <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('layouts.alertas.alertasModal')
                <form method="POST" wire:submit.prevent="save" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="my-2">
                                <label for="foto" class="form-label">Foto:</label>
                                <input class="form-control mb-4 {{ $this->aluno->foto ? 'd-none' : '' }}" type="file" wire:model.lazy="foto" accept="image/*">
                                <span class="mb-4 {{ $this->aluno->foto ? 'd-none' : '' }}" style="font-size: 11.5px">Dimenssão: 1000x1000 pixels</span>
                                @if($this->aluno->foto)
                                    <div class="position-relative">
                                        <img class="figure-img img-fluid rounded border"  alt="{{ $aluno->nome }}"  src="{{ url("storage/{$aluno->foto}") }}">
                                        <a type="button" wire:click="deleteFoto()" title="Remover Foto"><span class="position-absolute top-0 end-0 badge bg-danger">X</span></a>
                                    </div>
                                @elseif($foto)
                                    <img class="figure-img img-fluid rounded border" alt="{{ $foto->temporaryUrl() }}" src="{{ $foto->temporaryUrl() }}">
                                @elseif (!$foto)
                                    <img class="figure-img img-fluid rounded border bg-white" alt="Foto do Aluno" src="{{ asset('imagens/aluno.png') }}">
                                @endif
                                @error('foto')<span class="text-danger" >{{$message}}</span>@enderror
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-4 my-2">
                                    <label for="nome" class="form-label">Nome: <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control  @error('aluno.nome') is-invalid @enderror" wire:model.lazy="aluno.nome" placeholder="Digite o nome do aluno">
                                    @error('aluno.nome')<span class="text-danger" >{{$message}}</span>@enderror
                                </div>
                                <div class="col-sm-4 my-2">
                                    <label class="form-label">Matrícula: <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control @error('aluno.matricula') is-invalid @enderror" wire:model.lazy="aluno.matricula"  maxLength="14" placeholder="Digite a matrícula do aluno">
                                    @error('aluno.matricula')<span class="text-danger" >{{$message}}</span>@enderror
                                </div>
                                <div class="col-sm-4 my-2">
                                    <label for="data_nascimento" class="form-label">Data de Nascimento: <span class="text-danger fw-bold">*</span></label>
                                    <input type="date" class="form-control  @error('aluno.data_nascimento') is-invalid @enderror" wire:model.lazy="aluno.data_nascimento">
                                    @error('aluno.data_nascimento')<span class="text-danger" >{{$message}}</span>@enderror
                                </div>
                                <div class="col-sm-5 my-2">
                                    <label for="sexo" class="form-label">Sexo: <span class="text-danger fw-bold">*</span></label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('aluno.sexo') is-invalid @enderror" type="radio" id="inlineRadio1" wire:model.lazy="aluno.sexo" value="Feminino">
                                        <label class="form-check-label" for="inlineRadio1">Feminino</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('aluno.sexo') is-invalid @enderror" type="radio" id="inlineRadio2" wire:model.lazy="aluno.sexo" value="Masculino">
                                        <label class="form-check-label" for="inlineRadio2">Masculino</label>
                                    </div>
                                    <div class="form-check form-check-inline ">
                                        <input class="form-check-input @error('aluno.sexo') is-invalid @enderror" type="radio" id="inlineRadio3" wire:model.lazy="aluno.sexo" value="Outros" >
                                        <label class="form-check-label" for="inlineRadio3">Outros</label>
                                    </div><br>
                                    @error('aluno.sexo')<span class="text-danger" >{{$message}}</span>@enderror
                                </div>
                                <div class="col-sm-3 my-2">
                                    <label for="telefone" class="form-label">Telefone:</label>
                                    <input type="text" class="form-control" wire:model="aluno.telefone" maxlength="15" placeholder="(00) 00000-0000">
                                </div>
                                <div class="col-sm-4 my-2">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control"  wire:model="aluno.email" placeholder="nome@email.com">
                                </div>
                                <div class="col-sm-4 my-2">
                                    <label for="responsavel" class="form-label">Responsável:</label>
                                    <input type="text" class="form-control"  wire:model.lazy="aluno.responsavel" placeholder="Digite o nome do responsável pelo aluno">
                                </div>
                                <div class="col-sm-4 my-2">
                                    <label for="telefone_responsavel" class="form-label">Telefone do Responsável:</label>
                                    <input type="text" class="form-control" wire:model.lazy="aluno.telefone_responsavel" maxlength="15" placeholder="(00) 00000-0000">
                                </div>
                                <div class="col-sm-12 my-2">
                                    <label for="observacao" class="form-label">Observações:</label>
                                    <textarea class="form-control" id="observacao"  wire:model.lazy="aluno.observacao" style="height: 100px"></textarea>
                                </div>
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
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

