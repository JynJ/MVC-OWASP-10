<?php
// /app/models/User.php

require_once __DIR__ . '/../../config/Database.php';

class User {
    private $pdo;
    
    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }
    
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("
            SELECT id, username, email, password, role, twofa_code, created_at
            FROM users
            WHERE email = ?
        ");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
    
    public function updateTwoFaCode($userId, $code) {
        $stmt = $this->pdo->prepare("UPDATE users SET twofa_code = ? WHERE id = ?");
        return $stmt->execute([$code, $userId]);
    }
    
    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
