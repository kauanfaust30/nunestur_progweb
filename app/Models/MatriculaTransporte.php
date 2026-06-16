<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatriculaTransporte extends Model
{

    protected $fillable=[

        'aluno_id',
        'instituicao_id',
        'veiculo_id',
        'turno',
        'dias_semana',
        'frequencia_semanal',
        'valor_subsidio',
        'status'
    ];



    public function aluno()
    {

        return $this->belongsTo(
            Aluno::class
        );

    }



    public function instituicao()
    {

        return $this->belongsTo(
            Instituicao::class
        );

    }



    public function veiculo()
    {

        return $this->belongsTo(
            Veiculo::class
        );

    }



}