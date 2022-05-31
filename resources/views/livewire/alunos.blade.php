
<div class="container-fluid">
    <fieldset class="border border-secondary p-3 mb-3">
        <legend  class="float-none w-auto">Adicionar Aluno</legend>
        <form method="POST" wire:submit.prevent="create">
            <div>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                        <strong>Tudo certo!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="my-2">
                        <label for="foto" class="form-label">Foto:</label>
                        <input class="form-control" type="file" id="foto" name="foto">
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-4 my-2">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" wire:model="nome" placeholder="Digite o nome do aluno">
                            @error('nome')<span class="text-danger" >{{ $message }}</span>@enderror
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="matricula" class="form-label">Matricula:</label>
                            <input type="text" class="form-control" id="matricula" name="matricula" wire:model="matricula" placeholder="Digite a matricula do aluno">
                            @error('matricula')<span class="text-danger" >{{ $message }}</span>@enderror
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" wire:model="data_nascimento">
                            @error('data_nascimento')<span class="text-danger" >{{ $message }}</span>@enderror
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="sexo" class="form-label">Sexo:</label><br>
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
                            @error('sexo')<span class="text-danger" >{{ $message }}</span>@enderror    
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="telefone" class="form-label">Telefone:</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" wire:model="telefone" placeholder="(00) 00000-0000">
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" wire:model="email" placeholder="nome@email.com">
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="responsavel" class="form-label">Responsável:</label>
                            <input type="text" class="form-control" id="responsavel" name="responsavel" wire:model="responsavel" placeholder="Digite o nome do responsável pelo aluno">
                        </div>

                        <div class="col-sm-4 my-2">
                            <label for="telefone_responsavel" class="form-label">Telefone do Responsável:</label>
                            <input type="text" class="form-control" id="telefone_responsavel" name="telefone_responsavel" wire:model="telefone_responsavel" placeholder="(00) 00000-0000">
                        </div>

                        <div class="col-sm-12 my-2">
                            <label for="observacao" class="form-label">Observações:</label>
                            <textarea class="form-control" id="observacao" name="observacao" wire:model="observacao" style="height: 100px"></textarea>
                        </div>

                    </div>
                </div>
                <div>
                    <button type="submit">Like Post</button>
                </div>
            </div>
        </form> 
    </fieldset>
</div>
<div class="container-fluid">
    <fieldset class="border border-secondary p-3 mb-3">
        <legend  class="float-none w-auto">Alunos Adicionados</legend> 
        
            @foreach ($alunos as $aluno)
                {{ $aluno->nome }}<br>
            @endforeach
    </fieldset>
</div>
