<?php
require '../vendor/autoload.php';

$app = new \Framework\App([
    \App\Blog\BlogModule::class
]);

//la méthode fromGlobals de Guzzle récupère automatiquement la requête et la remplit des variables globales
// var_dump(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
// var_dump($response);
// var_dump($response->getHeader('Location: '));

\Http\Response\send($response);
