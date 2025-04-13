<?php
// /app/controllers/AuthController.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/User.php';

class AuthController {

    // Affiche le formulaire de connexion
    public function loginForm() {
        // Générer un token CSRF si inexistant
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        include __DIR__ . '/../views/auth/login.php';
    }

    // Traite le login initial : vérifie l'email, le mot de passe et le token CSRF, génère et affiche le code 2FA
    public function login() {
        // Vérifier le token CSRF
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $error = "Erreur de sécurité (CSRF). Veuillez réessayer.";
            include __DIR__ . '/../views/auth/login.php';
            exit();
        }

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        $userModel = new User();
        $user = $userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // Génération d'un code 2FA à 6 chiffres
            $code = random_int(100000, 999999);
            // Stockage temporaire du 2FA dans la session
            $_SESSION['2fa_user'] = $user['id'];
            $_SESSION['2fa_code'] = $code;
            // Mise à jour du code 2FA en BDD (optionnel)
            $userModel->updateTwoFaCode($user['id'], $code);
            // Pour les tests en local, afficher le code (à retirer en production)
            echo "<p style='text-align:center; font-weight:bold; color:green;'>Code 2FA : $code</p>";
            // Générer un nouveau token CSRF pour le prochain formulaire (optionnel)
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            include __DIR__ . '/../views/auth/verify_2fa.php';
            exit();
        } else {
            $error = "Email ou mot de passe incorrect.";
            include __DIR__ . '/../views/auth/login.php';
        }
    }

    // Vérifie le code 2FA et redirige vers la page d'accueil pour tous
    public function verify2fa() {
        // Vérifier le token CSRF dans le formulaire de vérification si vous l'ajoutez (optionnel)
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $error = "Erreur de sécurité (CSRF). Veuillez réessayer.";
            include __DIR__ . '/../views/auth/verify_2fa.php';
            exit();
        }

        $enteredCode = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_NUMBER_INT);

        if (!isset($_SESSION['2fa_user']) || !isset($_SESSION['2fa_code'])) {
            header("Location: /projet-gestion-parc/public/index.php?controller=Auth&action=loginForm");
            exit();
        }

        if ($enteredCode == $_SESSION['2fa_code']) {
            $userId = $_SESSION['2fa_user'];
            unset($_SESSION['2fa_user'], $_SESSION['2fa_code']);

            $userModel = new User();
            $user = $userModel->findById($userId);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];  // 'admin' ou 'user'
                // Générer un nouveau token CSRF pour les prochaines actions (optionnel)
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                // Redirection : tous vont vers Welcome->home ; le header affichera dynamiquement les liens selon le rôle
                header("Location: /projet-gestion-parc/public/index.php?controller=Welcome&action=home");
                exit();
            } else {
                header("Location: /projet-gestion-parc/public/index.php?controller=Auth&action=loginForm");
                exit();
            }
        } else {
            $error = "Code 2FA invalide.";
            include __DIR__ . '/../views/auth/verify_2fa.php';
        }
    }

    // Déconnexion de l'utilisateur
    public function logout() {
        session_destroy();
        header("Location: /projet-gestion-parc/public/index.php?controller=Auth&action=loginForm");
        exit();
    }
}
