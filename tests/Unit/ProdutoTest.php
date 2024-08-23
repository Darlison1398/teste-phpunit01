<?php

namespace Tests\Feature;

use Tests\TestCase; // Corrigido para estender a classe TestCase do Laravel
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProdutoTest extends TestCase
{
    /* se a linha aabaixo estiver descomentada, ela vai fazer com que os 
       dados no banco sejam apagados automaticamente após a execução dos testes. 
       Por isso que eu comentei ela, pra mim ver os dados na tabela no banco.
       */
    use RefreshDatabase;  

    /** @test */
    public function test_criar_produto()
    {
        // Cria um produto no banco de dados
        $produto = Produto::create([
            'nome' => 'Feijão preto',
            'descricao' => 'Descrição do Produto Teste. Aqui eu insiro um feijão no banco',
            'preco' => 5.50,
        ]);

        // Verifica se o produto foi criado no banco de dados
        $this->assertDatabaseHas('produtos', [
            'nome' => 'Feijão preto',
        ]);
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

        $produto->update([
            'nome' => 'Feijão branco',
            'descricao' => 'Descrição do Produto Atualizado',
            'preco' => 6.00,
        ]);

        $this->assertDatabaseHas('produtos', [
            'nome' => 'Feijão branco',
        ]);

        $this->assertDatabaseMissing('produtos', [
            'nome' => 'Feijão pardo',
        ]);
    }


    public function test_excluir_produto()
    {
        $produto = Produto::create([
            'nome' => 'Feijão azul',
            'descricao' => 'Descrição do Produto Teste. Aqui eu insiro um feijão no banco',
            'preco' => 5.50,
        ]);

        $produto->delete();

        $this->assertDatabaseMissing('produtos', [
            'nome' => 'Feijão azul',
        ]);
    }


}
