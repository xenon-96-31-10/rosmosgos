<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiopasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biopas', function (Blueprint $table) {
            $table->id();
            $table->string('snils');
            $table->string('pass');
            $table->string('codepass');
            $table->string('kempass');
            $table->string('datepass');
            $table->string('datebirth');
            $table->string('scanpass');
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
        Schema::dropIfExists('biopas');
    }
}
