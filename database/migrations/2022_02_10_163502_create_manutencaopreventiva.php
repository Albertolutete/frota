<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManutencaopreventiva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manutencaopreventiva', function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->string("subtitulo");
            $table->string("foto")->nullable(true);
            $table->string("status");
            $table->string("observacoes")->nullable(true);
            $table->string("estado_manutencao")->default("a");
            $table->integer("manutencao_id");
            $table->timestamp("dataFechamento")->nullable(true);
            // $table->string("assinaturaTecnico")->nullable(true);
            // $table->string("assinaturaCliente")->nullable(true);
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
        Schema::dropIfExists('manutencaopreventiva');
    }
}
