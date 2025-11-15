<?php
require_once("src/Models/Database.php");

class Favori {
    private $conn;

    // Constructeur
    function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function findAll() {
        $query = "SELECT * FROM favoris";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $query = "SELECT * FROM favoris WHERE id = '$id'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findBy(array $params) {
        $query = "SELECT * FROM favoris WHERE ". implode(' AND ',
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

    public function add($recette_id, $user_id) {
        $query = "INSERT INTO favoris (recette_id, user_id, creation_time)
        VALUES (:recette_id, :user_id, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':recette_id', $recette_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $_SESSION['message'] = ['success' => 'Recette ajoutée aux favoris'];
        return $this->conn->lastInsertId();
    }

    public function update($id, $recette_id, $user_id) {
        $query = "UPDATE favoris SET recette_id = :recette_id, user_id =
        :user_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':recette_id', $recette_id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    public function delete($id_recette, $user_id) {
        $query = "DELETE FROM favoris WHERE recette_id = :recette_id AND user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':recette_id', $id_recette);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $_SESSION['message'] = ['success' => 'Recette retirée des favoris'];
        return $stmt->rowCount() > 0;
    }

}