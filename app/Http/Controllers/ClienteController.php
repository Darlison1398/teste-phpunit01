<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Services\ClienteService;
use App\Http\Requests\StoreClienteRequest; // Importando o Form Request
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    protected $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(StoreClienteRequest  $request) // Usando o Form Request
    {
        $cliente = $this->clienteService->createCliente($request->validated()); // Garantindo que os dados validados sejam utilizados
        return response()->json($cliente, 201);
    }

    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json($cliente);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente = $this->clienteService->updateCliente($cliente, $request->all());
        return response()->json($cliente);
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $response = $this->clienteService->deleteCliente($cliente);
        return response()->json($response);
    }
}
