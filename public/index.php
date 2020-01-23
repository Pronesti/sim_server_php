<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Exception\HttpNotFoundException;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, array $args) {
    $load1 = new \Classes\DecoratorCounter(new \Classes\LoadBalancer("load1", new \Classes\RoundStrategy));
    $load2 = new \Classes\DecoratorCounter(new \Classes\LoadBalancer("load2", new \Classes\RandomStrategy));
    $load1->addServer($load2);
    $server1 = new \Classes\DecoratorCounter(new \Classes\ServerInstance("anda maso", true, true, true, false, false));
    $server2 = new \Classes\DecoratorCounter(new \Classes\ServerInstance("malo", false, false, true, true, true));
    $load2->addServer($server1);
    $load2->addServer($server2);

    $i=0;
    while($i<385){
        $response->getBody()->write("" . $load1->call());
        $response->getBody()->write("</br>");
        $i++;
    }
    $response->getBody()->write("Number of connections of Parent LB: " . $load1->getConnections() . "</br>");
    $response->getBody()->write("Number of connections of server 2: " . $server2->getConnections(). "</br>");
    return $response;
});

$app->run();
