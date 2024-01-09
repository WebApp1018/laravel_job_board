<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMassTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::table('mass_types', function (Blueprint $table) {
            $table->integer('id')->default(NULL);
            $table->string('mass_type')->default(NULL);
            $table->timestamps();
        });
        */
        // if not exists, create table
        if (!Schema::hasTable('mass_types')) {
            Schema::create('mass_types', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('mass_type');
                $table->timestamps();
            });
        } else {
            // if exists, add columns
            Schema::table('mass_types', function (Blueprint $table) {
                if (!Schema::hasColumn('mass_types', 'mass_type')) {
                    $table->string('mass_type');
                } else {
                    $table->string('mass_type')->change();
                }
                if (!Schema::hasColumn('mass_types', 'created_at')) {
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
        Schema::table('mass_types', function (Blueprint $table) {
            //
        });
    }
}
