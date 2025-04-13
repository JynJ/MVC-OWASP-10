<!-- /app/views/materiel/add.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ajouter Matériel</title>
    <link rel="stylesheet" type="text/css" href="/projet-gestion-parc/public/assets/css/menu.css">
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
    $token = csrf_token();

    // Inclure ensuite le header commun
    include __DIR__ . '/../common/header.php';
    ?>
    
    <div class="content">
        <div class="card">
            <h2>Ajouter un Ordinateur</h2>
            <!-- Affichage du message de confirmation s'il existe -->
            <?php if (isset($message) && !empty($message)): ?>
                <p style="color: green; font-weight: bold;"><?php echo $message; ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <p>
                    <label>Id Ordinateur :</label>
                    <input type="text" name="id_ordinateur" required>
                </p>
                <p>
                    <label>Nom :</label>
                    <input type="text" name="Nom" required>
                </p>
                <p>
                    <label>Prix :</label>
                    <input type="number" name="Prix" required>
                </p>
                <p>
                    <label>Date d'achat :</label>
                    <input type="date" name="date" required>
                </p>
                <p>
                    <label>Référence :</label>
                    <input type="text" name="reference" required>
                </p>
                <p>
                    <label>Statut :</label>
                    <input type="text" name="statut" required>
                </p>
                
                <!-- Champ CSRF caché -->
                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                
                <p>
                    <input type="submit" value="Ajouter">
                </p>
            </form>
        </div>
    </div>
</body>
</html>
