<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Usuario;
use \Firebase\JWT\JWT;

$app->post('/api/token', function($request, $response) {

    $dados = $request->getParsedBody();

    $email = $dados['email'] ?? null;
    $senha = $dados['senha'] ?? null;

    $usuario = Usuario::where('email', $email)->first();


    if ( !is_null($usuario) && (md5($senha) === $usuario->senha) ) {

        $secretKey = $app->get['settings']['secretKey'];
        $apiKey = JWT::encode($usuario, $secretKey);

        return $response->withJson(['apiKey' => $apiKey]);

    }
    
    return $response->withJson(['status' => 'Error']);

});