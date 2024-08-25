<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Certifique-se de importar também

class Cliente extends Model
{
    use HasFactory;

    // Colunas que podem ser preenchidas em massa
    protected $fillable = [
        'UUID',
        'nome', 
        'sobrenome', 
        'email', 
        'telefone'
    ];

    protected $primaryKey = 'UUID';
    protected $keyType = 'string';  
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cliente) {
            if (empty($cliente->UUID)) {
                $cliente->UUID = (string) Str::uuid();
            }
        });
    }
}
