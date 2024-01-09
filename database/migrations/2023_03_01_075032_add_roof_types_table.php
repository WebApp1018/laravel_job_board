<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoofTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::table('roof_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('roof_type')->default(NULL);
            $table->timestamps();
        });
        */
        // if not exists, create table
        if (!Schema::hasTable('roof_types')) {
            Schema::create('roof_types', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('roof_type');
                $table->timestamps();
            });
        } else {
            // if exists, add columns
            Schema::table('roof_types', function (Blueprint $table) {
                $table->string('roof_type');
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
        Schema::table('roof_types', function (Blueprint $table) {
            $table->dropColumn('roof_type');
        });
    }
}
