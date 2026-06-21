<?php

namespace App\Http\Controllers;

use App\Models\MatriculaTransporte;
use Mpdf\Mpdf;

class RelatorioController extends Controller
{
    public function pdf()
    {
        $matriculas = MatriculaTransporte::with(['aluno', 'instituicao', 'veiculo'])
            ->where('status', true)
            ->orderBy('created_at')
            ->get();

        $totalAlunos   = $matriculas->count();
        $valorTotal    = $matriculas->sum('valor_subsidio');
        $dataGeracao   = now()->format('d/m/Y H:i');
        $mesReferencia = now()->translatedFormat('F \d\e Y');

        $html = view('relatorio_alunos', compact(
            'matriculas',
            'totalAlunos',
            'valorTotal',
            'dataGeracao',
            'mesReferencia'
        ))->render();

        $mpdf = new Mpdf([
            'format'        => 'A4-L', // A4 paisagem
            'margin_top'    => 12,
            'margin_bottom' => 12,
            'margin_left'   => 12,
            'margin_right'  => 12,
        ]);

        $mpdf->WriteHTML($html);

        return response($mpdf->Output('relatorio-transporte-escolar.pdf', 'I'))
            ->header('Content-Type', 'application/pdf');
    }
}