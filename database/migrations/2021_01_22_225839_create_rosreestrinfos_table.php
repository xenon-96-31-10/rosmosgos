<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRosreestrinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rosreestrinfos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->string('typeobj');
            $table->string('cadnomer');
            $table->string('adres');
            $table->string('statusobj');
            $table->string('datepostuch');
            $table->string('catzemly');
            $table->string('razreshisp');
            $table->string('area');
            $table->string('areacod');
            $table->string('cadastrcost');
            $table->string('dateoprcost');
            $table->string('datevnescost');
            $table->string('dateutvercost');
            $table->string('dateupdateinf');
            $table->string('formsobstv');
            $table->string('numberhoz');
            $table->string('ki');
            $table->string('coordinata1');
            $table->string('coordinata2');
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
        Schema::dropIfExists('rosreestrinfos');
    }
}
