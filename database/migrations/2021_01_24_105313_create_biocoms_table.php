<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiocomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biocoms', function (Blueprint $table) {
            $table->id();
            $table->string('inn');
            $table->string('bank');
            $table->string('bill');
            $table->string('numdov');
            $table->string('datedov');
            $table->string('scandov');
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
        Schema::dropIfExists('biocoms');
    }
}
