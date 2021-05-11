<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    protected $fillable = [
        'id', 'tipo', 'arquivo', 'codigo_chamado'
    ];
}
