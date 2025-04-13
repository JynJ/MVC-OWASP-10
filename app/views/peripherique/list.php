<!-- /app/views/peripherique/list.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Périphériques</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/menu.css">
</head>
<body>
<?php
    // Assurez-vous que la session est démarrée (sinon, le démarrage se fait dans le front controller)
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Inclure les helpers ; ici le chemin est d'un niveau vers "helpers"
    include __DIR__ . '/../../helpers/security.php';
    include __DIR__ . '/../../helpers/functions.php';

    // Générer le token CSRF
    $token = csrf_token(); ?>
    <?php include __DIR__ . '/../common/header.php'; ?>
    <h2>Liste des Périphériques</h2>
    <!-- Pour implémentez plus tard une table semblable a celle de matériel !-->
</body>
</html>
