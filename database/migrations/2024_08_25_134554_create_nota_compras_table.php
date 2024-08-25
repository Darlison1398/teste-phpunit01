<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaComprasTable extends Migration
{
    public function up()
    {
        Schema::create('nota_compras', function (Blueprint $table) {
            $table->id();
            $table->uuid('clienteId');  // Relacionamento com Cliente
            $table->foreign('clienteId')->references('UUID')->on('clientes')->onDelete('cascade');
            $table->unsignedBigInteger('produtoId');  // Relacionamento com Produto
            $table->foreign('produtoId')->references('id')->on('produtos')->onDelete('cascade');
            $table->integer('quantidade');
            $table->date('data');
            $table->decimal('total', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nota_compras');
    }
}
