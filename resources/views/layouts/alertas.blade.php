<div>
    {{--Alerta de Sucesso na lista de dados cadastrados --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            <strong>Tudo certo!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{--Alerta de aviso a lista de dados cadastrados --}}
    @if (session('attention'))
        <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
            <strong>Atenção!</strong> {{ session('attention') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{--Alerta de erro a lista de dados cadastrados  --}}
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            <strong>Erro!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>    