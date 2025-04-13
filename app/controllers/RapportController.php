<?php
// /app/controllers/RapportController.php

class RapportController {

    public function owasp10() {
        // Optionnel : vérifiez la session ou tout autre accès si nécessaire
        include __DIR__ . '/../views/rapport/owasp10.php';
    }
}
