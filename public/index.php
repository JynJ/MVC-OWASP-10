<?php
// /public/index.php

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Envoi des headers de sécurité HTTP
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: no-referrer");
header("Content-Security-Policy: default-src 'self'");
header('Content-Type: text/html; charset=UTF-8');

// Si l'utilisateur n'est pas authentifié, rediriger vers le formulaire de login
if (!isset($_SESSION['user_id']) && (!isset($_GET['controller']) || $_GET['controller'] !== 'Auth')) {
    header("Location: /projet-gestion-parc/public/index.php?controller=Auth&action=loginForm");
    exit();
}

// Autoloader simple pour les contrôleurs et modèles
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../app/controllers/' . $class . '.php',
        __DIR__ . '/../app/models/' . $class . '.php',
    ];
    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Si aucun contrôleur ni action n'est précisé, on redirige par défaut vers le formulaire de login
if (!isset($_GET['controller']) && !isset($_GET['action'])) {
    header("Location: /projet-gestion-parc/public/index.php?controller=Auth&action=loginForm");
    exit();
}

$controller = $_GET['controller'] ?? 'Auth';
$action = $_GET['action'] ?? 'loginForm';

$controllerName = $controller . 'Controller';
$controllerFile = __DIR__ . '/../app/controllers/' . $controllerName . '.php';
if (!file_exists($controllerFile)) {
    die("Contrôleur non trouvé : $controllerName");
}
require_once $controllerFile;

$controllerInstance = new $controllerName();
if (!method_exists($controllerInstance, $action)) {
    die("Action non trouvée : $action dans $controllerName");
}
$controllerInstance->$action();
