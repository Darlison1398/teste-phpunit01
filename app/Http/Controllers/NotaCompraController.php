<?php

namespace App\Http\Controllers;

use App\Services\NotaCompraService;
use Illuminate\Http\Request;

class NotaCompraController extends Controller
{

    public function create()
    {
        return view('notas.create');
    }

    protected $notaCompraService;

    public function __construct(NotaCompraService $notaCompraService)
    {
        $this->notaCompraService = $notaCompraService;
    }

    // Listar todas as notas de compra
    public function index()
    {
        $notas = $this->notaCompraService->listarNotas();
        return response()->json($notas);
    }

    // Criar uma nova nota de compra
    public function store(Request $request)
    {
        $data = $request->validate([
            'clienteId' => 'required|exists:clientes,UUID',
            'produtoId' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'data' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);

        $nota = $this->notaCompraService->criarNota($data);

        //return response()->json($nota, 201); // Retorna 201 Created
        return redirect()->route('notas.create')->with('success', 'Nota criada com sucesso!');
    }

    // Obter uma nota de compra específica
    public function show($id)
    {
        $nota = $this->notaCompraService->obterNotaPorId($id);

        return response()->json($nota);
    }

    // Atualizar uma nota de compra
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'clienteId' => 'exists:clientes,UUID',
            'produtoId' => 'exists:produtos,id',
            'quantidade' => 'integer|min:1',
            'data' => 'date',
            'total' => 'numeric|min:0',
        ]);

        $nota = $this->notaCompraService->atualizarNota($id, $data);

        return response()->json($nota);
    }

    // Excluir uma nota de compra
    public function destroy($id)
    {
        $nota = $this->notaCompraService->excluirNota($id);

        return response()->json(['message' => 'Nota de compra excluída com sucesso']);
    }
}