<?php
namespace Framework\Router;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

class MiddlewareApp implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler = null)
    {
        //Implement the process
    }

    public function sayHello()
    {
        return 'Hello';
    }
}
