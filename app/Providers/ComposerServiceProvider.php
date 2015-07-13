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
		view()->composer('admin.sidebar', 'App\Http\ViewComposers\AdminSidebarMenuComposer');
		view()->composer('admin.element.*', 'App\Http\ViewComposers\AdminPageDataComposer');
	}

	/**
	 * Register bindings in service container
	 * @return [type] [description]
	 */
	public function register()
	{

	}
}