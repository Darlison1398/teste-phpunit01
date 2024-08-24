<?php

namespace Tests\Feature;

use Tests\TestCase; 
use App\Services\ProdutoService;
use App\Models\Produto;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProdutoTest extends TestCase
{
    /* se a linha abaixo estiver descomentada, ela vai fazer com que os 
       dados no banco sejam apagados automaticamente após a execução dos testes. 
       Por isso que eu comentei ela, pra mim ver os dados na tabela no banco.
       */
    use RefreshDatabase;  

    protected $produtoService;

    public function setUp(): void
    {
        parent::setUp();

        // instancia do ProdutoService
        $this->produtoService = new ProdutoService();
    }


    /** @test */
    public function test_criar_produto()
    {
        // Cria um produto no banco de dados
        $produtoData = [
            'nome' => 'Feijão preto',
            'descricao' => 'Descrição do Produto Teste. Aqui eu insiro um feijão no banco',
            'preco' => 5.50,
        ];

        
        // Cria o mock para o Produto e espera que o método create seja chamado
        $produtoMock = Mockery::mock(Produto::class);
        $produtoMock->shouldReceive('create')->with($produtoData)->andReturn(new Produto($produtoData));
        
        $createdProduto = $this->produtoService->createProduto($produtoData);

        // Verifica se o produto foi criado corretamente
        $this->assertEquals($produtoData['nome'], $createdProduto->nome);
        $this->assertEquals($produtoData['descricao'], $createdProduto->descricao);
        $this->assertEquals($produtoData['preco'], $createdProduto->preco);
    }

    public function test_exibir_produtos()
    {
        // Cria um produto no banco de dados
        Produto::create([
            'nome' => 'Feijão preto',
            'descricao' => 'Descrição do Produto Teste. Aqui eu insiro um feijão no banco',
            'preco' => 5.50,
        ]);

        // Recupera todos os produtos do banco de dados
        $produtos = Produto::all();

        // Verifica se há produtos no banco de dados
        $this->assertNotEmpty($produtos);

        // Opcionalmente, você pode verificar se o produto específico existe
        $this->assertDatabaseHas('produtos', [
            'nome' => 'Feijão preto',
        ]);
    }

    public function test_atualizar_produto()
    {
        $produto = Produto::create([
            'nome' => 'Feijão preto',
            'descricao' => 'Descrição do Produto Teste. Aqui eu insiro um feijão no banco',
            'preco' => 5.50,
        ]);

        $produtoDataUpdate = [
            'nome' => 'Feijão branco',
            'descricao' => 'Descrição do Produto Atualizado',
            'preco' => 6.00,
        ];

        // Usa o service para atualizar o produto
        $this->produtoService->updateProduto($produto, $produtoDataUpdate);

        // Verifica se o produto foi atualizado corretamente no banco
        $this->assertDatabaseHas('produtos', [
            'nome' => 'Feijão branco',
        ]);

    }


    public function test_excluir_produto()
    {
        // Mocka o model Produto
        $produto = Produto::create([
            'nome' => 'Feijão azul',
            'descricao' => 'Descrição do Produto Teste',
            'preco' => 5.50,
        ]);

        // Usa o service para excluir o produto
        $this->produtoService->deleteProduto($produto);

        // Verifica se o produto foi removido do banco de dados
        $this->assertDatabaseMissing('produtos', [
            'nome' => 'Feijão azul',
        ]);
    }


}
