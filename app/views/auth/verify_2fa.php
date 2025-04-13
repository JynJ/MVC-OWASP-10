<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <?php include __DIR__ . '/../../helpers/functions.php'; ?>

    <title>Vérification 2FA</title>
    <link rel="stylesheet" type="text/css" href="/projet-gestion-parc/public/assets/css/login.css">
</head>
<body>
<div class="login-container">
    <h2>Vérification du code 2FA</h2>
    <?php if (!empty($error)) : ?>
        <p class="error-msg"><?php echo e($error); ?></p>
    <?php endif; ?>
    <form method="POST" action="/projet-gestion-parc/public/index.php?controller=Auth&action=verify2fa">
        <label for="code">Entrez le code 2FA :</label>
        <input type="text" name="code" id="code" maxlength="6" required>
        
        <!-- (Optionnel) Champ CSRF pour la vérification 2FA -->
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <button type="submit">Vérifier</button>
    </form>
</div>
</body>
</html>
