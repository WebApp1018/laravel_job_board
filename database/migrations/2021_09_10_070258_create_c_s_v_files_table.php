<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCSVFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('c_s_v_files')) {
            Schema::create('c_s_v_files', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('user_id');
                $table->string('project_id');
                $table->string('name');
                $table->string('email');
                $table->string('file_path');
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
        Schema::dropIfExists('c_s_v_files');
    }
}
