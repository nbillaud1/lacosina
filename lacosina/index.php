<?php
session_start();
// import de la classe RecetteController
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . 'RecetteController.php');
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . 'ContactController.php');
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . 'UserController.php');
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . 'FavoriController.php');

// ajout de l'en tête
if (!isset($_GET['x'])) {
    require_once("src/Views/page/header.php");
}

// mise en place de la route actuelle
$controller = isset($_GET['c']) ? $_GET['c'] : 'home';
$action = isset($_GET['a']) ? $_GET['a'] : 'index';
$id_recette = isset($_GET['id']) ? $_GET['id'] : null;
$id_usr = isset($_GET['id_usr']) ? $_GET['id_usr'] : null;

// définition des routes disponibles
switch ($controller) {

    case 'home':
        require_once("src/Controllers/homeController.php");
        break;

    // routes pour la gestion des recettes
    case 'Recette':
        $recetteController = new RecetteController();
        switch ($action) {
            case 'index':
                $recetteController->index();
                break;
            case 'ajouter':
                $recetteController->ajouter();
                break;
            case 'enregistrer':
                $recetteController->enregistrer();
                break;
            case 'detail':
                $recetteController->detail($id_recette);
                break;
            case 'modifier':
                $recetteController->modifier($id_recette);
                break;
        }
        break;

    // routes pour la gestion des contacts
    case 'Contact':
        $contactController = new ContactController();
        switch ($action) {
            case 'formulaire':
                $contactController->ajouter();
                break;
            case 'enregistrer':
                $contactController->enregistrer();
                break;
        }
        break;

    // routes pour la gestion des users
    case 'User':
        $userController = new UserController();
        switch ($action) {
            case 'inscription':
                $userController->inscription();
                break;
            case 'inscrire':
                $userController->enregistrer();
            case 'connexion':
                $userController->connexion();
                break;
            case 'connecter':
                $userController->verifieConnexion();
                break;
            case 'deconnexion':
                $userController->deconnexion();
                break;
            case 'profil':
                $userController->profil();
                break;
            /*case 'modifier_profil':
                $userController->modifier_profil($id_usr);
                break;*/
        }

        // routes pour la gestion des favoris
        case 'Favori':
            $favoriController = new FavoriController();
            switch ($action) {
                case 'favoris':
                    $favoriController->afficher();
                    break;
                case 'getFavoris':
                    $favoriController->getFavoris();
                    break;
                case 'ajouter':
                    $favoriController->ajouter($id_recette);
                    break;
                case 'supprimer':
                    $favoriController->supprimer($id_recette);
                    break;
            }
}


//ajout du pied de page
if(!isset($_GET['x'])){
    require_once("src/Views/page/footer.php");
}