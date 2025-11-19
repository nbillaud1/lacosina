<?php
require_once("src/Models/Database.php");

class Commentaire {
    private $conn;

    // Constructeur
    function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function findAll() {
        $query = "SELECT * FROM comments ORDER BY create_time DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $query = "SELECT * FROM comments WHERE id = '$id'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findBy(array $params) {
        $query = "SELECT * FROM comments WHERE ". implode(' AND ',
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

    public function add($pseudo, $commentaire, $recette_id) {
        $query = "INSERT INTO comments (pseudo, commentaire, create_time, recette_id)
        VALUES (:pseudo, :commentaire, NOW(), :recette_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':commentaire', $commentaire);
        $stmt->bindParam(':recette_id', $recette_id);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function update($id, $pseudo, $commentaire, $recette_id) {
        $query = "UPDATE comments SET recette_id = :recette_id, pseudo =
        :pseudo, commentaire = :commentaire WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':commentaire', $commentaire);
        $stmt->bindParam(':recette_id', $recette_id);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM comments WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function delete_recette($recette_id) {
        $query = "DELETE FROM comments WHERE recette_id = :recette_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':recette_id', $recette_id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

}