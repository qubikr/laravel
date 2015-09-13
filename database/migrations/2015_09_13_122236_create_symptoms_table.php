<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymptomsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('symptoms', function(Blueprint $table){
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

		Schema::table('region_symptom', function(Blueprint $table){
			$table->create();
			$table->bigInteger('region_id');
			$table->bigInteger('symptom_id');
		})
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
		Schema::drop('region_symptom');
	}

}
