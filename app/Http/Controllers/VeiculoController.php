<?php

namespace App\Http\Controllers;


use App\Models\Veiculo;
use Illuminate\Http\Request;


class VeiculoController extends Controller
{


    public function index()
    {

        $veiculos = Veiculo::all();


        return view(
            'veiculos.index',
            compact('veiculos')
        );


    }



    public function create()
    {

        return view('veiculos.create');

    }



    public function store(Request $request)
    {


        Veiculo::create(
        $request->all()
        );


        return redirect('/veiculos');


    }



    public function edit(Veiculo $veiculo)
    {

        return view(
        'veiculos.edit',
        compact('veiculo')
        );

    }



        public function update(
        Request $request,
        Veiculo $veiculo
        )
    {

        $veiculo->update(
        $request->all()
        );


        return redirect('/veiculos');


    }



    public function destroy(Veiculo $veiculo)
    {

        $veiculo->delete();


        return redirect('/veiculos');

    }



}