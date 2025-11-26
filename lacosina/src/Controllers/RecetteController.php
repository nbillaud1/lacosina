<?php

namespace App\R301\Controller;
use App\R301\Model\Recette;
use App\R301\Controller\FavoriController;
use App\R301\Controller\CommentaireController;

class RecetteController {

    private $recetteModel;

    public function __construct() {
        $recetteModel = new Recette();
        $this->recetteModel = $recetteModel;
    }

    // Fonction permettant d'ajouter une nouvelle recette
    function ajouter() {
        //lien vers la vue recette
        require_once("src/Views/recettes/ajout.php");
    }

    // Fonction permettant d’enregistrer une nouvelle recette
    function enregistrer() { 
        // récupération des données de formulaire 
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $auteur = $_POST['auteur'];
        $image = $_FILES['image']['name'];
        $type_plat = $_POST['type_plat'];
        require_once('src/Views/recettes/enregistrer.php');

        // création ou modification d'une recette
        if (isset($_GET['id'])) {
            // modification d'une recette
            $ajoutOk = $this->recetteModel->update($_GET['id'], $titre, $description, $auteur, $image, $type_plat);
        } else {
            // création d'une nouvelle recette
            $ajoutOk = $this->recetteModel->add($titre, $description, $auteur, $image, $type_plat);
        }

        // l’ancienne image est conservée si aucune n’a été choisie
        // sinon, une nouvelle image est créée (erreur 4 = image non choisie)
        if ($_FILES['image']['error'] == 4) {
            $recipe = $this->recetteModel->find($_GET['id']);
            $image = $recipe['image'];
        } else {
            $image = $_FILES['image']['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        }
    }

    // Fonction permettant de lister les recettes
    function index() {
        $favoriController = new FavoriController();
        if((isset($_GET['filtre']) && $_GET['filtre'] === "tous") || !isset($_GET['filtre'])){
            $recipes = $this->recetteModel->findAll();
        }else if(isset($_GET['filtre'])){
            $recipes = $this->recetteModel->findBy(['type_plat' => $_GET['filtre']]);
        }
        require_once("src/Views/recettes/liste.php");
    }

    function detail($id) {
        // Ajout du contrôleur des favoris
        $favoriController = new FavoriController();
        $commentaireController = new CommentaireController();
        $existe = $favoriController->existe($id, isset($_SESSION['id']) ?$_SESSION['id']:null);
        $recipe = $this->recetteModel->find($id);
        $commentaires = $commentaireController->lister($id);
        require_once('src/Views/recettes/detail.php');
    }

    function modifier($id) {
        $recipe = $this->recetteModel->find($id);
        require_once("src/Views/recettes/modif.php");
    }

    function listerCommentaires(){
        $commentaireController = new CommentaireController();
        $commentaires = $commentaireController->listerTousLesCommentaires();
        require_once("src/Views/recettes/commentaires.php");
    }

    function supprimer($id){
        $favoriController = new FavoriController();
        $commentaireController = new CommentaireController();
        $this->recetteModel->delete($id);
        $favoriController->supprimer($id);
        $commentaireController->supprimerParRecette($id);
        $_SESSION['message'] = ['success' => 'Recette supprimée avec succès'];
        header("Location: ?c=home");
    }

}
