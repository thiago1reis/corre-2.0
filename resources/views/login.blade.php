@extends('parts._layout')
@section('content')
@include('parts.cabecalho')
<div class="grid-container">
    <div class="grid-x grid-padding-x margin-top-3 margin-bottom-3">
        <div class="medium-4 cell">
           {{-- Lado Esquerdo --}}
        </div>
        <div class="medium-4 cell">
            <fieldset class="fieldset">
                <legend>Acessar Sistema</legend>
                <form>
                    <div class="grid-container">
                      <div class="grid-x grid-padding-x">
                        <div class="medium-12 cell">
                          <label>E-mail
                            <input type="text" placeholder="Digite o e-mail">
                          </label>
                        </div>
                        <div class="medium-12 cell">
                          <label>Senha
                            <input type="password" placeholder="Digie a senha">
                          </label>
                        </div>
                        <div class="medium-12 cell">
                            <input type="submit" class="button expanded success " value="Entrar"> 
                        </div>
                      </div>
                    </div>
                </form>
            </fieldset>
        </div>
        <div class="medium-4 cell">
           {{-- Lado Direito --}}
        </div>
    </div> 
</div>
@include('parts.rodape')
@endsection
