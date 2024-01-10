<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Produto extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    const CREATED_AT = 'data_cadastro';

    protected $table = 'tb_produto';
    protected $fillable = [
        'id_categoria_produto',
        'nome_produto',
        'valor_produto'
    ];
    protected $hidden = [
        'id_categoria_produto'
    ];

    public function categoriaProduto(): BelongsTo
    {
        return $this->belongsTo(CategoriaProduto::class, 'id_categoria_produto', 'id_categoria_planejamento');
    }
}
