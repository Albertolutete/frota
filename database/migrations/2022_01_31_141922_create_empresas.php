<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string("descricao");
			$table->string("cidade");
            $table->string("responsavel");
            $table->string("estado");
            $table->string("bairro");
            $table->string("logradouro");
            $table->integer("numero");
            $table->string("cep");
            $table->string("cnpj");
            $table->string("email");
            $table->string("telefone");
            $table->string("status");
            $table->string("empresa_id"); // So se aplica se for uma empresa secundaria
            $table->string("tipo"); // Identifica se é uma Loja, prestadora de serviço
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
