<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManutencaocorretiva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manutencaocorretiva', function (Blueprint $table) {
            $table->id();
            $table->integer("manutencao_id");
            $table->string("foto")->nullable(true);
            $table->string("observacoes")->nullable(true);
            $table->string("material_aplicado")->nullable(true);
            $table->string("situacao_equipamento");
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
        Schema::dropIfExists('manutencaocorretiva');
    }
}
