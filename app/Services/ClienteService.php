<?php

namespace App\Services;

use App\Models\Cliente;
use Illuminate\Support\Str;

class ClienteService
{
    public function createCliente(array $data)
    {
        $data['UUID'] = (string) Str::uuid();
        return Cliente::create($data);
    }

    public function updateCliente(string $uuid, array $data)
    {
        $cliente = Cliente::where('UUID', $uuid)->first();

        if (!$cliente) {
            throw new ModelNotFoundException("Cliente com UUID {$uuid} não encontrado.");
        }

        $cliente->update($data);
        return $cliente;
    }

    public function deleteCliente(string $uuid)
    {
        $cliente = Cliente::where('UUID', $uuid)->first();

        if (!$cliente) {
            throw new ModelNotFoundException("Cliente com UUID {$uuid} não encontrado.");
        }

        $cliente->delete();
        return ['message' => 'Cliente deletado com sucesso.'];
    }
}