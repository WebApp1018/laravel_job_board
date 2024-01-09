<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoomTypeAddsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::table('room_type_adds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(NULL);
            $table->string('parent_type')->default(NULL);
            $table->string('type')->default(NULL);
            $table->timestamps();
        });
        */
        // if not exists, create table
        if (!Schema::hasTable('room_type_adds')) {
            Schema::create('room_type_adds', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('parent_id');
                $table->string('parent_type');
                $table->string('type');
                $table->timestamps();
            });
        } else {
            // if exists, add columns
            Schema::table('room_type_adds', function (Blueprint $table) {
                $table->integer('parent_id');
                $table->string('parent_type');
                $table->string('type');
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
        Schema::dropIfExists('room_type_adds');
    }
}
