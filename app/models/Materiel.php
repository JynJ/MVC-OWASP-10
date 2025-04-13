<?php
// /app/models/Materiel.php

require_once __DIR__ . '/../../config/Database.php';

class Materiel {
    private $pdo;
    
    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }
    
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM matériel");
        return $stmt->fetchAll();
    }
    
    public function add($data) {
        $stmt = $this->pdo->prepare("INSERT INTO matériel (Id_Mat, statut, Date_achat, reference, Nom, Prix) VALUES (:Id_Mat, :statut, :Date_achat, :reference, :Nom, :Prix)");
        return $stmt->execute($data);
    }
    
    public function update($id, $data) {
        // Mise à jour basée sur la clé primaire Id_Mat
        $stmt = $this->pdo->prepare("UPDATE matériel SET Nom = :Nom, Prix = :Prix, statut = :statut WHERE Id_Mat = :Id_Mat");
        $data['Id_Mat'] = $id;
        return $stmt->execute($data);
    }
    
    public function delete($id, $Nom) {
        $stmt = $this->pdo->prepare("DELETE FROM matériel WHERE Id_Mat = :Id_Mat AND Nom = :Nom");
        return $stmt->execute(['Id_Mat' => $id, 'Nom' => $Nom]);
    }
    
    public function searchById($id)
{
    $stmt = $this->pdo->prepare("SELECT * FROM matériel WHERE Id_Mat = :id");
    $stmt->execute(['id' => $id]);
    // fetchAll() retourne un tableau (même s’il n’y a qu’un résultat)
    return $stmt->fetchAll();
}

// Variante par Nom si vous préférez
public function searchByNom($Nom)
{
    $stmt = $this->pdo->prepare("SELECT * FROM matériel WHERE Nom LIKE :Nom");
    // On encadre la chaîne avec des pourcentages pour une recherche partielle
    $stmt->execute(['Nom' => '%' . $Nom . '%']);
    return $stmt->fetchAll();
}

public function getById($id)
{
    $stmt = $this->pdo->prepare("SELECT * FROM matériel WHERE Id_Mat = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}




}
