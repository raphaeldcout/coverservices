<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class def_categoria extends Model
{
    protected $fillable = [
        'id', 'name', 'apelido', 'codigo_setor'
    ];
}
