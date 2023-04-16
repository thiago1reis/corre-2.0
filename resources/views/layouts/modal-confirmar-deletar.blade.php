<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Deletar {{ $modulo }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3 text-center">
                <h3>Deseja realmente deletar?</h2>
            </div>
            <form method="POST" action="{{ $rota }}" id="confirm-form">
                @csrf
                @method('DELETE')
                <div class=" my-3 float-end ">
                    <button type="button" class="btn btn-outline-danger btn-fixed-size"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="confirm-button" class="btn btn-success btn-fixed-size">
                        {{-- Texto padrão do botão --}}
                        <span id="confirm-text">Confirmar</span>
                        {{-- Efeito de carregamento quando o botão é acionado --}}
                        <span id="confirm-spinner" class="spinner-border spinner-border-sm text-white" role="status"
                            style="display: none;"></span>
                    </button>
                </div>
            </form>
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
