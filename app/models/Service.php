<?php
// /app/models/Service.php

require_once __DIR__ . '/../../config/Database.php';

class Service {
    private $pdo;
    
    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }
    
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM service");
        return $stmt->fetchAll();
    }
}
