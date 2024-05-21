<?php

require_once(__DIR__ . '/vendor/autoload.php');

function handleRoute($url)
{
    $urlParts = explode('/', $url);

    $path = [
        'controller'    => !empty($urlParts[0]) ? strtolower($urlParts[0]) : 'home',
        'class'         => !empty($urlParts[1]) ? strtolower($urlParts[1]) : 'index',
        'method'        => !empty($urlParts[2]) ? strtolower($urlParts[2]) : 'index',
    ];

    $formattedPath = implode('/', [
        'App/Controller',
        ucfirst($path['controller']),
        ucfirst($path['class']) . 'Controller.php'
    ]);

    if (!file_exists($formattedPath)) {
        header('Location: /');
    }

    $request = file_get_contents("php://input");

    if (empty($_POST) && !empty($request)) {
        $_POST = json_decode($request, true);
    }

    if (empty($_POST)) {
        $path['method'] = 'index';
    }

    include_once($formattedPath);

    $controllerClass = implode('\\', [
        'App\\Controller',
        ucfirst($path['controller']),
        ucfirst($path['class']) . 'Controller'
    ]);

    $controllerObject = new $controllerClass();

    // Verificar se o método existe no controlador
    if (method_exists($controllerObject, $path['method'])) {
        // Chamar o método do controlador
        call_user_func(array($controllerObject, $path['method']));
    } else {
        header('Location: /');
    }
}

// Obter a URL da solicitação
$requestUri = $_SERVER['REQUEST_URI'];
$url = parse_url(trim($requestUri, '/'), PHP_URL_PATH);

// Manipular a rota
handleRoute($url);
