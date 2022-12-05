 {{-- Modal para vizualizar dados --}}
 <div wire:ignore.self class="modal fade" id="showModal" tabindex="-1" data-bs-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dados do Aluno</h5>
                <button type="button" class="btn-close" wire:click="closeShow" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Foto: </th>
                            <td> @if($show_foto)
                                <img style="width: 75px" class="img-thumbnail " src="{{ url("storage/{$show_foto}") }}"  alt="{{ $show_nome }}"> 
                                @else 
                                <img style="width: 75px" class="img-thumbnail" src="{{ asset('imagens/aluno.png') }}" alt="{{ $show_nome }}"> 
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Nome:</th>
                            <td>{{ $show_nome }}</td>
                        </tr>
                        <tr>
                            <th>Matrícula:</th>
                            <td>{{ $show_matricula }}</td>
                        </tr>
                        <tr>
                            <th>Data de Nascimento:</th>
                            <td>{{date('d/m/Y', strtotime($show_data_nascimento ))}}</td>
                        </tr>
                        <tr>
                            <th>Sexo:</th>
                            <td>{{ $show_sexo }}</td>
                        </tr>
                        <tr>
                            <th>Telefone:</th>
                            <td>{{ $show_telefone }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $show_email }}</td>
                        </tr>
                        <tr>
                            <th>Responsável:</th>
                            <td>{{ $show_responsavel }}</td>
                        </tr>
                        <tr>
                            <th>Telefone do Responsável:</th>
                            <td>{{ $show_telefone_responsavel }}</td>
                        </tr>
                        <tr>
                            <th>Obeservações:</th>
                            <td>{{ $show_observacao }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>