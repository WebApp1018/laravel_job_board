<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('plots')) {
            Schema::create('plots', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('plot_type_name');
                $table->integer('plot_id');
                // $table->integer('plot_type_id');
                $table->integer('width')->nullable();
                $table->integer('height')->nullable();
                $table->integer('length')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plots');
    }
}
