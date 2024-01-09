<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePlotTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plot_types', function (Blueprint $table) {
            $table->renameColumn('id', 'id_plot');
            $table->integer('default_value')->default(NULL);
            $table->string('def_width')->default(NULL);
            $table->string('def_len')->default(NULL);
            $table->string('def_height')->default(NULL);
            $table->string('road_wall')->default(NULL);
            $table->string('neigbr_wall')->default(NULL);
            $table->string('gen_wall')->default(NULL);
            $table->string('soil_slab')->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plot_types', function (Blueprint $table) {
            $table->renameColumn('id_plot', 'id');
            $table->dropColumn('default_value');
            $table->dropColumn('def_width');
            $table->dropColumn('def_len');
            $table->dropColumn('def_height');
            $table->dropColumn('road_wall');
            $table->dropColumn('neigbr_wall');
            $table->dropColumn('gen_wall');
            $table->dropColumn('soil_slab');
        });
    }
}
