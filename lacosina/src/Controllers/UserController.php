<?php

// connexion à la base de données
require_once("src/Models/User.php");

class UserController {

    private $userModel;

    public function __construct() {
        $userModel = new User();
        $this->userModel = $userModel;
    }

    // Fonction permettant d'ajouter un nouveau user
    public function inscription() {
        //lien vers la vue inscription
        require_once("src/Views/users/inscription.php");
    }

    public function enregistrer() {
        // récupération des données de formulaire
        $identifiant = $_POST['identifiant'];
        $password = $_POST['pwd'];
        $mail = $_POST['mail'];

        $this->userModel->add($identifiant, password_hash($password,PASSWORD_DEFAULT), $mail);
        require_once('src/Views/users/enregistrement.php');
    }

    public function connexion() {
        //lien vers la vue connexion
        require_once("src/Views/users/connexion.php");
    }

    public function deconnexion(){
        session_destroy();
        header('Location: ?c=home'); // pour refresh la page quand on se déconnecte
    }

    public function verifieConnexion(){

        $identifiant = $_POST['identifiant'];
        $password = $_POST['pwd'];

        // Vérification du mdp et de l'identifiant
        $user = $this->userModel->findBy(['identifiant' => $identifiant])[0];

        if ($user && password_verify($password, $user['password'])){
            $_SESSION['id'] = $user['id'];
            $_SESSION['identifiant'] = $user['identifiant'];
            $_SESSION['mail'] = $user['mail'];
            $_SESSION['isAdmin'] = $user['isAdmin'];

            header('Location: ?c=home'); // pour refresh la page quand on se connecte
        }
        else{
            echo '<div>Identifiant ou mot de passe incorrecte.</div>';
        }

    }

    public function profil() {
        $user = $this->userModel->findBy(['id' => $_SESSION['id']])[0];
        // lien vers la vue profil
        require_once('src/Views/users/profil.php');
    }

    /*public function modifier_profil($id) {
        $identifiant = $_POST['profil_identifiant'];
        $password = $_SESSION['password']; // On ne veut pas changer le password ici
        $mail = $_POST['profil_mail'];

        $this->userModel->update($id, $identifiant, $password, $mail);

        // Met à jour les variables de session
        $_SESSION['identifiant'] = $identifiant;
        $_SESSION['mail'] = $mail;
    }*/
}