<?php namespace App\Http\Composers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
	/**
	 * Register bindings in the container
	 */
	public function boot()
	{
		view()->composer('admin.main', 'App\Http\ViewComposers\AdminTopMenuComposer')
	}
}