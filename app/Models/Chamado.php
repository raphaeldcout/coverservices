<?php
/**
 * Created by PhpStorm.
 * User: gonca
 * Date: 04/05/2021
 * Time: 20:06
 */
namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    //use HasFactory;
    protected $fillable = ['titulo', 'status', 'urgencia', 'prioridade', 'descricao', 'resumo', 'anexo'];
}