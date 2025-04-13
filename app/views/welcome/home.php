<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Accueil - Gestion de Parc Informatique</title>
    <link rel="stylesheet" type="text/css" href="/projet-gestion-parc/public/assets/css/menu.css">
</head>
<body>
    <?php include __DIR__ . '/../common/header.php'; ?>
    <div class="content">
        <h2>Bienvenue dans l'application de Gestion de Parc Informatique</h2>
        <?php
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                echo "<p>Vous avez accès aux fonctionnalités administratives complètes.</p>";
            } else {
                echo "<p>Vous avez accès aux fonctionnalités de consultation uniquement.</p>";
            }
        ?>
    </div>
</body>
</html>
