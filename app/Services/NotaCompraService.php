<?php

namespace App\Services;

use App\Models\NotaCompra;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NotaCompraService
{
    // Listar todas as notas de compra
    public function listarNotas()
    {
        return NotaCompra::with(['cliente', 'produto'])->get();
    }

    // Criar uma nova nota de compra
    public function criarNota($data)
    {
        // Validação e lógica de negócios podem ser aplicadas aqui.
        return NotaCompra::create($data);
    }

    // Atualizar uma nota de compra
    public function atualizarNota($id, $data)
    {
        $notaCompra = NotaCompra::findOrFail($id);
        $notaCompra->update($data);

        return $notaCompra;
    }

    // Excluir uma nota de compra
    public function excluirNota($id)
    {
        $notaCompra = NotaCompra::findOrFail($id);
        $notaCompra->delete();

        return $notaCompra;
    }

    // Obter uma nota de compra específica
    public function obterNotaPorId($id)
    {
        $notaCompra = NotaCompra::with(['cliente', 'produto'])->findOrFail($id);

        return $notaCompra;
    }
}