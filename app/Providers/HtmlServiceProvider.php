<?php

namespace Cuadrantes\Providers;

use Collective\Html\HtmlServiceProvider as CollectiveHtmlServiceProvider;
use Cuadrantes\Helpers\HtmlBuilder;

class HtmlServiceProvider extends CollectiveHtmlServiceProvider {

	protected function registerHtmlBuilder()
	{
		$this->app->singleton('html', function ($app) {
			return new HtmlBuilder($app['url'], $app ['view']);
		});
	}
}