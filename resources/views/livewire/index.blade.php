<div class="pagina-login container">
  <div class="row">
    <div class="col-sm-6 col-md-12 col-lg-4">{{-- Lado esquerdo --}}</div>
    <div class="col-sm-6 col-md-12 col-lg-4"> 
      <fieldset class="border border-secondary p-3">
      {{--Alerta de Erro --}}
        @if (session('attention'))
          <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
            <strong>Atenção!</strong> {{ session('attention') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      {{--Alerta de Erro --}}
        @if($errors)
          @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
              <strong>{{ $error }}</strong> Verfique se o E-mail e a Senha foram digitados corretamente.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endforeach
        @endif
        <legend  class="float-none w-auto">Acessar o Sistema</legend>
        <form action="{{ route('login')}}" method="POST">
          @csrf
          <div class="mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail">
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="password"name="password" placeholder="Digie a senha">
          </div>
          <div class="d-grid mb-3">
            <button class="btn btn-success" type="submit">Entrar</button>
          </div>
        </form>
      </fieldset>
    </div>
    <div class="col-sm-6 col-md-12 col-lg-4">{{-- Lado direito --}}</div>
  </div>
</div> 