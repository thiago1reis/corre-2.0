<div class="container-fluid">
    <fieldset class="border border-secondary p-3 mb-3">
        <legend  class="float-none w-auto">Disciplinas Adicionadas</legend>
        <input type="text" class="form-control 4 mb-3" id="search " name="search " wire:model="search" placeholder="Busque por nome">
        @include('layouts.alertas.alertasList') 
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="300">Nome</th>
                        <th width="300">Tipo</th>
                        <th width="500">Observações</th>
                        <th width="100">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if($servidores->count() > 0)
                        @foreach ($servidores as $servidor)
                        <tr class="text-nowrap bd-highlight">
                            <td class="align-middle">{{ $servidor->nome }}</td>
                            <td class="align-middle">{{ $servidor->tipo }}</td>
                            <td class="align-middle">{{ $disciplina->observacao }}</td> 
                            <td class="align-middle"> 
                                <a type="button" wire:click="selectEdit({{ $servidor->id }})" class="me-3 link-secondary text-decoration-none"><i title="Editar Dados" class="icofont-ui-edit"></i></a>
                                <a type="button" wire:click="deleteConfirm({{ $servidor->id }})" class="me-3 link-secondary text-decoration-none"><i title="Deletar Registro" class="icofont-ui-delete"></i></a> 
                            </td> 
                        </tr>
                        @endforeach
                    @else
                    <tr class="text-nowrap bd-highlight">
                        <td colspan="4"class="align-middle text-center">Nenhum registro encontrado.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            @if(isset($search))
            {{ $servidores->appends($search)->links() }}
            @else
            {{ $servidores->links() }}
            @endif 
        </div>
    </fieldset>
</div>