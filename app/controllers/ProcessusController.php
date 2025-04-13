<?php
// /app/controllers/ProcessusController.php

require_once __DIR__ . '/../models/Materiel.php';

class ProcessusController {

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /public/index.php");
            exit();
        }
        $materielModel = new Materiel();
        $materiels = $materielModel->getAll();
        // Affichage simplifié pour démonstration
        include __DIR__ . '/../views/processus/index.php';
    }
}
