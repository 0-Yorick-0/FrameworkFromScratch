<?php
namespace Tests\Framework\Modules;

class ErroredModules
{
	public function __construct(\Framework\Router $router)
	{
		$router->get('/demo', function () {
			return new \stdClass();
		}, 'demo');
	}
}