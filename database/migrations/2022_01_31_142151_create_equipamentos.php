<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->increments("id");
            $table->string("descricao");
            $table->string("nome");
            $table->string("qrCode");
            $table->string("modelo");
            $table->string("fabricante");
            $table->string("numeroSerie");
            $table->string("marca");
            $table->string("status");
            
            $table->integer("empresa_id")->unsigned();
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
        Schema::dropIfExists('equipamentos');
    }
}
