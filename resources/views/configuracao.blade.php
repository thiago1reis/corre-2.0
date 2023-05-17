@extends('layouts.app')

@section('titulo', 'Configurações')

@section('content')
    <div class="container-fluid">
        <fieldset class="border border-secondary p-3 my-3">
            <legend class="float-none w-auto">Configurações do Usuário</legend>
            @include('layouts.alertas')
            <form method="POST" action="{{ route('usuario.update') }}" id="confirm-form">
                @csrf
                @method('PUT')
                <div class="row">
                    <input type="hidden" name="id" value="{{ $usuario->id }}">
                    <div class="col-sm-4 my-2">
                        <label class="form-label">Nome <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name', $usuario->name) }}" placeholder="Informe o seu nome ">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 my-2">
                        <label class="form-label">Email <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email', $usuario->email) }}" placeholder="nome@email.com">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 my-2">
                        <label class="form-label">Senha </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="Informe uma senha, se desejar alterar a atual">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class=" my-3 float-end ">
                    <button type="submit" id="confirm-button" class="btn btn-success btn-fixed-size">
                        {{-- Texto padrão do botão --}}
                        <span id="confirm-text">Salvar</span>
                        {{-- Efeito de carregamento quando o botão é acionado --}}
                        <span id="confirm-spinner" class="spinner-border spinner-border-sm text-white" role="status"
                            style="display: none;"></span>
                    </button>
                </div>
            </form>
        </fieldset>
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
