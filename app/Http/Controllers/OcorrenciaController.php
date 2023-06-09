<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ocorrencia;
use App\Services\BuscaOcorrenciaService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OcorrenciaController extends Controller
{
    protected BuscaOcorrenciaService $buscaOcorrenciaService;

    public function __construct(BuscaOcorrenciaService $buscaOcorrenciaService)
    {
        $this->buscaOcorrenciaService = $buscaOcorrenciaService;
    }



    /**
     * index
     *
     * @param  Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $busca = request()->input('busca');

        $ocorrencias =  $this->buscaOcorrenciaService->buscar($busca)->paginate(4);

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
     * @param string|int|null $ocorrenciaId
     * @return void
     */
    public function gerarPDF($ocorrenciaIdOrBusca = null)
    {

        if (is_numeric($ocorrenciaIdOrBusca)) {
            $ocorrencias = Ocorrencia::where('id', $ocorrenciaIdOrBusca)->get();
        } else {
            $ocorrencias = $this->buscaOcorrenciaService->buscar($ocorrenciaIdOrBusca)->get();
        }

        if ($ocorrencias->count() <= 0) {
            return redirect()->back()->with('error', 'Não foram encontrados dados para gerar o relatório!');
        }

        $html = $this->tabelaPDF($ocorrencias);
        $pdf = PDF::loadHTML($html)->setPaper('a4');
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
                @page {
                    margin-top: 3cm;
                    margin-left: 3cm;
                    margin-right: 2cm;
                    margin-bottom: 2cm;
                }

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
                        border: 1px solid transparent;	;
                        border-collapse: collapse;
                        margin: 0px 0px 20px 0px; /* superior direito inferior esquerdo */
                        padding: 5px;
                    }

                    tr {
                        margin: 10px 0px 10px 0px; /* superior direito inferior esquerdo */
                    }
                    td {
                        padding: 8px;
                        vertical-align: top;
                    }

                    .page-break {
                        page-break-after: always;
                    }
                </style>
            </head>
            <body>';

        foreach ($ocorrencias as $index => $ocorrencia) {

            $semDados = "-";

            $imgSrc = isset($ocorrencia->aluno->foto) ? public_path('storage/' . $ocorrencia->aluno->foto) : public_path('imagens/aluno.png');

            $html .= '
            <table>
                <tr>
                    <td width="5%">
                        <h4>Foto</h4>
                        <img style="width: 4.0rem" class="img-thumbnail"
                        src="' . $imgSrc . '" alt="' . $ocorrencia->aluno->nome . '">
                    </td>
                    <td width="25%">
                        <h4>Nome</h4>
                        <span>' . $ocorrencia->aluno->nome . '</span>
                    </td>
                    <td width="25%">
                        <h4>Matrícula</h4>
                        <span>' . $ocorrencia->aluno->matricula . '</span>
                    </td>
                    <td width="25%">
                        <h4>Data de Nascimento</h4>
                        <span>'  . date('d/m/Y', strtotime($ocorrencia->aluno->data_nascimento)) . '</span>
                    </td>
                    <td width="20%">
                        <h4>Sexo</h4>
                        <span>' . $ocorrencia->aluno->sexo . '</span>
                    </td>
                </tr>

                <tr>
                    <td colspan="3">
                        <h4>Turma</h4>
                        <span>' . $ocorrencia->turma->etapa_modalidade . ' - ' . $ocorrencia->turma->curso . ' - ' . $ocorrencia->turma->modulo_serie . '</span>
                    </td>
                    <td colspan="2">
                        <h4>Bolsa do Aluno</h4>
                        <span>' . ($ocorrencia->bolsa_aluno != null ? $ocorrencia->bolsa_aluno : $semDados) . '</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h4>Disciplina</h4>
                        <span>'  . $ocorrencia->disciplina->nome . '</span>
                    </td>
                    <td>
                        <h4>Data</h4>
                        <span>'  . date('d/m/Y', strtotime($ocorrencia->data)) . '</span>
                    </td>
                    <td colspan="2">
                        <h4>Tipo</h4>
                        <span>'  . $ocorrencia->tipo . '</span>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <h4>Encaminhada Por</h4>
                        <span>'  . $ocorrencia->servidor->nome . '(' . $ocorrencia->servidor->tipo . ')' . '</span>
                    </td>
                    <td colspan="3">
                        <h4>Setor Encaminhado</h4>
                        <span>'  . $ocorrencia->setor_encaminhado . '</span>
                    </td>
                </tr>

                <tr>
                    <td colspan="5">
                        <h4>Descrição</h4>
                        <span>'  . $ocorrencia->descricao . '</span>
                    </td>
                </tr>

                <tr>
                    <td colspan=5">
                        <h4>Medida Adotada</h4>
                        <span>'  . $ocorrencia->medida_adotada . '</span>
                    </td>
                </tr>

                <tr>
                    <td colspan=5" >
                        <h4>Obeservações</h4>
                        <span>' . ($ocorrencia->observacao != null ? $ocorrencia->observacao : $semDados) . '</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <h4>Dados do Registro</h4>
                        <span>' .  $ocorrencia->usuario->name  . ' em ' . $ocorrencia->created_at->format('d/m/Y H:i:s') . '</span>
                    </td>
                </tr>
            </table>';

            if ($index < $ocorrencias->count() - 1) {
                $html .= '<div class="page-break"></div>';
            }
        }

        $html .= '
            </body>
        </html>';

        return $html;
    }

}
