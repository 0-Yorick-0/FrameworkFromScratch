<?php
namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{

	/**
	 * Description
	 * @return type
	 */
	public function run(ServerRequestInterface $request): ResponseInterface {
		$uri = $request->getUri()->getPath();
		//si l'uri se termine par un slash...
		if (!empty($uri) && $uri[-1] === "/") {
			//on effectue une redirection vers une uri sans slash
			return (new Response())
				->withStatus(301)
				->withHeader('Location: ', substr($uri, 0, -1))
			;
		}

		if ($uri === '/blog') {
			return new Response(200, [], '<h1>Bienvenue sur le blog</h1>');
		}
		//sinon on affiche simplement bonjour
		$response = new Response(404, [], '<h1>Erreur 404</h1>');
		return $response;
	}
}