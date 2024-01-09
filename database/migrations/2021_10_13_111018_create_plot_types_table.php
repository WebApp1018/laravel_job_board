<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlotTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('plot_types')) {
            Schema::create('plot_types', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('plot_type');
                $table->timestamps();
            });
        } else {
            Schema::table('plot_types', function (Blueprint $table) {
                if (!Schema::hasColumn('plot_types', 'plot_type')) {
                    $table->string('plot_type');
                } else {
                    $table->string('plot_type')->change();
                }
                if (!Schema::hasColumn('plot_types', 'created_at')) {
                    $table->timestamps();
                }
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
        Schema::dropIfExists('plot_types');
    }
}
