<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_types', function (Blueprint $table) {
            $table->integer('default_value');
            $table->string('wall_type')->default(NULL);
            $table->string('floor_finish')->default(NULL);
            $table->string('railing_type')->default(NULL);
            $table->string('ceiling_type')->default(NULL);
            $table->string('window_type')->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_types', function (Blueprint $table) {
            $table->dropColumn('default_value');
            $table->dropColumn('wall_type');
            $table->dropColumn('floor_finish');
            $table->dropColumn('railing_type');
            $table->dropColumn('ceiling_type');
            $table->dropColumn('window_type');
        });
    }
}
