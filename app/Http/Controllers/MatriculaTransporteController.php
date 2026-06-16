<?php

namespace App\Http\Controllers;

use App\Models\MatriculaTransporte;
use App\Models\Aluno;
use App\Models\Instituicao;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class MatriculaTransporteController extends Controller
{
    public function index()
    {
        $matriculas = MatriculaTransporte::with('aluno', 'instituicao', 'veiculo')->get();

        return view('matriculas.index', compact('matriculas'));
    }

    public function create()
    {
        return view('matriculas.create', [
            'alunos'      => Aluno::all(),
            'instituicoes' => Instituicao::all(),
            'veiculos'    => Veiculo::all(),
        ]);
    }

    public function store(Request $request)
    {
        if ($request->frequencia_semanal <= 3) {
            $valor = 420;
        } else {
            $valor = 530;
        }

        MatriculaTransporte::create([
            'aluno_id'          => $request->aluno_id,
            'instituicao_id'    => $request->instituicao_id,
            'veiculo_id'        => $request->veiculo_id,
            'turno'             => $request->turno,
            'dias_semana'       => $request->dias_semana,
            'frequencia_semanal' => $request->frequencia_semanal,
            'valor_subsidio'    => $valor,
            'status'            => true,
        ]);

        return redirect('/matriculas');
    }

    public function edit(MatriculaTransporte $matricula)
    {
        $alunos       = Aluno::all();
        $instituicoes = Instituicao::all();
        $veiculos     = Veiculo::all();

        return view('matriculas.edit', compact('matricula', 'alunos', 'instituicoes', 'veiculos'));
    }

    public function update(Request $request, MatriculaTransporte $matricula)
    {
        if ($request->frequencia_semanal <= 3) {
            $valor = 420;
        } else {
            $valor = 530;
        }

        $matricula->update([
            'aluno_id'          => $request->aluno_id,
            'instituicao_id'    => $request->instituicao_id,
            'veiculo_id'        => $request->veiculo_id,
            'turno'             => $request->turno,
            'dias_semana'       => $request->dias_semana,
            'frequencia_semanal' => $request->frequencia_semanal,
            'valor_subsidio'    => $valor,
        ]);

        return redirect('/matriculas');
    }

    public function destroy(MatriculaTransporte $matricula)
    {
        $matricula->delete();

        return redirect('/matriculas');
    }
}
