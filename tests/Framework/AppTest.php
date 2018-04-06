<?php
namespace Tests\Framework;

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;

use PHPUnit\Framework\TestCase;
/**
* 
*/
class AppTest extends TestCase
{
	
	public function testRedirectTrailingSlash()
	{
		//nouvelle instance de l'application
		$app = new App();
		//création d'une requête factice
		$request = new ServerRequest('GET', '/demoslash/');
		//lancement de l'appli
		$response = $app->run($request);
		//test de la redirection
		$this->assertContains('/demoslash', $response->getHeader('Location: '));
		//test du statut de la réponse
		$this->assertEquals(301, $response->getStatusCode());
	}

	public function testBlog()
	{
		//nouvelle instance de l'application
		$app = new App();
		//création d'une requête factice
		$request = new ServerRequest('GET', '/blog');
		//lancement de l'appli
		$response = $app->run($request);
		//test de la redirection
		$this->assertContains('<h1>Bienvenue sur le blog</h1>', (string)$response->getBody());
		//test du statut de la réponse
		$this->assertEquals(200, $response->getStatusCode());
	}

	public function test404()
	{
		//nouvelle instance de l'application
		$app = new App();
		//création d'une requête factice
		$request = new ServerRequest('GET', '/dosntExists');
		//lancement de l'appli
		$response = $app->run($request);
		//test de la redirection
		$this->assertContains('<h1>Erreur 404</h1>', (string)$response->getBody());
		//test du statut de la réponse
		$this->assertEquals(404, $response->getStatusCode());
	}
}