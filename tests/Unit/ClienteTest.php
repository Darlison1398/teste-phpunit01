<?php

namespace Tests\Unit;

use App\Models\Cliente;
use App\Services\ClienteService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class ClienteServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $clienteService;

    protected function setUp() : void 
    {
        parent::setUp();
        $this->clienteService = new ClienteService();
    }


    public function test_create_client()
    {
        $data = [
            'nome' => 'JOHN',
            'sobrenome' => 'DOE',
            'email' => 'john@example.com',
            'telefone' => '1234567890',
            
        ];

        $cliente = $this->clienteService->createCliente($data);

        $this->assertInstanceOf(Cliente::class, $cliente);
        $this->assertEquals('JOHN', $cliente->nome);
        $this->assertEquals('DOE', $cliente->sobrenome);
        $this->assertEquals('john@example.com', $cliente->email);
        $this->assertEquals('1234567890', $cliente->telefone);
    }

    public function test_update_client()
    {
        // Crie um cliente na base de dados
        $cliente = Cliente::factory()->create();

        $updatedData = [
            'nome' => 'Carlos',
            'sobrenome' => 'Pereira',
            'email' => 'carlospereira@example.com',
            'telefone' => '987654321'
        ];

        // Atualize o cliente usando o serviço
        $result = $this->clienteService->updateCliente($cliente->UUID, $updatedData);

        // Verifique se o cliente foi atualizado corretamente
        $this->assertNotNull($result);
        $this->assertEquals($updatedData['nome'], $result->nome);

    }

    public function test_delete_client()
    {
        // Crie um cliente na base de dados
        $cliente = Cliente::factory()->create();

        $result = $this->clienteService->deleteCliente($cliente->UUID);

        $this->assertEquals(['message' => 'Cliente deletado com sucesso.'], $result);

        $this->assertNull(Cliente::where('UUID', $cliente->UUID)->first());
    }
    
}