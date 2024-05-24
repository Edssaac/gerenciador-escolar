<?php

require_once(__DIR__ . '/system/vendor/autoload.php');

use Library\log;
use Exception;

set_exception_handler(function (Exception $exception) {
    log::write(sprintf(
        'Exceção: %s - Arquivo: %s - Linha: %s',
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine()
    ));

    $_SESSION['INTERNAL_SITUATION'] = 500;

    header('Location: /');
});

set_error_handler(function ($errorLevel, $errorMessage, $errorFile, $errorLine) {
    if (error_reporting() === 0) {
        return false;
    }

    switch ($errorLevel) {
        case E_NOTICE:
        case E_USER_NOTICE:
            $error = 'Notice';
            break;
        case E_WARNING:
        case E_USER_WARNING:
            $error = 'Warning';
            break;
        case E_ERROR:
        case E_USER_ERROR:
            $error = 'Fatal Error';
            break;
        default:
            $error = 'Unknown';
            break;
    }

    log::write(sprintf(
        '%s: %s - Arquivo: %s - Linha: %s',
        $error,
        $errorMessage,
        $errorFile,
        $errorLine
    ));

    return true;
});

function loadEnvironmentVariables()
{
    if (!file_exists(__DIR__ . '/.env')) {
        throw new Exception('Arquivo .env não encontrado no projeto!');
    }

    $lines = file(__DIR__ . '/.env');

    foreach ($lines as $line) {
        $line = trim($line);

        if (!empty($line)) {
            $var = explode('=', $line);

            $_ENV[trim($var[0])] = trim($var[1]);
        }
    }

    $requested = [
        'DB_HOST',
        'DB_NAME',
        'DB_USER',
        'DB_PASSWORD',
        'SCHOOL_NAME'
    ];

    $diff = array_diff_assoc($requested, array_keys($_ENV));

    if (!empty($diff)) {
        throw new Exception('Variáveis de ambiente não encontradas no arquivo .env!');
    }

    define('SCHOOL_NAME', $_ENV['SCHOOL_NAME']);
}

function handleRoute()
{
    $requestUri = $_SERVER['REQUEST_URI'];
    $url = parse_url(trim($requestUri, '/'), PHP_URL_PATH);
    $urlParts = explode('/', $url);

    $path = [
        'controller'    => !empty($urlParts[0]) ? strtolower($urlParts[0]) : 'home',
        'class'         => !empty($urlParts[1]) ? strtolower($urlParts[1]) : 'index',
        'method'        => !empty($urlParts[2]) ? strtolower($urlParts[2]) : 'index',
    ];

    // Criar o controlador de forma dinâmica
    $formattedPath = implode('/', [
        'App/Controller',
        ucfirst($path['controller']),
        ucfirst($path['class']) . 'Controller.php'
    ]);

    // Verificar se o controlador existe
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
        if (!defined('SCHOOL_NAME')) {
            define('SCHOOL_NAME', 'Escola');
        }

        // Chamar o método do controlador
        call_user_func(array($controllerObject, $path['method']));
    } else {
        header('Location: /');
    }
}

session_start();

if (!isset($_SESSION['INTERNAL_SITUATION'])) {
    loadEnvironmentVariables();
}

handleRoute();
