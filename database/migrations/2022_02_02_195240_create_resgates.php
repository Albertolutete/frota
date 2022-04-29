<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResgates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resgates', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nome");
			$table->string("nome_equipamento");
            $table->string("motivo");
            $table->string("telefone");
            $table->string("detalhes");
            $table->string("ficheiro");
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
        Schema::dropIfExists('resgates');
    }
}
