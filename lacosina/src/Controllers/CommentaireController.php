<?php

// connexion à la base de données
require_once("src/Models/Commentaire.php");

class CommentaireController {

    private $commentaireModel;

    public function __construct() {
        $commentaireModel = new Commentaire();
        $this->commentaireModel = $commentaireModel;
    }

    public function lister($id_recette) {
        $commentaires = $this->commentaireModel->findBy(['recette_id' => $id_recette]);
        return $commentaires;
    }

    public function listerTousLesCommentaires() {
        $commentaires = $this->commentaireModel->findAll();
        return $commentaires;
    }

    public function ajouter($id_recette) {
        if (isset($_SESSION['identifiant'])) {
            $pseudo = $_SESSION['identifiant'];
        } else {
            $pseudo = "Anonyme";
        }
        $commentaire = $_POST['commentaire'];
        $this->commentaireModel->add($pseudo, $commentaire, $id_recette);
    }

    public function supprimer($id_commentaire) {
        $this->commentaireModel->delete($id_commentaire);
        $_SESSION['message'] = ['success' => 'Commentaire supprimé avec succès'];
        header("Location: ?c=home");
    }

    public function supprimerParRecette($recette_id) {
        $this->commentaireModel->delete_recette($recette_id);
    }
}