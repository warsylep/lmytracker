<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->date('date'); 
            $table->decimal('weight', 4, 1);
            $table->decimal('bodyfat', 4, 1);
            $table->decimal('tbw', 4, 1);
            $table->decimal('muscle', 4, 1);
            $table->decimal('bone', 4, 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('measurements');
    }
}
