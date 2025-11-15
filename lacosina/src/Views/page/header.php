<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>La Cosina</title>
<!-- Bootstrap CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet" integrity="sha384-
QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous"></script>
<script src="src/Views/js/recipes.js" defer></script>
<script src="src/Views/js/users.js" defer></script>
</head>
<body>
<!-- menu de navigation -->
<nav class="navbar navbar-expand-lg bg-body-tertiary justify-content-between">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="?c=home">Accueil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?c=Recette&a=index">Recettes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?c=Contact&a=formulaire">Contact</a>
        </li>
        <?php if (isset($_SESSION['identifiant'])) { ?>
            <li class="nav-item">
                <a class="nav-link" href="?c=Recette&a=ajouter">Ajouter une recette</a>
            </li>
            <li>
                <a href="?c=Favori&a=favoris" class="nav-link">Mes recettes favorites</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?c=User&a=profil">Profil de <?php echo $_SESSION['identifiant']?></a>
            </li>
        <?php } ?>
    </ul>
    <ul class="navbar-nav">
        <?php if (isset($_SESSION['identifiant'])) { ?>
            <li class="nav-item">
                <a class="btn btn-outline-dark" href="?c=User&a=deconnexion">Déconnexion</a>
            </li>
        <?php } else { ?>
            <li class="nav-item">
                <a class="btn btn-outline-dark" href="?c=User&a=inscription">Inscription</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-outline-dark" href="?c=User&a=connexion">Connexion</a>
            </li>
        <?php } ?>
    </ul>
</nav>
<?php if(isset($_SESSION['message'])) : ?>
    <?php foreach ($_SESSION['message'] as $type => $message) { ?>
        <div class="alert alert-<?php echo $type; ?>">
            <?php echo $message; ?>
        </div>
<?php } endif; unset($_SESSION['message']); ?>
<!-- corps de la page -->
<div class="container w-75 m-auto">