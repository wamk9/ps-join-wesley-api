<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriaProduto extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tb_categoria_produto';
    protected $fillable = [
        'nome_categoria'
    ];
}
