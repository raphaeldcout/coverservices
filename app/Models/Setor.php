<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    protected $fillable = [
        'id', 'name', 'apelido'
    ];
    public static function retornaSetores() {
        return Setor::select(
                'setors.id as idSetor', 
                'setors.name', 
                'setors.apelido'
                )
                ->orderBy('setors.name', 'asc')
                ->get();
    }
}
