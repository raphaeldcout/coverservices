<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class def_categoria extends Model
{
    protected $fillable = [
        'id', 'name', 'apelido'
    ];

    public static function retornaCategoria() {
        return def_categoria::select(
                'def_categorias.id as idCategoria', 
                'def_categorias.name', 
                'def_categorias.apelido'
                )
                ->orderBy('def_categorias.name', 'asc')
                ->get();
    }
}
