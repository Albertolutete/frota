<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChamado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chamado', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("empresa_id");
            $table->string("nome");
            $table->string("cargo");
            $table->string("tipo");
            $table->integer("equipamento_id");
            $table->string("Telefone");
            $table->string("anexo");
            $table->string("status")->default("fechado");
            $table->string("Motivo");//aberto ou fechado
            $table->string("detalhes"); // 
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
        Schema::dropIfExists('chamado');
    }
}
