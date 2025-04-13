<!-- /app/views/materiel/edit.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Modifier Matériel</title>
    <link rel="stylesheet" type="text/css" href="/projet-gestion-parc/public/assets/css/se_connecter.css">
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
    <?php include __DIR__ . '/../../helpers/functions.php'; ?>
    <div class="content">
        <div class="card">
            <h2>Modifier Matériel</h2>
            <?php if (isset($message) && !empty($message)): ?>
                <p style="color: green; font-weight: bold;"><?php echo e($message); ?></p>
            <?php endif; ?>
            <form method="POST" action="/projet-gestion-parc/public/index.php?controller=Materiel&action=update">
                <p>
                    <label>Id Ordinateur :</label>
                    <input type="text" name="id_ordinateur"
                           value="<?php echo isset($materiel['Id_Mat']) ? e($materiel['Id_Mat']) : ''; ?>"
                           readonly required>
                </p>
                <p>
                    <label>Nouveau Nom :</label>
                    <input type="text" name="Nom"
                           value="<?php echo isset($materiel['Nom']) ? e($materiel['Nom']) : ''; ?>"
                           required>
                </p>
                <p>
                    <label>Nouveau Prix :</label>
                    <input type="number" name="Prix"
                           value="<?php echo isset($materiel['Prix']) ? e($materiel['Prix']) : ''; ?>"
                           required>
                </p>
                <p>
                    <label>Nouveau Statut :</label>
                    <input type="text" name="statut"
                           value="<?php echo isset($materiel['Statut']) ? e($materiel['Statut']) : ''; ?>"
                           required>
                </p>
               
                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">

                <p>
                <input type="submit" value="Modifier">
                </p>
            </form>
        </div>
    </div>
</body>
</html>
