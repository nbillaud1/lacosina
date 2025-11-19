<body>

    <h1>Recettes</h1>
    <a href="?c=home" class="btn btn-primary">Retour à l'accueil</a>
    <div class="row">
        <!-- Boucle permettant de lister les recettes -->
        <?php foreach ($recipes as $recipe) : ?>
            <?php $existe = $favoriController->existe($recipe['id'], isset($_SESSION['id']) ?$_SESSION['id']:null); ?>
            <div class="col-4 p-2">
                <!-- Affichage du coeur rempli ou vide en fonction de si la recette est dans les favoris de l'utilisateur -->
                <?php if(isset($_SESSION['identifiant'])) {?>
                    <span class="modif" data-id="<?php echo $recipe['id'] ?>"><i class="bi bi-pencil-square"></i></span>
                    <span class="supp-recette" data-id="<?php echo $recipe['id'] ?>"><i class="bi bi-trash"></i></span>
                    <?php if($existe){ ?>
                        <span class="recipfav" data-id="<?php echo $recipe['id'] ?>"><i class="bi bi-heart-fill"></i></span>
                    <?php } else{?>
                        <span class="recipfav" data-id="<?php echo $recipe['id'] ?>"><i class="bi bi-heart"></i></span>
                    <?php }?>
                <?php } ?>
                <!-- Utilisation des Cards Bootstrap -->
                <div class="recipe card" data-id="<?php echo $recipe['id']; ?>">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $recipe['titre']; ?></h2>
                        <?php if($recipe['image'] != NULL) {$url = 'uploads/' . $recipe['image'];}
                              else {$url = "uploads/no_image.png";} ?>
                        <img src="<?php echo $url; ?>" alt="<?php echo $recipe['titre']; ?>" style="max-width: 50px; height: auto;">
                        <p class="card-text"><?php echo $recipe['description']; ?></p>
                        <a href="mailto:<?php echo $recipe['auteur']; ?>">
                            <?php echo $recipe['auteur']; ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
