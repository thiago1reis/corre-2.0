@extends('layouts.app')

@section('titulo', 'Login')

@section('content')
    <div class="container my-5">
        <div class="d-flex align-items-center justify-content-center ">
            <div class="formulario-login">
                <fieldset class="border border-secondary p-3">
                    @include('layouts.alertas')
                    <legend class="float-none w-auto">Acessar o Sistema</legend>
                    <form action="{{ route('logar') }}" method="POST" id="confirm-form">
                        @csrf
                        <div class="mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Digite o e-mail" value="adm@corre.com">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Digie a senha" value="4a6d3m">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" id="confirm-button" class="btn btn-success">
                                {{-- Texto padrão do botão --}}
                                <span id="confirm-text">Entrar</span>
                                {{-- Efeito de carregamento quando o botão é acionado --}}
                                <span id="confirm-spinner" class="spinner-border spinner-border-sm text-white"
                                    role="status" style="display: none;"></span>
                            </button>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("confirm-form").addEventListener("submit", function() {
            var confirmButton = document.getElementById("confirm-button");
            var confirmText = document.getElementById("confirm-text");
            var confirmSpinner = document.getElementById("confirm-spinner");
            confirmButton.disabled = true;
            confirmText.style.display = "none";
            confirmSpinner.style.display = "inline-block";
        });
    </script>
@endsection
