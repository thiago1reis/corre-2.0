<div class="container my-5 ">
    <div class="d-flex align-items-center justify-content-center ">
        <div class="formulario-login">
            <fieldset class="border border-secondary p-3">
                @include('layouts.alertas')
                <legend class="float-none w-auto">Acessar o Sistema</legend>
                <form method="POST" wire:submit.prevent="login">
                    <div class="mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="Digite o e-mail" wire:model="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password"name="password" placeholder="Digie a senha" wire:model="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="d-grid mb-3">
                        <button wire:target="login" type="submit" class="btn btn-success" wire:loading.attr="disabled">
                            {{-- Texto padrão do botão --}}
                            <span wire:target="login" wire:loading.remove.delay.shortest>Entrar</span>
                            {{-- Efeito de carregamento quando o butão é acionado --}}
                            <div wire:target="login" wire:loading.delay.shortest
                                class="spinner-border spinner-border-sm text-white" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </fieldset>
        </div>


    </div>
</div>
