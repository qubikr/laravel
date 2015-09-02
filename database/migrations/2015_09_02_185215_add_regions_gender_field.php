<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegionsGenderField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('regions', function(Blueprint $table){
			$table->tinyInteger('gender')->after('url')->unsigned()->default(63);
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
		Schema::table('regions', function(Blueprint $table){
			$table->dropColumn('gender');
		});
	}

}
