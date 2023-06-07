<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ocorrencia;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;

class OcorrenciaController extends Controller
{

    /**
     * index
     *
     * @param  Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $busca = request()->input('busca');

        $ocorrencias = Ocorrencia::query()
            // ->when($busca, function ($query, $busca) {
            //     $query->where(function ($query) use ($busca) {
            //         $query->where('nome', 'LIKE', '%' . $busca . '%')
            //             ->orWhere('observacao', 'LIKE', '%' . $busca . '%');
            //     });
            // })

            ->orderBy('created_at', 'DESC')
            ->paginate(4);

        return view('ocorrencia.lista-ocorrencia',  compact('ocorrencias', 'busca'));
    }


    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('ocorrencia.cadastro-ocorrencia');
    }


    /**
     * gerarPDF
     *
     * @param  Request $request
     * @param int|null $ocorrenciaId
     * @return void
     */
    public function gerarPDF(Request $request, $ocorrenciaId = null)
    {
        if (isset($ocorrenciaId)) {
            $ocorrencias = Ocorrencia::where('id', $ocorrenciaId)->get();
        } else {
            $ocorrencias = Ocorrencia::all();
        }

        $html = $this->tabelaPDF($ocorrencias);

        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');

        return $pdf->stream('relatorio.pdf');
    }


    /**
     * tabelaPDF
     *
     * @param App\Models\Ocorrencia $ocorrencias
     * @return string $html
     */
    private function tabelaPDF($ocorrencias)
    {
        $html = '
        <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }

                    h4 {
                        color:#363636;
                        font-size: 0.75rem;
                        margin: 0rem 0rem 0rem 0rem; /* superior direito inferior esquerdo */
                    }

                    span {
                        color:#696969;
                        font-size: 0.75rem;
                    }

                    table {
                        border: 1px solid #696969;
                        border-collapse: collapse;
                        margin: 30px 0px 30px 0px; /* superior direito inferior esquerdo */
                        padding: 5px;
                    }

                    td {
                        padding: 8px;
                        vertical-align: top;
                    }
                </style>
            </head>
            <body>';

        foreach ($ocorrencias as $ocorrencia) {

            $imgSrc = isset($ocorrencia->aluno->foto) ? public_path('storage/' . $ocorrencia->aluno->foto) : public_path('imagens/aluno.png');

            $html .= '
            <table>
                <tr>
                    <td width="5%">
                        <h4>Foto</h4>
                        <img style="width: 4.0rem" class="img-thumbnail"
                        src="' . $imgSrc . '" alt="' . $ocorrencia->aluno->nome . '">
                    </td>
                    <td width="15%">
                        <h4>Nome do Aluno</h4>
                        <span>' . $ocorrencia->aluno->nome . '</span>
                    </td>
                    <td width="25%">
                        <h4>Turma</h4>
                        <span>'  . $ocorrencia->turma->etapa_modalidade . ' - ' . $ocorrencia->turma->curso . ' - ' . $ocorrencia->turma->modulo_serie . '</span>
                    </td>
                    <td width="15%">
                        <h4>Disciplina</h4>
                        <span>'  . $ocorrencia->disciplina->nome . '</span>
                    </td>
                    <td width="30%">
                        <h4>Tipo</h4>
                        <span>'  . $ocorrencia->tipo . '</span>
                    </td>
                    <td width="10%">
                        <h4>Data</h4>
                        <span>'  . date('d/m/Y', strtotime($ocorrencia->data)) . '</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h4>Encaminhada Por</h4>
                        <span>'  . $ocorrencia->servidor->nome . '(' . $ocorrencia->servidor->tipo . ')' . '</span>
                    </td>
                    <td>
                        <h4>Setor Encaminhado</h4>
                        <span>'  . $ocorrencia->setor_encaminhado . '</span>
                    </td>
                    <td colspan="3">
                        <h4>Descrição</h4>
                        <span>'  . $ocorrencia->descricao . '</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h4>Medida Adotada</h4>
                        <span>'  . $ocorrencia->medida_adotada . '</span>
                    </td>
                    <td colspan="3">
                        <h4>Obeservações</h4>
                        <span>' . $ocorrencia->observacao . '</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <h4>Dados do Registro</h4>
                        <span>'  .  $ocorrencia->usuario->name  . ' em ' . $ocorrencia->created_at->format('d/m/Y H:i:s') . '</span>
                    </td>
                </tr>
            </table>';
        }

        $html .= '
            </body>
        </html>';

        return $html;
    }

}
