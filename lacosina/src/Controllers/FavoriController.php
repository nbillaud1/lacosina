<?php

// connexion à la base de données
namespace App\R301\Controller;
use App\R301\Model\Favori;
use App\R301\Model\Recette;

class FavoriController {

    private $favoriModel;
    private $recetteModel;

    public function __construct() {
        $favoriModel = new Favori();
        $this->favoriModel = $favoriModel;
        $recetteModel = new Recette();
        $this->recetteModel = $recetteModel;
    }

    public function ajouter($id_recette){
        // récupération de l'id de l'utilisateur connecté
        $id_utilisateur = $_SESSION['id'];
        // vérification si l'utilisateur a déjà ajouté cette recette à ses favoris
        $ajout = $this->favoriModel->findBy(['user_id' => $id_utilisateur, 'recette_id' => $id_recette]);
        if (count($ajout) == 0) {
            $this->favoriModel->add($id_recette, $id_utilisateur);
        }
        header("Location: ?c=home");
    }

    public function supprimer($id_recette){
        $id_utilisateur = $_SESSION['id'];
        $this->favoriModel->delete($id_recette, $id_utilisateur);
        header("Location: ?c=home");
    }

    public function afficher(){
        require_once('src/Views/favoris/favoris.php');
    }

    public function getFavoris(){
        $id_utilisateur = $_SESSION['id'];
        // Fonction permettant de récupérer les recettes favorites d'un utilisateur
        $favoris = $this->favoriModel->findBy(['user_id' => $id_utilisateur]);
        $recettesFavori = [];
        foreach ($favoris as $favori) {
            $recette = $this->recetteModel->find($favori['recette_id']);
            $recettesFavori[] = $recette;
        }
        echo json_encode($recettesFavori);
    }

    public function existe($id_recette, $id_utilisateur){
        return count($this->favoriModel->findBy(['user_id' => $id_utilisateur, 'recette_id' => $id_recette])) !== 0;
    }
}