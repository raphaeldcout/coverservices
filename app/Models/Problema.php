<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problema extends Model
{
    protected $fillable = [
        'id', 'name', 'codigo_categoria'
    ];

    public static function retornaProblemas() {
        return Problema::select(
                'problemas.id as idProblema', 
                'problemas.name',
                'problemas.codigo_categoria'
                )
                ->orderBy('problemas.name', 'asc')
                ->get();
    }
}
