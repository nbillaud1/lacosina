<?php

// connexion à la base de données
require_once("src/Models/Recette.php");

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
        require_once('src/Views/recettes/enregistrer.php');

        // création ou modification d'une recette
        if (isset($_GET['id'])) {
            // modification d'une recette
            $ajoutOk = $this->recetteModel->update($_GET['id'], $titre, $description, $auteur, $image);
        } else {
            // création d'une nouvelle recette
            $ajoutOk = $this->recetteModel->add($titre, $description, $auteur, $image);
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
        $recipes = $this->recetteModel->findAll();
        require_once("src/Views/recettes/liste.php");
    }

    function detail($id) {
        $recipe = $this->recetteModel->find($id);
        require_once("src/Views/recettes/detail.php");
    }

    function modifier($id) {
        $recipe = $this->recetteModel->find($id);
        require_once("src/Views/recettes/modif.php");
    }

}
