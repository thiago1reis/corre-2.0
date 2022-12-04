<div class="container-fluid">
    <fieldset class="border border-secondary p-3 mb-3">
        <legend  class="float-none w-auto">Adicionar Aluno</legend>
        @include('layouts.alertas.alertasAdd') 
        <form method="POST" wire:submit.prevent="store">
            <div class="row">
                <div class="col-sm-2">
                    <div class="my-2">
                        <label for="foto" class="form-label">Foto:</label>
                        
                        <input class="form-control @error('foto') is-invalid @enderror" type="file" wire:model="foto" accept="image/*">
                     
                        @if($previaFoto)
                        <img class="figure-img img-fluid rounded border mt-4 @error('foto') border border-danger @enderror" alt="Foto do Aluno" src="{{ $previaFoto }}">
                        @else
                        <img class="figure-img img-fluid rounded border mt-4 bg-white" alt="Foto do Aluno" src="{{ asset('imagens/aluno.png') }}">
                        @endif
                        @error('foto')<span class="text-danger" >{{$message}}</span>@enderror
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">

                        <div class="col-sm-4 my-2">
                            <label for="nome" class="form-label">Nome: <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" wire:model="nome" placeholder="Digite o nome do aluno">
                            @error('nome')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="matricula" class="form-label">Matrícula: <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control @error('matricula') is-invalid @enderror" id="matricula" name="matricula" wire:model="matricula" placeholder="Digite a matrícula do aluno">
                            @error('matricula')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="data_nascimento" class="form-label">Data de Nascimento: <span class="text-danger fw-bold">*</span></label>
                            <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" id="data_nascimento" name="data_nascimento" wire:model="data_nascimento">
                            @error('data_nascimento')<span class="text-danger" >{{ $message }}</span>@enderror
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="sexo" class="form-label">Sexo: <span class="text-danger fw-bold">*</span></label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('sexo') is-invalid @enderror" type="radio" name="sexo" id="inlineRadio1" wire:model="sexo" value="Feminino">
                                <label class="form-check-label" for="inlineRadio1">Feminino</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('sexo') is-invalid @enderror" type="radio" name="sexo" id="inlineRadio2" wire:model="sexo" value="Masculino">
                                <label class="form-check-label" for="inlineRadio2">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('sexo') is-invalid @enderror" type="radio" name="sexo" id="inlineRadio3" wire:model="sexo" value="Outros" >
                                <label class="form-check-label" for="inlineRadio3">Outros</label>
                            </div><br>
                            @error('sexo')<span class="text-danger" >{{ $message }}</span>@enderror    
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="telefone" class="form-label">Telefone:</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" wire:model="telefone" maxlength="15" placeholder="(00) 00000-0000">
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" wire:model="email" placeholder="nome@email.com">
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="responsavel" class="form-label">Responsável:</label>
                            <input type="text" class="form-control" id="responsavel" name="responsavel" wire:model="responsavel" placeholder="Digite o nome do responsável pelo aluno">
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="telefone_responsavel" class="form-label">Telefone do Responsável:</label>
                            <input type="text" class="form-control" id="telefone_responsavel" name="telefone_responsavel" maxlength="15" wire:model="telefone_responsavel" placeholder="(00) 00000-0000">
                        </div>

                        <div class="col-sm-12 my-2">
                            <label for="observacao" class="form-label">Observações:</label>
                            <textarea class="form-control" id="observacao" name="observacao" wire:model="observacao" style="height: 100px"></textarea>
                        </div>
                    </div>
                    <div class="my-3 float-end">
                        {{-- Efeite de carregamento quando enviar o formulário--}}
                        <div wire:loading.delay.shortest class="spinner-border spinner-border-sm text-secondary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        {{-- Frase de carregamento quando enviar o formulário--}}
                        <span class="text-secondary " wire:loading.delay.shortest>Carregando...</span> <!-- 50ms -->
                        {{-- botões do formulário --}}
                        <button  data-bs-toggle="modal" data-bs-target="#importModal" type="button" class="btn btn-outline-primary" wire:loading.remove><i class="icofont-ui-file"></i> Importar</button>
                        <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:loading.class.remove="btn-success" wire:loading.class="btn-secondary">Adicionar</button>
                    </div>
                </div>
            </div>
        </form> 
    </fieldset>
    <fieldset class="border border-secondary p-3 mb-3">
        <legend  class="float-none w-auto">Alunos Adicionados</legend> 
        <input type="text" class="form-control 4 mb-3" id="search " name="search " wire:model="search" placeholder="Busque por nome ou matrícula">
        @include('layouts.alertas.alertasList') 
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="100">Foto</th>
                        <th width="300">Nome</th>
                        <th width="200">Matrícula</th>
                        <th width="200">Telefone</th>
                        <th width="300">E-mail</th>
                        <th width="100">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunos as $aluno)
                    <tr class="text-nowrap bd-highlight">
                        <td class="align-middle" >  
                            @if($aluno->foto)
                            <img style="width: 75px" class="img-thumbnail " src="{{ url("storage/{$aluno->foto}") }}"  alt="{{ $aluno->nome }}"> 
                            @else 
                            <img style="width: 75px" class="img-thumbnail" src="{{ asset('imagens/aluno.png') }}" alt="{{ $aluno->nome }}"> 
                            @endif
                        </td>
                        <td class="align-middle"><span>{{ $aluno->nome }}</span></td>
                        <td class="align-middle">{{ $aluno->matricula }}</td>                        
                        <td class="align-middle">{{ $aluno->telefone }}</td>
                        <td class="align-middle">{{ $aluno->email }}</td>                         
                        <td class="align-middle"> 
                            <a type="button" wire:click="show({{ $aluno->id }})" class="me-3 link-secondary text-decoration-none"><i title="Visualizar Dados" class="icofont-ui-file"></i></a>
                            <a type="button" wire:click="selectEdit({{ $aluno->id }})" class="me-3 link-secondary text-decoration-none"><i title="Editar Dados" class="icofont-ui-edit"></i></a>
                            <a type="button" wire:click="deleteConfirm({{ $aluno->id }})" class="me-3 link-secondary text-decoration-none"><i title="Deletar Registro" class="icofont-ui-delete"></i></a> 
                        </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            @if(isset($search))
                {{ $alunos->appends($search)->links() }}
            @else
                {{ $alunos->links() }}
            @endif 
        </div>
    </fieldset>

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

    {{-- Modal para editar dados --}}
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Aluno</h5>
                    <button type="button" class="btn-close" wire:click="cancelEdit" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('layouts.alertas.alertasModal')
                    <form method="POST" wire:submit.prevent="edit">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="my-2">
                                    <label for="edit_foto" class="form-label">Foto:</label>
                                    <input class="form-control" type="file" id="edit_foto" wire:model="edit_foto" >
                                    @error('edit_foto')<span class="text-danger" >{{$message}}</span>@enderror
                                    @if($edit_foto)  
                                        @if($previaFotoNova)
                                            <img class="figure-img img-fluid rounded border mt-4" alt="Foto do Aluno" src="{{ $previaFotoNova }}">
                                            <figcaption class="figure-caption text-end">Prévia da foto.</figcaption>
                                        @else
                                            <img class="figure-img img-fluid rounded border mt-4" alt="{{ $nome }}" src="{{ url("storage/{$edit_foto}") }}">
                                        @endif        
                                    @else
                                        <img class="figure-img img-fluid rounded border mt-4 bg-white" alt="Foto do Aluno" src="{{ asset('imagens/aluno.png') }}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-4 my-2">
                                        <label for="edit_nome" class="form-label">Nome: <span class="text-danger fw-bold">*</span></label>
                                        <input type="text" class="form-control" id="edit_nome" wire:model="edit_nome" placeholder="Digite o nome do aluno">
                                        @error('edit_nome')<span class="text-danger" >Este campo é obrigatório</span>@enderror
                                    </div>
                                    <div class="col-sm-4 my-2">
                                        <label for="edit_matricula" class="form-label">Matrícula: <span class="text-danger fw-bold">*</span></label>
                                        <input type="text" class="form-control" id="edit_matricula" wire:model="edit_matricula" placeholder="Digite a matrícula do aluno">
                                        @error('edit_matricula')<span class="text-danger" >Este campo é obrigatório</span>@enderror
                                    </div>
                                    <div class="col-sm-4 my-2">
                                        <label for="edit_data_nascimento" class="form-label">Data de Nascimento: <span class="text-danger fw-bold">*</span></label>
                                        <input type="date" class="form-control" id="edit_data_nascimento"  wire:model="edit_data_nascimento">
                                        @error('edit_data_nascimento')<span class="text-danger" >Este campo é obrigatório</span>@enderror
                                    </div>
                                    <div class="col-sm-5 my-2">
                                        <label for="edit_sexo" class="form-label">Sexo: <span class="text-danger fw-bold">*</span></label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineRadio1" wire:model="edit_sexo" value="Feminino">
                                            <label class="form-check-label" for="inlineRadio1">Feminino</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineRadio2" wire:model="edit_sexo" value="Masculino">
                                            <label class="form-check-label" for="inlineRadio2">Masculino</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="inlineRadio3" wire:model="edit_sexo" value="Outros" >
                                            <label class="form-check-label" for="inlineRadio3">Outros</label>
                                        </div><br>
                                        @error('edit_sexo')<span class="text-danger" >Este campo é obrigatório</span>@enderror    
                                    </div>
                                    <div class="col-sm-3 my-2">
                                        <label for="edit_telefone" class="form-label">Telefone:</label>
                                        <input type="text" class="form-control" id="edit_telefone" wire:model="edit_telefone" maxlength="15" placeholder="(00) 00000-0000">
                                    </div>
                                    <div class="col-sm-4 my-2">
                                        <label for="edit_email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="edit_email" wire:model="edit_email" placeholder="nome@email.com">
                                    </div>
                                    <div class="col-sm-4 my-2">
                                        <label for="edit_responsavel" class="form-label">Responsável:</label>
                                        <input type="text" class="form-control" id="edit_responsavel" wire:model="edit_responsavel" placeholder="Digite o nome do responsável pelo aluno">
                                    </div>
                                    <div class="col-sm-4 my-2">
                                        <label for="edit_telefone_responsavel" class="form-label">Telefone do Responsável:</label>
                                        <input type="text" class="form-control" id="edit_telefone_responsavel" maxlength="15" wire:model="edit_telefone_responsavel" placeholder="(00) 00000-0000">
                                    </div>
                                    <div class="col-sm-12 my-2">
                                        <label for="edit_observacao" class="form-label">Observações:</label>
                                        <textarea class="form-control" id="edit_observacao"  wire:model="edit_observacao" style="height: 100px"></textarea>
                                    </div>
                                </div>
                                <div class=" my-3 float-end ">
                                    {{-- Efeite de carregamento quando enviar o formulário--}}
                                    <div wire:loading.delay.shortest class="spinner-border spinner-border-sm text-secondary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    {{-- Frase de carregamento quando enviar o formulário--}}
                                    <span class="text-secondary " wire:loading.delay.shortest>Carregando...</span> <!-- 50ms -->
                                    {{-- botões do formulário --}}
                                    <button type="button" class="btn btn-primary" wire:click="cancelEdit" wire:loading.attr="disabled" wire:loading.class.remove="btn-primary" wire:loading.class="btn-secondary">Cancelar</button>
                                    <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:loading.class.remove="btn-success" wire:loading.class="btn-secondary">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>

    {{-- Modal para vizualizar dados --}}
    <div wire:ignore.self class="modal fade" id="showModal" tabindex="-1" data-bs-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dados do Aluno</h5>
                    <button type="button" class="btn-close" wire:click="closeShow" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Foto: </th>
                                <td> @if($show_foto)
                                    <img style="width: 75px" class="img-thumbnail " src="{{ url("storage/{$show_foto}") }}"  alt="{{ $show_nome }}"> 
                                    @else 
                                    <img style="width: 75px" class="img-thumbnail" src="{{ asset('imagens/aluno.png') }}" alt="{{ $show_nome }}"> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Nome:</th>
                                <td>{{ $show_nome }}</td>
                            </tr>
                            <tr>
                                <th>Matrícula:</th>
                                <td>{{ $show_matricula }}</td>
                            </tr>
                            <tr>
                                <th>Data de Nascimento:</th>
                                <td>{{date('d/m/Y', strtotime($show_data_nascimento ))}}</td>
                            </tr>
                            <tr>
                                <th>Sexo:</th>
                                <td>{{ $show_sexo }}</td>
                            </tr>
                            <tr>
                                <th>Telefone:</th>
                                <td>{{ $show_telefone }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $show_email }}</td>
                            </tr>
                            <tr>
                                <th>Responsável:</th>
                                <td>{{ $show_responsavel }}</td>
                            </tr>
                            <tr>
                                <th>Telefone do Responsável:</th>
                                <td>{{ $show_telefone_responsavel }}</td>
                            </tr>
                            <tr>
                                <th>Obeservações:</th>
                                <td>{{ $show_observacao }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal para deletar --}}
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" data-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Deletar Aluno</h5>
                    <button type="button" class="btn-close" wire:click="cancelDelete" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Tem certeza que deseja deletar os dados deste aluno?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="cancelDelete">Cancelar</button>
                    <button type="button" class="btn btn-danger" wire:click="destroy">Deletar</button>
                </div>
            </div>
        </div>
    </div>
</div>









  