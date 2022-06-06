<div class="container-fluid">
    <fieldset class="border border-secondary p-3 mb-3">
        <legend  class="float-none w-auto">Adicionar Aluno</legend>
        <div>
            {{--Alerta de Sucesso --}}
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <strong>Tudo certo!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
             {{--Alerta de Aviso --}}
            @if (session('attention'))
                <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
                    <strong>Atenção!</strong> {{ session('attention') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{--Alerta de Erro --}}
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    <strong>Erro!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <form method="POST" wire:submit.prevent="store">
            <div class="row">
                <div class="col-sm-2">
                    <div class="my-2">
                        <label for="foto" class="form-label">Foto:</label>
                        <input class="form-control" type="file" id="foto" name="foto" wire:model="foto" >
                        @error('foto')<span class="text-danger" >{{$message}}</span>@enderror
                        @if($foto)
                            <img class="figure-img img-fluid rounded border mt-4" alt="Foto do Aluno" src="{{ $foto->temporaryUrl() }}">
                            <figcaption class="figure-caption text-end">Prévia da foto.</figcaption>
                        @else
                            <img class="figure-img img-fluid rounded border mt-4 bg-white" alt="Foto do Aluno" src="{{ asset('imagens/aluno.png') }}">
                        @endif
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-4 my-2">
                            <label for="nome" class="form-label">Nome: <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control" id="nome" name="nome" wire:model="nome" placeholder="Digite o nome do aluno">
                            @error('nome')<span class="text-danger" >Este campo é obrigatório</span>@enderror
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="matricula" class="form-label">Matrícula: <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control" id="matricula" name="matricula" wire:model="matricula" placeholder="Digite a matrícula do aluno">
                            @error('matricula')<span class="text-danger" >Este campo é obrigatório</span>@enderror
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="data_nascimento" class="form-label">Data de Nascimento: <span class="text-danger fw-bold">*</span></label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" wire:model="data_nascimento">
                            @error('data_nascimento')<span class="text-danger" >Este campo é obrigatório</span>@enderror
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="sexo" class="form-label">Sexo: <span class="text-danger fw-bold">*</span></label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sexo" id="inlineRadio1" wire:model="sexo" value="Feminino">
                                <label class="form-check-label" for="inlineRadio1">Feminino</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sexo" id="inlineRadio2" wire:model="sexo" value="Masculino">
                                <label class="form-check-label" for="inlineRadio2">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sexo" id="inlineRadio3" wire:model="sexo" value="Outros" >
                                <label class="form-check-label" for="inlineRadio3">Outros</label>
                            </div><br>
                            @error('sexo')<span class="text-danger" >Este campo é obrigatório</span>@enderror    
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
                    <div class=" my-3 float-end ">
                        {{-- Efeite de carregamento quando enviar o formulário--}}
                        <div wire:loading.delay.shortest class="spinner-border spinner-border-sm text-secondary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        {{-- Frase de carregamento quando enviar o formulário--}}
                        <span class="text-secondary " wire:loading.delay.shortest>Carregando...</span> <!-- 50ms -->
                        {{-- botões do formulário --}}
                        <button type="button" class="btn btn-outline-primary " wire:loading.remove><i class="icofont-ui-file"></i> Importar</button>
                        <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:loading.class.remove="btn-success" wire:loading.class="btn-secondary">Adicionar</button>
                    </div>
                </div>
            </div>
        </form> 
    </fieldset>
    <fieldset class="border border-secondary p-3 mb-3">
        <legend  class="float-none w-auto">Alunos Adicionados</legend> 
        <div>
            {{--Alerta de Sucesso --}}
            @if (session()->has('successList'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <strong>Tudo certo!</strong> {{ session('successList') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
             {{--Alerta de Aviso --}}
            @if (session('attentionList'))
                <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
                    <strong>Atenção!</strong> {{ session('attentionList') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{--Alerta de Erro --}}
            @if (session()->has('errorList'))
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    <strong>Erro!</strong> {{ session('errorList') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>   
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
                                    {{-- <a href="#" class="me-3 link-secondary text-decoration-none"><i title="Informações Datalhadas " class="icofont-ui-zoom-in"></i></a> 
                                     --}}
                                    <a type="button" wire:click="edit({{ $aluno->id }})" data-bs-toggle="modal" data-bs-target="#exampleModal" class="me-3 link-secondary text-decoration-none"><i title="Editar Dados" class="icofont-ui-edit"></i></a> 
                                    <a type="button" wire:click="destroy({{ $aluno->id }})" class="me-3 link-secondary text-decoration-none"><i title="Deletar Registro" class="icofont-ui-delete"></i></a> 
                              </td> 
                            </tr>
                            @endforeach
                          </tbody>
                    </table>
                </div>
            </div> 
    </fieldset>
</div>

  <!-- Modal de edição dos dados-->
  <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <form method="POST" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Dados</h5>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="my-2">
                            <label for="foto" class="form-label">Foto:</label>
                            <input class="form-control" type="file" id="foto" name="foto" wire:model="foto" >
                            @error('foto')<span class="text-danger" >{{$message}}</span>@enderror
                            @if($foto)
                                <img class="figure-img img-fluid rounded border mt-4" alt="Foto do Aluno" src="{{ $foto->temporaryUrl() }}">
                                <figcaption class="figure-caption text-end">Prévia da foto.</figcaption>
                            @else
                                <img class="figure-img img-fluid rounded border mt-4 bg-white" alt="Foto do Aluno" src="{{ asset('imagens/aluno.png') }}">
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-4 my-2">
                                <label for="nome" class="form-label">Nome: <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control" id="nome" name="nome" wire:model="nome" placeholder="Digite o nome do aluno">
                                @error('nome')<span class="text-danger" >Este campo é obrigatório</span>@enderror
                            </div>

                            <div class="col-sm-4 my-2">
                                <label for="matricula" class="form-label">Matrícula: <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control" id="matricula" name="matricula" wire:model="matricula" placeholder="Digite a matrícula do aluno">
                                @error('matricula')<span class="text-danger" >Este campo é obrigatório</span>@enderror
                            </div>

                            <div class="col-sm-4 my-2">
                                <label for="data_nascimento" class="form-label">Data de Nascimento: <span class="text-danger fw-bold">*</span></label>
                                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" wire:model="data_nascimento">
                                @error('data_nascimento')<span class="text-danger" >Este campo é obrigatório</span>@enderror
                            </div>

                            <div class="col-sm-4 my-2">
                                <label for="sexo" class="form-label">Sexo: <span class="text-danger fw-bold">*</span></label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="inlineRadio1" wire:model="sexo" value="Feminino">
                                    <label class="form-check-label" for="inlineRadio1">Feminino</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="inlineRadio2" wire:model="sexo" value="Masculino">
                                    <label class="form-check-label" for="inlineRadio2">Masculino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="inlineRadio3" wire:model="sexo" value="Outros" >
                                    <label class="form-check-label" for="inlineRadio3">Outros</label>
                                </div><br>
                                @error('sexo')<span class="text-danger" >Este campo é obrigatório</span>@enderror    
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
                        <div class=" my-3 float-end ">
                            {{-- Efeite de carregamento quando enviar o formulário--}}
                            <div wire:loading.delay.shortest class="spinner-border spinner-border-sm text-secondary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            {{-- Frase de carregamento quando enviar o formulário--}}
                            <span class="text-secondary " wire:loading.delay.shortest>Carregando...</span> <!-- 50ms -->
                            {{-- botões do formulário --}}
                            @if($alter)
                                <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:loading.class.remove="btn-success" wire:loading.class="btn-secondary">Salvar</button>
                            @endif
                            
                            <button type="button" class="btn btn-danger" wire:loading.attr="disabled" wire:loading.class.remove="btn-danger" wire:loading.class="btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          
                            <button class="btn btn-primary"  wire:click="alter" >Editar</button>
                           
                            
                        </div>
                    </div>
                </div>
            </div>
        </form> 
        
        

       

         
       


      </div>
    </div>
  </div>



