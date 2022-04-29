<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManutencaocomponentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manutencaocomponentes', function (Blueprint $table) {
            $table->increments("id");
            $table->string("status");
            $table->string("observacao");
            $table->string("ficheiro");
            $table->integer("manutencoe_id")->unsigned();
            $table->integer("componente_id")->unsigned();
            $table->integer("tecnico_id")->unsigned();
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
        Schema::dropIfExists('manutencaocomponentes');
    }
}
