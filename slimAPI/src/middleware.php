<?php

use Slim\App;
use Tuupola\Middleware\JwtAuthentication;

return function (App $app) {

    $app->add(new JwtAuthentication([
        "regexp" => "/(.*)/",
        "path" => "/api",
        "ignore" => ["/api/token"],
        "secret" => $app->getContainer()['settings']['secretKey']
    ]));
    
    $app->add(function($request, $response, $next) {
        $response = $next($request, $response);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });    

};
