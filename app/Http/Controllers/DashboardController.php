<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Veiculo;
use App\Models\Instituicao;
use App\Models\MatriculaTransporte;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlunos           = Aluno::count();
        $totalVeiculos         = Veiculo::count();
        $totalInstituicoes     = Instituicao::count();
        $totalMatriculas       = MatriculaTransporte::count();
        $totalMatriculasAtivas = MatriculaTransporte::where('status', true)->count();
        $valorTotalMensal      = MatriculaTransporte::where('status', true)->sum('valor_subsidio');

        $matriculas = MatriculaTransporte::with(['aluno', 'instituicao', 'veiculo'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact(
            'totalAlunos',
            'totalVeiculos',
            'totalInstituicoes',
            'totalMatriculas',
            'totalMatriculasAtivas',
            'valorTotalMensal',
            'matriculas'
        ));
    }
}