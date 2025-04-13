<!-- /app/views/common/header.php -->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>GESTION DE PARC INFORMATIQUE 2025 Jls</title>
    <link rel="stylesheet" type="text/css" href="/projet-gestion-parc/public/assets/css/menu.css">
</head>
<body>
    <header>
        <h2 class="header-title">GESTION DE PARC INFORMATIQUE Secure 2025 Jy</h2>
        <nav>
            <ul class="menu">
                <!-- Liens communs -->
                <li><a href="/projet-gestion-parc/public/index.php?controller=Welcome&action=home">Accueil</a></li>
                <li><a href="/projet-gestion-parc/public/index.php?controller=Materiel&action=list">Liste du matériel</a></li>
                
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <!-- Liens d'administration -->
                    <li><a href="/projet-gestion-parc/public/index.php?controller=Materiel&action=add">Ajouter un ordinateur</a></li>
                    <li><a href="/projet-gestion-parc/public/index.php?controller=Peripherique&action=add">Ajouter un périphérique</a></li>
                    <li><a href="/projet-gestion-parc/public/index.php?controller=Materiel&action=delete">Supprimer un matériel</a></li>
                <?php endif; ?>

                <li><a href="/projet-gestion-parc/public/index.php?controller=Service&action=list">Service</a></li>
                <li><a href="/projet-gestion-parc/public/index.php?controller=Rapport&action=owasp10">Rapport OWASP 10</a></li>
                <!-- Lien de déconnexion -->
                <li><a href="/projet-gestion-parc/public/index.php?controller=Auth&action=logout">Deco</a></li>
            </ul>
            <div class="search-container">
                <form action="/projet-gestion-parc/public/index.php?controller=Materiel&action=search" method="POST">
                    <input type="text" id="ordinateurs" name="ordinateurs" placeholder="Rechercher...">
                    <input type="submit" value="Rechercher">
                </form>
            </div>
        </nav>
    </header>
</body>
</html>
