<div>
    {{--Alerta de Sucesso na modal --}}
    @if (session()->has('successModal'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            <strong>Tudo certo!</strong> {{ session('successModal') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{--Alerta de aviso na modal --}}
    @if (session('attentionModal'))
        <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
            <strong>Atenção!</strong> {{ session('attentionModal') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{--Alerta de erro na modal  --}}
    @if (session()->has('errorModal'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            <strong>Erro!</strong> {{ session('errorModal') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>    