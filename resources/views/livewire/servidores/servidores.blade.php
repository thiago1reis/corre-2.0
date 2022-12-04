<div class="container-fluid">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 mb-2">
        <button wire:click="showModal('Adicionar')" type="button" class="btn btn-primary float-end"><i class="icofont-ui-add"></i> Adicionar</button>
    </div>
    <fieldset class="border border-secondary p-3 mb-3">
        <legend  class="float-none w-auto">Servidores Adicionados</legend>
        <form>
            <div class="mb-3 g-3 row">
                <div class="col-sm-6 col-md-10 col-lg-10 col-xl-10">
                    <input type="text" class="form-control" id="search " name="search " wire:model="search" placeholder="Busque por nome ou tipo">
                </div>
                <div class="col-sm-6 col-md-1 col-lg-1 col-xl-1">
                    <button type="submit" class="btn btn-primary btn-search-fixed-size" title="Filtrar"><i class="icofont-ui-search"></i></button>
                </div>
                <div class="col-sm-6 col-md-1 col-lg-1 col-xl-1">
                    <button type="submit" class="btn btn-primary btn-search-fixed-size" title="Limpar Filtro"disabled><i class="icofont-ui-reply"></i></button>
                </div>
            </div>    
        </form>    
        @include('layouts.alertas') 
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
                            <td class="align-middle">{{ $servidor->observacao }}</td> 
                            <td class="align-middle"> 
                                <a type="button" wire:click="showModal('Editar', {{ $servidor->id }})" class="me-3 link-secondary text-decoration-none"><i title="Editar Dados" class="icofont-ui-edit"></i></a>
                                <a type="button" wire:click="deleteConfirm('Editar', {{ $servidor->id}})" class="me-3 link-secondary text-decoration-none"><i title="Deletar Registro" class="icofont-ui-delete"></i></a> 
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
    {{-- Modal Adicionar --}}
    @include('livewire.servidores.modal-adicionar-servidor') 
    @include('livewire.servidores.modal-editar-servidor') 
</div>