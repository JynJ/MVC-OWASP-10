<!-- /app/views/materiel/delete.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Supprimer Matériel</title>
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
    include __DIR__ . '/../common/header.php'; 
    ?>
    <div class="content">
        <div class="card">
            <h2>Supprimer un Matériel</h2>
            
            <!-- Affichage conditionnel du message -->
            <?php if (isset($message) && !empty($message)): ?>
                <p style="color: green; font-weight: bold;"><?php echo $message; ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <p>
                    <label>Id Matériel :</label>
                    <input type="text" name="id_materiel" required>
                </p>
                <p>
                    <label>Nom :</label>
                    <input type="text" name="Nom" required>
                </p>
              

                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">

                <p>
                <input type="submit" value="Supprimer">
                </p>
            </form>
        </div>
    </div>
</body>
</html>
