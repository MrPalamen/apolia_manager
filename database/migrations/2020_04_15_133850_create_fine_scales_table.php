<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFineScalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fine_scales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('status', ['enable', 'disable', 'delete'])->default('enable');
            $table->string('type');
            $table->string('name');
            $table->integer('points');
            $table->integer('price');
            $table->string('option')->nullable();
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
        Schema::dropIfExists('fine_scales');
    }
}
