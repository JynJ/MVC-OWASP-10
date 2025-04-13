<?php
// /app/controllers/MaterielController.php

require_once __DIR__ . '/../models/Materiel.php';
require_once __DIR__ . '/../helpers/security.php';

class MaterielController {

    public function list() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header("Location: /public/index.php");
            exit();
        }
        $materielModel = new Materiel();
        $materiels = $materielModel->getAll();
        include __DIR__ . '/../views/materiel/list.php';
    }

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

            // Sanitiser les champs
            $id_ordinateur = filter_var($_POST['id_ordinateur'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $Nom           = filter_var($_POST['Nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $Prix          = filter_var($_POST['Prix'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $statut        = filter_var($_POST['statut'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $reference     = filter_var($_POST['reference'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date          = filter_var($_POST['date'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Vérification du champ Nom : autorise seulement lettres, chiffres, espace, tiret et underscore
            if (!preg_match('/^[a-zA-Z0-9 \-_]+$/', $Nom)) {
                $message = "Le nom ne doit contenir que des lettres, chiffres, espaces, tirets ou underscores.";
                include __DIR__ . '/../views/materiel/add.php';
                exit();
            }

            $data = [
                'Id_Mat'    => $id_ordinateur,
                'Nom'       => $Nom,
                'Prix'      => $Prix,
                'statut'    => $statut,
                'reference' => $reference,
                'Date_achat'=> $date
            ];
            $materielModel = new Materiel();
            $added = $materielModel->add($data);
            if ($added) {
                $message = "L'ordinateur a bien été ajouté.";
            } else {
                $message = "Erreur lors de l'ajout de l'ordinateur.";
            }
        }
        include __DIR__ . '/../views/materiel/add.php';
    }

    public function update() {
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
            $id = filter_var($_POST['id_ordinateur'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $Nom = filter_var($_POST['Nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $Prix = filter_var($_POST['Prix'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $statut = filter_var($_POST['statut'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'Nom'    => $Nom,
                'Prix'   => $Prix,
                'statut' => $statut
            ];
            $materielModel = new Materiel();
            $updated = $materielModel->update($id, $data);
            if ($updated) {
                $message = "La modification a bien été effectuée.";
            } else {
                $message = "Erreur lors de la modification.";
            }
        }
        include __DIR__ . '/../views/materiel/edit.php';
    }

    public function delete() {
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
            $id = filter_var($_POST['id_materiel'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $Nom = filter_var($_POST['Nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $materielModel = new Materiel();
            // Vérifier d'abord que l'élément existe
            $existing = $materielModel->getById($id);
            if (!$existing || strtolower($existing['Nom']) !== strtolower($Nom)) {
                $message = "Matériel non trouvé ou information erronée. Suppression annulée.";
            } else {
                $deleted = $materielModel->delete($id, $Nom);
                if ($deleted) {
                    $message = "Le matériel a bien été supprimé.";
                } else {
                    $message = "Erreur lors de la suppression du matériel.";
                }
            }
        }
        include __DIR__ . '/../views/materiel/delete.php';
    }

    public function search() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header("Location: /projet-gestion-parc/public/index.php?controller=Auth&action=login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = trim($_POST['ordinateurs']);
            $input = filter_var($input, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $materielModel = new Materiel();
            if (is_numeric($input)) {
                $materiels = $materielModel->searchById($input);
            } else {
                $materiels = $materielModel->searchByNom($input);
            }
            include __DIR__ . '/../views/materiel/list.php';
            exit();
        }
        header("Location: /projet-gestion-parc/public/index.php?controller=Materiel&action=list");
        exit();
    }

    public function editForm() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header("Location: /projet-gestion-parc/public/index.php?controller=Auth&action=login");
            exit();
        }
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null;
        if (!$id) {
            header("Location: /projet-gestion-parc/public/index.php?controller=Materiel&action=list");
            exit();
        }
        $materielModel = new Materiel();
        $materiel = $materielModel->getById($id);
        if (!$materiel) {
            header("Location: /projet-gestion-parc/public/index.php?controller=Materiel&action=list");
            exit();
        }
        include __DIR__ . '/../views/materiel/edit.php';
    }
}
