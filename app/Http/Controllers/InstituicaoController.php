<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    public function index(Request $request)
    {
        $instituicoes = Instituicao::when($request->busca, function ($query) use ($request) {
                $query->where('nome', 'like', '%' . $request->busca . '%');
            })
            ->get();

        return view('instituicoes.index', compact('instituicoes'));
    }

    public function create()
    {
        return view('instituicoes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'     => 'required',
            'endereco' => 'required',
        ]);

        Instituicao::create($request->all());

        return redirect('/instituicoes');
    }

    public function edit(Instituicao $instituicao)
    {
        return view('instituicoes.edit', compact('instituicao'));
    }

    public function update(Request $request, Instituicao $instituicao)
    {
        $instituicao->update($request->all());

        return redirect('/instituicoes');
    }

    public function destroy(Instituicao $instituicao)
    {
        $instituicao->delete();

        return redirect('/instituicoes');
    }
}