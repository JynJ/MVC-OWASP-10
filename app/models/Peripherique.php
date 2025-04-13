<?php
// /app/models/Peripherique.php

require_once __DIR__ . '/../../config/Database.php';

class Peripherique {
    private $pdo;
    
    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }
    
    public function add($data) {
        // Ici on utilise la même table que pour le matériel.
        $stmt = $this->pdo->prepare("INSERT INTO matériel (Id_Mat, statut, Date_achat, reference, Nom, Prix) VALUES (:Id_Mat, :statut, :Date_achat, :reference, :Nom, :Prix)");
        return $stmt->execute($data);
    }
}
