<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{


    protected $fillable=[

        'modelo',
        'tipo',
        'placa',
        'capacidade'

    ];



    public function matriculas()
    {

        return $this->hasMany(
            MatriculaTransporte::class
        );

    }


}