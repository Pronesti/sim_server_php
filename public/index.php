<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Exception\HttpNotFoundException;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, array $args) {
    $load1 = new \Classes\LoadBalancerRound("load1");
    $load2 = new \Classes\LoadBalancerRandom("load2");
    $load1->addServer($load2);
    $server1 = new \Classes\ServerInstance("anda maso", true, true, true, false, false);
    $server2 = new \Classes\ServerInstance("malo", false, false, true, true, true);
    $load2->addServer($server1);
    $load2->addServer($server2);

    $i=0;
    while($i<500){
        $response->getBody()->write("" . $load1->call());
        $response->getBody()->write("</br>");
        $i++;
    }
    return $response;
});

$app->run();
