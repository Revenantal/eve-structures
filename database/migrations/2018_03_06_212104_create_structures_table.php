<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structures', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('structure_id');
            $table->integer('type_id');
            $table->bigInteger('corporation_id');
            $table->bigInteger('system_id');
            $table->integer('profile_id');
            $table->integer('reinforce_weekday');
            $table->integer('reinforce_hour');
            $table->string('state');
            $table->string('name');
            $table->dateTime('fuel_expires')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('structures');
    }
}
