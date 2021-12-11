<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item px-3">
          <a class="nav-link" aria-current="page" href="#">Início</a>
        </li>
        <li class="nav-item dropdown px-3">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Adicionar
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Configurações</a></li>
            <li><a class="dropdown-item" href="#">Sair</a></li>
          </ul>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link" href="#">Cadastar Ocorrência</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link" href="#">Consultar Aluno</a>
        </li>
      </ul>
      <div class="d-flex">
        <ul class="navbar-nav">
          <li class="nav-item dropdown px-3">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Configurações</a></li>
              <li><a class="dropdown-item" href="#">Sair</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>