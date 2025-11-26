<?php

namespace App\R301\Model;
use App\R301\Model\Database;
use PDO;

class Recette {
    private $conn;

    // Constructeur
    function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function findAll() {
        $query = "SELECT * FROM recettes";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $query = "SELECT * FROM recettes WHERE id = '$id'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findBy(array $params) {
        $query = "SELECT * FROM recettes WHERE ". implode(' AND ',
        array_map(function($key) {
            return "$key = :$key";
        }, array_keys($params)));

        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($titre, $description, $auteur, $image, $type_plat) {
        $query = "INSERT INTO recettes (titre, description, auteur, image, date_creation, type_plat)
        VALUES (:titre, :description, :auteur, :image, NOW(), :type_plat)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':auteur', $auteur);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':type_plat', $type_plat);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function update($id, $titre, $description, $auteur, $image, $type_plat) {
        $query = "UPDATE recettes SET titre = :titre, description = :description, auteur =
        :auteur, image = :image, type_plat = :type_plat WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':auteur', $auteur);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':type_plat', $type_plat);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM recettes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

}
