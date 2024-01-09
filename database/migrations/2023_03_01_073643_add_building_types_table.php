<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuildingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('building_types', function (Blueprint $table) {
            $table->integer('default_value')->default(NULL);
            $table->string('ext_wall')->default(NULL);
            $table->string('room_wall')->default(NULL);
            $table->string('corri_wall')->default(NULL);
            $table->string('soil_slab')->default(NULL);
            $table->string('roof_slab')->default(NULL);
            $table->string('gen_slab')->default(NULL);
            $table->string('railing_type')->default(NULL);
            $table->string('roof_type')->default(NULL);
            $table->string('mass_type')->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('building_types', function (Blueprint $table) {
            //
        });
    }
}
