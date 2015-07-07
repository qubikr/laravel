<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class ComposerServiceProvider extends ServiceProvider
{

	/**
	 * Register bindings in the container
	 */
	public function boot()
	{
		view()->composer('admin.menu_top', 'App\Http\ViewComposers\AdminTopMenuComposer');
	}

	/**
	 * Register bindings in service container
	 * @return [type] [description]
	 */
	public function register()
	{

	}
}