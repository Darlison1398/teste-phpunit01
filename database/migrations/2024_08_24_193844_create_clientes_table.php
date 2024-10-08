<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->uuid('UUID')->primary();  // Definindo o UUID como chave primária
            $table->string('nome');
            $table->string('sobrenome');
            $table->string('email')->unique();
            $table->string('telefone')->nullable();
            $table->timestamps(); 
        });
    }


    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
