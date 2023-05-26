<form method="POST" wire:submit.prevent="save" enctype="multipart/form-data">
    <div class="row">
        <!-- Dados do Aluno -->
        <span class="fw-bold mb-2">Dados do Aluno</span>
        <span class="border-bottom mx-1"></span>
        <div class="col-sm-1 my-2">
            @php
                if (!empty($aluno->foto)) {
                    $localFoto = url("storage/{$aluno->foto}");
                } else {
                    $localFoto = asset('imagens/aluno.png');
                }
            @endphp
            <img style="width:75px; background-color:#e9ecef;" class="img-thumbnail" src="{{ $localFoto }}"
                alt="Foto do Aluno">
        </div>
        <div class="col-sm-3 my-2">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" value="{{ !empty($aluno->nome) ? $aluno->nome : '' }}" disabled>
        </div>
        <div class="col-sm-3 my-2">
            <label class="form-label">Matrícula <span class="text-danger fw-bold">*</span></label>
            <input type="text" class="form-control @error('matricula') is-invalid @enderror" maxLength="14"
                placeholder="Informe a matrícula do aluno" wire:model.lazy="matricula" autofocus>
            @error('matricula')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-3 my-2">
            <label class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control "
                value="{{ !empty($aluno->data_nascimento) ? $aluno->data_nascimento : '' }}" disabled>
        </div>
        <div class="col-sm-2 my-2">
            <label class="form-label">Sexo</label><br>
            <div class="form-check form-check-inline me-1">
                <label class="form-check-label" for="inlineRadio1">Feminino</label>
                <input class="form-check-input" type="radio" id="inlineRadio1"
                    {{ !empty($aluno->sexo) && $aluno->sexo == 'Feminino' ? 'checked' : '' }} disabled>
            </div>
            <div class="form-check form-check-inline me-1">
                <label class="form-check-label" for="inlineRadio2">Masculino</label>
                <input class="form-check-input" type="radio" id="inlineRadio2"
                    {{ !empty($aluno->sexo) && $aluno->sexo == 'Masculino' ? 'checked' : '' }} disabled>
            </div>
            <div class="form-check form-check-inline me-1">
                <label class="form-check-label" for="inlineRadio3">Outros</label>
                <input class="form-check-input " type="radio" id="inlineRadio3"
                    {{ !empty($aluno->sexo) && $aluno->sexo == 'Outros' ? 'checked' : '' }} disabled>
            </div>
        </div>
        <!------------------------->

        <!-- Dados da Ocorrência -->
        <span class="fw-bold my-2">Dados da Ocorrência</span>
        <span class="border-bottom mx-1"></span>
        <div class="col-sm-4 my-2">
            <label class="form-label">Turma <span class="text-danger fw-bold">*</span></label>
            <select class="form-select @error('ocorrencia.turma_id') is-invalid @enderror"
                wire:model.lazy="ocorrencia.turma_id" {{ !$disabled ? 'disabled' : '' }}>
                <option value="" selected>Selecione...</option>
                @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}">
                        {{ $turma->etapa_modalidade }}
                        | {{ $turma->modulo_serie }}
                        | {{ $turma->curso }}
                    </option>
                @endforeach
            </select>
            @error('ocorrencia.turma_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-3 my-2">
            <label class="form-label">Bolsa do aluno</label>
            <select class="form-select" wire:model.lazy="ocorrencia.bolsa_aluno" {{ !$disabled ? 'disabled' : '' }}>
                <option value="" selected>Selecione...</option>
                <option value="PBP - Programa bolsa permanência">PBP - Programa bolsa permanência</option>
                <option value="PNAES - Programa nancional de assistência estudantil">
                    PNAES - Programa nancional de assistência estudantil
                </option>
            </select>
        </div>
        <div class="col-sm-3 my-2">
            <label class="form-label">Disciplina em que houve a ocorrência
                <span class="text-danger fw-bold">*</span></label>
            <select class="form-select @error('ocorrencia.disciplina_id') is-invalid @enderror"
                wire:model.lazy="ocorrencia.disciplina_id" {{ !$disabled ? 'disabled' : '' }}>
                <option value="" selected>Selecione...</option>
                @foreach ($disciplinas as $disciplina)
                    <option value="{{ $disciplina->id }}">
                        {{ $disciplina->nome }}
                    </option>
                @endforeach
            </select>
            @error('ocorrencia.disciplina_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-2 my-2">
            <label class="form-label">Data da corrência <span class="text-danger fw-bold">*</span></label>
            <input type="date" class="form-control  @error('ocorrencia.data') is-invalid @enderror"
                wire:model.lazy="ocorrencia.data" {{ !$disabled ? 'disabled' : '' }}>
            @error('ocorrencia.data')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-4 my-2">
            <label class="form-label">Tipo da Ocorrência <span class="text-danger fw-bold">*</span></label>
            <select class="form-select  @error('ocorrencia.tipo') is-invalid @enderror"
                wire:model.lazy="ocorrencia.tipo" {{ !$disabled ? 'disabled' : '' }}>
                <option value="" selected>Selecione...</option>
                <option value="Agressão Física">Agressão Física</option>
                <option value="Agressão Verbal">Agressão Verbal</option>
                <option value="Dano ao Patrimônio">Dano ao Patrimônio</option>
                <option value="Desrespeito ao Colega">Desrespeito ao Colega</option>
                <option value="Desrespeito ao Professor/Servidor">Desrespeito ao Professor/Servidor</option>
                <option value="Desobediência">Desobediência</option>
                <option value="Mal Comportamento">Mal Comportamento</option>
                <option value="Não Assíduo">Não Assíduo</option>
                <option value="Outros">Outros (especificar em observações)</option>
            </select>
            @error('ocorrencia.tipo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-sm-3 my-2">
            <label class="form-label">Ocorrência encaminhada por
                <span class="text-danger fw-bold">*</span></label>
            <select class="form-select @error('ocorrencia.servidor_id') is-invalid @enderror"
                wire:model.lazy="ocorrencia.servidor_id" {{ !$disabled ? 'disabled' : '' }}>
                <option value="" selected>Selecione...</option>
                @foreach ($servidores as $servidor)
                    <option value="{{ $servidor->id }}">
                        {{ $servidor->nome }}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;({{ $servidor->tipo }})
                    </option>
                @endforeach
                <option value="10">
            </select>
            @error('ocorrencia.servidor_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-sm-5 my-2">
            <label class="form-label">Setor encaminhado <span class="text-danger fw-bold">*</span></label>
            <select class="form-select  @error('ocorrencia.setor_encaminhado') is-invalid @enderror"
                wire:model.lazy="ocorrencia.setor_encaminhado" {{ !$disabled ? 'disabled' : '' }}>
                <option value="" selected>Selecione...</option>
                <option value="CAE-Coordenação de Assistência ao Estudante">
                    CAE - Coordenação de Assistência ao Estudante
                </option>
                <option value="CDD - Conselho disciplinar discente">
                    CDD - Conselho disciplinar discente
                </option>
                <option value="CCTS - Coordenação de cursos técnicos subsequentes">
                    CCTS - Coordenação de cursos técnicos subsequentes
                </option>
                <option value="CCTAEM - Coordenação do curso técnico em Administração integrado ao ensino médio">
                    CCTAEM - Coordenação do curso técnico em Administração integrado ao ensino médio
                </option>
                <option
                    value="CCTIEM - Coordenação do curso técnico em Informática para internet integrado ao ensino médio">
                    CCTIEM - Coordenação do curso técnico em Informática para internet integrado ao ensino médio
                </option>
                <option value="CCTMA - Coordenação do curso técnico em Meio Ambiente integrado ao ensino médio">
                    CCTMA - Coordenação do curso técnico em Meio Ambiente integrado ao ensino médio</option>
                <option value="CORES-Coordenação de Registros Escolares">
                    CORES - Coordenação de Registros Escolares
                </option>
                <option value="COTEPE-Coordenação Técnico-pedagógica">
                    COTEPE - Coordenação Técnico-pedagógica
                </option>
                <option value="GEREN - Gerência de ensino">
                    GEREN - Gerência de ensino
                </option>
            </select>
            @error('ocorrencia.setor_encaminhado')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-sm-12 my-2">
            <label class="form-label">Descreva a Ocorrência <span class="text-danger fw-bold">*</span></label>
            <textarea wire:model.lazy="ocorrencia.descricao" {{ !$disabled ? 'disabled' : '' }}
                class="form-control  @error('ocorrencia.descricao') is-invalid @enderror" rows="3">
            </textarea>
            @error('ocorrencia.descricao')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-sm-12 my-2">
            <label class="form-label">Medida adotada <span class="text-danger fw-bold">*</span></label>
            <textarea wire:model.lazy="ocorrencia.medida_adotada" {{ !$disabled ? 'disabled' : '' }}
                class="form-control  @error('ocorrencia.medida_adotada') is-invalid @enderror" rows="3">
            </textarea>
            @error('ocorrencia.medida_adotada')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-sm-12 my-2">
            <label class="form-label">Observações</label>
            <textarea wire:model.lazy="ocorrencia.observacao" {{ !$disabled ? 'disabled' : '' }}
                class="form-control  @error('ocorrencia.observacao') is-invalid @enderror" rows="3">
            </textarea>
            @error('ocorrencia.observacao')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <!------------------------->
    </div>
    <div class=" my-3 float-end ">
        <button wire:click="save" type="submit" class="btn btn-success btn-fixed-size" wire:loading.attr="disabled"
            {{ !$disabled ? 'disabled' : '' }}>
            {{-- Texto padrão do botão --}}
            <span wire:click="save" wire:loading.remove.delay.shortest>Salvar</span>
            {{-- Efeito de carregamento quando o butão é acionado --}}
            <span wire:click="save" wire:loading.delay.shortest class="spinner-border spinner-border-sm text-white"
                role="status"></span>
        </button>
    </div>
</form>
