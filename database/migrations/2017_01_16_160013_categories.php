<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Categories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->text('description');
		});
		
		Schema::create('activity_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('activity');
			$table->integer('category');
		});
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('activity_categories');
    }
}
