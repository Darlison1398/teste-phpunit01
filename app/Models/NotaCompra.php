<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaCompra extends Model
{
    use HasFactory;
    protected $fillable = [
        'clienteId',
        'produtoId',
        'quantidade',
        'data', 
        'total'
    ];

    // Relacionamento com Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clienteId');
    }

    // Relacionamento com Produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produtoId');
    }
}
