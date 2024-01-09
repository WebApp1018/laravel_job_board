<?php

use Doctrine\DBAL\Types\Types;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRoomTypesTable extends Migration
{
    // attempt to fix: Doctrine\DBAL\Exception  : Unknown database type enum requested, Doctrine\DBAL\Platforms\MySqlPlatform may not support it.
    // credit: https://github.com/doctrine/dbal/issues/3161#issuecomment-723016526
    public function __construct()
    {
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('room_types')) {
            Schema::create('room_types', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('room_type');
                $table->timestamps();
            });
        } else {
            Schema::table('room_types', function (Blueprint $table) {
                //$table->string('room_type');
                // check if column exists, if yes, update, if no, add
                if (!Schema::hasColumn('room_types', 'room_type')) {
                    $table->string('room_type');
                } else {
                    $table->string('room_type')->change();
                }
                //$table->timestamps();
                // check if created_at & updated_at columns exist, if no, add
                if (!Schema::hasColumn('room_types', 'created_at')) {
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
        Schema::dropIfExists('room_types');
    }
}
