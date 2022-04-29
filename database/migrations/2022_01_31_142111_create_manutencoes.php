<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManutencoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manutencoes', function (Blueprint $table) {
            $table->increments("id");
            $table->string("tipo");
            $table->string("status");
            $table->string("assinaturaTecnico")->nullable(true);
            $table->string("assinaturaCliente")->nullable(true);
            $table->integer("chamado_id");
            $table->integer("equipamento_id");
            $table->integer("tecnico_id");
            $table->timestamps();
            // $table->integer("equipamento_id")->integer();
            // $table->integer("tecnico_id");//id do user tecnico
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manutencoes');
    }
}
