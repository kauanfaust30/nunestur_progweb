<?php

namespace App\Http\Controllers;

use App\Models\MatriculaTransporte;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioController extends Controller
{
    public function pdf()
    {
        $matriculas = MatriculaTransporte::with(['aluno', 'instituicao', 'veiculo'])
            ->where('status', true)
            ->orderBy('created_at')
            ->get();

        $totalAlunos    = $matriculas->count();
        $valorTotal     = $matriculas->sum('valor_subsidio');
        $dataGeracao    = now()->format('d/m/Y H:i');
        $mesReferencia  = now()->translatedFormat('F \d\e Y');

        $pdf = Pdf::loadView('relatorio_alunos', compact(
            'matriculas',
            'totalAlunos',
            'valorTotal',
            'dataGeracao',
            'mesReferencia'
        ))->setPaper('a4', 'landscape');

        return $pdf->stream('relatorio-transporte-escolar.pdf');
    }
}