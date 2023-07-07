<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'preco',
        'id_marca'
    ];

    /**
     * Retorna a marca associada ao Produto
     */
    public function marca()
    {
        return $this->hasOne(Marca::class, 'id', 'id_marca');
    }

}
