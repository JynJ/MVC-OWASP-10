<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <?php include __DIR__ . '/../../helpers/functions.php'; ?>

    <title>Connexion (2FA)</title>
    <link rel="stylesheet" type="text/css" href="/projet-gestion-parc/public/assets/css/login.css">
</head>
<body>
<div class="login-container">
    <h2>Connexion Sécurisée</h2>
    <?php if (!empty($error)) : ?>
        <p class="error-msg"><?php echo e($error); ?></p>
    <?php endif; ?>
    <form method="POST" action="/projet-gestion-parc/public/index.php?controller=Auth&action=login">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>

        <!-- Champ CSRF caché -->
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <button type="submit">Se Connecter</button>
    </form>
</div>
</body>
</html>
