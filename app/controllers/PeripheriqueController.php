<?php
// /app/controllers/PeripheriqueController.php

require_once __DIR__ . '/../models/Peripherique.php';
require_once __DIR__ . '/../helpers/security.php';

class PeripheriqueController {

    public function add() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header("Location: /projet-gestion-parc/public/index.php?controller=Auth&action=login");
            exit();
        }
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifier le token CSRF
            if (!isset($_POST['csrf_token']) || !validate_csrf_token($_POST['csrf_token'])) {
                die("Erreur CSRF. Opération annulée.");
            }
            // Sanitiser les entrées
            $id_peripherique = filter_var($_POST['id_peripherique'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $Nom             = filter_var($_POST['Nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $Prix            = filter_var($_POST['Prix'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $statut          = filter_var($_POST['statut'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $reference       = filter_var($_POST['reference'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date            = filter_var($_POST['date'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'Id_Mat'    => $id_peripherique,
                'Nom'       => $Nom,
                'Prix'      => $Prix,
                'statut'    => $statut,
                'reference' => $reference,
                'Date_achat'=> $date
            ];
            $peripheriqueModel = new Peripherique();
            $added = $peripheriqueModel->add($data);
            if ($added) {
                $message = "Le périphérique a bien été ajouté.";
            } else {
                $message = "Erreur lors de l'ajout du périphérique.";
            }
        }
        include __DIR__ . '/../views/peripherique/add.php';
    }

    // Ajoutez ici d'autres méthodes pour update, delete, search, etc., de la même manière.
}
