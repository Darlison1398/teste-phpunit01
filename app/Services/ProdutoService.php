<?php

namespace App\Services;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoService
{
    public function createProduto(array $data)
    {
        return Produto::create($data);
    }

    public function updateProduto(Produto $produto, array $data)
    {
        return $produto->update($data);
    }

    public function deleteProduto(Produto $produto)
    {
        return $produto->delete();
    }
}