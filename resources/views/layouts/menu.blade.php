<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-lg-0">
                <li class="nav-item pe-3">
                    <a class="nav-link" aria-current="page" href="{{ route('painel') }}"><i class="icofont-ui-home"></i>
                        Início</a>
                </li>
                @if (auth()->user()->tipo == 1)
                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="icofont-ui-add"></i>
                            Adicionar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('aluno.index') }}">Alunos</a></li>
                            <li><a class="dropdown-item" href="{{ route('disciplina.index') }}">Disciplinas</a></li>
                            <li><a class="dropdown-item" href="{{ route('servidor.index') }}">Servidores</a></li>
                            <li><a class="dropdown-item" href="{{ route('turma.index') }}">Turmas</a></li>
                            <li><a class="dropdown-item" href="{{ route('usuario.index') }}">Usuários</a></li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item pe-3">
                    <a class="nav-link" href="{{ route('ocorrencia.create') }}"><i class="icofont-ui-note"></i> Cadastar
                        Ocorrência</a>
                </li>
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="icofont-ui-search"></i>
                        Consultar
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('aluno.show') }}">Aluno</a></li>
                        <li><a class="dropdown-item" href="{{ route('ocorrencia.index') }}">Ocorrências</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="icofont-ui-user"></i>
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('usuario.edit', ['usuario' => auth()->user()->id]) }}">
                                    Configurações
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    Sair
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
