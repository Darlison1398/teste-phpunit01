<?php

namespace Tests\Unit;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\NotaCompra;
use App\Services\NotaCompraService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class NotaCompraServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $notaCompraService;

    public function setUp(): void
    {
        parent::setUp();
        $this->notaCompraService = new NotaCompraService();
    }

    public function test_create_nota_compra()
    {
        // Cria um cliente no banco de dados
        $cliente = Cliente::factory()->create();

        // Cria um produto no banco de dados
        $produto = Produto::factory()->create();

        $data = [
            'clienteId' => $cliente->UUID,
            'produtoId' => $produto->id,
            'quantidade' => 10,
            'data' => now(),
            'total' => 100,
        ];

        $nota = $this->notaCompraService->criarNota($data);

        $this->assertInstanceOf(NotaCompra::class, $nota);

        $this->assertEquals($data['clienteId'], $nota->clienteId);
        $this->assertEquals($data['produtoId'], $nota->produtoId);
        $this->assertEquals(10, $nota->quantidade);
        $this->assertEquals(date('Y-m-d H:i:s'), $nota->data);

        $this->assertDatabaseHas('nota_compras', [
            'clienteId' => $cliente->UUID,
            'produtoId' => $produto->id,
        ]);

    }

    public function test_deletar_nota()
    {
        // Crie um cliente e um produto utilizando as factories
        $cliente = Cliente::factory()->create();
        $produto = Produto::factory()->create();

        // Crie uma nota de compra diretamente com os dados necessários
        $nota = NotaCompra::create([
            'clienteId' => $cliente->UUID,
            'produtoId' => $produto->id,
            'quantidade' => 10,
            'data' => now(),
            'total' => 100,
        ]);

        // Verifique se a nota foi criada com sucesso
        $this->assertDatabaseHas('nota_compras', ['id' => $nota->id]);

        // Exclua a nota passando o ID ou UUID, dependendo do que seu método de exclusão espera
        $this->notaCompraService->excluirNota($nota->id);

        // Verifique se a nota foi excluída com sucesso
        $this->assertDatabaseMissing('nota_compras', ['id' => $nota->id]);

    }



}