<body>

    <h1>Liste des commentaires</h1>
    <div class="row">
        <!-- Boucle permettant de lister les commentaires -->
        <?php foreach ($commentaires as $commentaire) : ?>
            <div class="col-4 p-2">
                <span class="supprimer-commentaire" data-id="<?php echo $commentaire['id'] ?>"><i class="bi bi-trash"></i></span>
                <!-- Utilisation des Cards Bootstrap -->
                <div class="card" data-id="<?php echo $commentaire['id']; ?>">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $commentaire['pseudo']; ?></h2>
                        <p class="card-content"><?php echo $commentaire['commentaire'] ?></p>
                        <p class="card-text"><?php echo $commentaire['create_time']; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="?c=home" class="btn btn-primary">Retour à l'accueil</a>
</body>