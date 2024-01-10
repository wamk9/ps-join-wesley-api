<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_produto', function (Blueprint $table) {
            $table->integer('id_produto', true);
            $table->integer('id_categoria_produto');
            $table->dateTime('data_cadastro')->useCurrent();
            $table->string('nome_produto', 150);
            $table->float('valor_produto', 10, 2);

            $table->foreign('id_categoria_produto')->on('tb_categoria_produto')->references('id_categoria_planejamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_produto');
    }
};
