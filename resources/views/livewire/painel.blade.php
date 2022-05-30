@include('layouts.cabecalho')
@include('layouts.menu')
<div class="pagina-login container">
    <p>{{ $menssagem }}</p>
    <input type="text" name="menssagem" id="menssagem" wire:model="menssagem">
</div>
@include('layouts.rodape')