<div class="container-fluid">
    <fieldset class="border border-secondary p-3 mb-3">
        <legend  class="float-none w-auto">Adicionar Aluno</legend>
        <form method="POST" wire:submit.prevent="store">
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
                        <button type="button" class="btn btn-outline-primary " wire:loading.attr="disabled" wire:loading.class.remove="btn-outline-primary" wire:loading.class="btn-outline-secondary">Importar</button>
                        <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:loading.class.remove="btn-success" wire:loading.class="btn-secondary">Adicionar</button>
                    </div>
                </div>
            </div>
        </form> 
    </fieldset>

    <fieldset class="border border-secondary p-3 mb-3">
        <legend  class="float-none w-auto">Alunos Adicionados</legend> 
            @foreach ($alunos as $aluno)
                {{ $aluno->nome }}<br>
            @endforeach
    </fieldset>
</div>
<script>
    function previewImagem()
    {
        var foto = document.querySelector('input[name=foto]').files[0];                                            
        var preview = document.querySelector('#previewFoto');           
        var reader = new FileReader();        
        reader.onloadend = function () {preview.src = reader.result;}           
        if(foto){reader.readAsDataURL(foto);}                                    
        else{preview.src = "";}
    }
</script>



