<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('building_types')) {
            Schema::create('building_types', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('building_type');
                $table->timestamps();
            });
        } else {
            Schema::table('building_types', function (Blueprint $table) {
                if (!Schema::hasColumn('building_types', 'building_type')) {
                    $table->string('building_type');
                } else {
                    $table->string('building_type')->change();
                }
                if (!Schema::hasColumn('building_types', 'created_at')) {
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
        Schema::dropIfExists('building_types');
    }
}
