<!-- /app/views/materiel/list.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste du Matériel</title>
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
    $token = csrf_token(); ?>
    <?php include __DIR__ . '/../common/header.php'; ?>
    <?php include __DIR__ . '/../../helpers/functions.php'; ?>
    <h2>Liste du Matériel</h2>

    <?php if (empty($materiels)): ?>
        <p>Aucun élément trouvé.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Id_Mat</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Date_Achat</th>
                <th>Statut</th>
                <th>Référence</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($materiels as $m): ?>
                <tr>
                    <td><?php echo e($m['Id_Mat']); ?></td>
                    <td><?php echo e($m['Nom']); ?></td>
                    <td><?php echo e($m['Prix']); ?></td>
                    <td><?php echo e($m['Date_achat']); ?></td>
                    <td><?php echo e($m['Statut']); ?></td>
                    <td><?php echo e($m['reference']); ?></td>
                    <td>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="/projet-gestion-parc/public/index.php?controller=Materiel&action=edit&id=<?php echo $m['Id_Mat']; ?>">Modifier</a>
                    <?php else: ?>
                        <!-- Pas de lien de modification pour les utilisateurs normaux -->
                        -
                    <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
