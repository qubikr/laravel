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
			$table->string('seo_title');
			$table->string('seo_description');
			$table->string('seo_keywords');
			$table->string('name');
			$table->string('url');
			$table->string('description');
			$table->text('html');
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
