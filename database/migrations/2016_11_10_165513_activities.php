<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Activities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('slug');
			$table->text('description');
			$table->string('place');
			$table->integer('duration');
			$table->integer('userlimit')->default(0);
			$table->integer('userleft')->nullable();
			$table->integer('status');
			$table->integer('timeutc');
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
        Schema::dropIfExists('activities');
    }
}
