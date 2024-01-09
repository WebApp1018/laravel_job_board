<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlabTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::table('slab_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('soil_slab')->default(NULL);
            $table->string('roof_slab')->default(NULL);
            $table->string('gen_slab')->default(NULL);
            $table->string('mass_type')->default(NULL);
            $table->timestamps();
        });
        */
        // if not exists, create table
        if (!Schema::hasTable('slab_types')) {
            Schema::create('slab_types', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('soil_slab');
                $table->string('roof_slab');
                $table->string('gen_slab');
                $table->string('mass_type');
                $table->timestamps();
            });
        } else {
            // if exists, add columns
            Schema::table('slab_types', function (Blueprint $table) {
                $table->string('soil_slab');
                $table->string('roof_slab');
                $table->string('gen_slab');
                $table->string('mass_type');
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
        Schema::dropIfExists('slab_types');
    }
}
