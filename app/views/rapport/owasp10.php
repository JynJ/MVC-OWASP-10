<!-- /app/views/rapport/owasp10.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport de Sécurité OWASP 10</title>
    <link rel="stylesheet" type="text/css" href="/projet-gestion-parc/public/assets/css/rapports.css">
    <style>
      .pdf-container {
          width: 100%;
          height: 100vh;
          border: none;
      }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../common/header.php'; ?>
    <div class="content">
        <h2>Rapport de Sécurité OWASP 10</h2>
        <!-- Affichage direct du PDF dans une iframe -->
        <iframe class="pdf-container" src="/projet-gestion-parc/public/reports/Rapport de Sécurité et Bonnes Pratiques de Julians.pdf"></iframe>
    </div>
</body>
</html>
