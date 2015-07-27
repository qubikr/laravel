<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('regions', function(Blueprint $table)
		{
			$table->create();
			$table->increments('id');
			$table->string('seo_title')->nullable();
			$table->string('seo_description')->nullable();
			$table->string('seo_keywords')->nullable();
			$table->string('name');
			$table->string('url');
			$table->string('description')->nullable();
			$table->text('html')->nullable();
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
		//
		Schema::drop('regions');
	}

}
