<body>

    <h1>Recettes</h1>
    <a href="?c=home" class="btn btn-primary">Retour à l'accueil</a>
    <div class="row">
        <!-- Boucle permettant de lister les recettes -->
        <?php foreach ($recipes as $recipe) : ?>
            <div class="col-4 p-2">
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
