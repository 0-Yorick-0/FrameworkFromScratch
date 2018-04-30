<?php
namespace Tests\Framework;

use Framework\App;
use App\Blog\BlogModule;
use Tests\Framework\Modules\ErroredModules;

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
		$app = new App([
			BlogModule::class
		]);
		//création d'une requête factice
		$request = new ServerRequest('GET', '/blog');
		//lancement de l'appli
		$response = $app->run($request);
		//test de la redirection
		$this->assertContains('<h1>Bienvenue sur le blog</h1>', (string)$response->getBody());
		//test du statut de la réponse
		$this->assertEquals(200, $response->getStatusCode());

		$requestSingle = new ServerRequest('GET', '/blog/article-de-test');
		$responseSingle = $app->run($requestSingle);
		$this->assertContains("<h1>Bienvenue sur l'article article-de-test</h1>", (string)$responseSingle->getBody());
	}

	public function testThrowExceptionIfNotResponseSent()
	{
		$app = new App([
			ErroredModules::class
		]);

		$request = new ServerRequest('GET', '/demo');
		$this->expectException(\Exception::class);
		$app->run($request);
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