<?php
// /app/controllers/WelcomeController.php

class WelcomeController {

    public function home() {
        // On n'appelle pas session_start() ici car elle est déjà démarrée dans index.php
        include __DIR__ . '/../views/welcome/home.php';
    }
}
