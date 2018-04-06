<?php
require '../vendor/autoload.php';


$app = new \Framework\App;

//la méthode fromGlobals de Guzzle génère automatiquement la requête
// var_dump(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
// var_dump($response);
// var_dump($response->getHeader('Location: '));

\Http\Response\send($response);

