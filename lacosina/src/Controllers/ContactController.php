<?php

namespace App\R301\Controller;
use App\R301\Model\Contact;

class ContactController {

    private $contactModel;

    public function __construct() {
        $contactModel = new Contact();
        $this->contactModel = $contactModel;
    }

    // Fonction permettant d'ajouter un contact
    public function ajouter() {
        //lien vers la vue contact
        require_once("src/Views/contacts/contact.php");
    }

    // Fonction permettant d’enregistrer un contact
    public function enregistrer() {
        // récupération des données de formulaire
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $mail = $_POST['mail'];

        $this->contactModel->add($nom, $mail, $description);
        require_once('src/Views/contacts/ajout_contact.php');

        // ============================== Essai Envoie Mail censé marcher sur un vrai hébergeur =====================================
        /*
        // Préparation du mail
        $to = "nathan.billaud@etu.unilim.fr";
        $subject = "Mail envoyé par 'lacosina'";
        $headers = "From: $mail";

        // Envoi du mail
        if (mail($to, $subject, $description, $headers)) {
            echo "Email envoyé avec succès.";
        } else {
            echo "Échec de l'envoi de l'email.";
        }
        */
    }
}
