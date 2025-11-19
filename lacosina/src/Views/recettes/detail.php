<h1>
    <?php echo $recipe['titre']; ?>
</h1>

<?php if($recipe['image'] != NULL) {$url = 'uploads/' . $recipe['image'];}
    else {$url = "uploads/no_image.png";} ?>
<img src="<?php echo $url; ?>" alt="<?php echo $recipe['titre']; ?>" style="max-width: 300px; height: auto;">

<p>
    <?php echo $recipe['description']; ?>
</p>

<p>
    Auteur :
    <a href="mailto:<?php echo $recipe['auteur']; ?>">
        <?php echo $recipe['auteur']; ?>
    </a>
</p>

<?php if(isset($_SESSION['identifiant'])) {?>
    <a href="?c=Recette&a=modifier&id=<?php echo $recipe['id'];?>" class="btn btn-primary">Modifier la recette</a>
    <?php if($existe){ ?>
        <a href="?c=Favori&a=supprimer&id=<?php echo $recipe['id'];?>" class="btn btn-primary">Retirer des favoris</a>
    <?php } else{?>
        <a href="?c=Favori&a=ajouter&id=<?php echo $recipe['id'];?>" class="btn btn-primary">Ajouter aux favoris</a>
    <?php }?>
<?php } ?>

<div class="btn btn-primary" id="btn-ajout-commentaire" data-id="<?php echo $recipe['id'];?>">Ajouter un commentaire</div>
<a href="?c=Recette&a=index" class="btn btn-primary">Retour à liste des recettes</a>

<h2>Commentaires</h2>
<div id="commentaires">
    <?php if (empty($commentaires)) : ?>
        <p>Aucun commentaire pour cette recette.</p>
    <?php else : ?>
        <ul>
            <?php foreach ($commentaires as $commentaire) : ?>
                <li>
                    <strong><?php echo htmlspecialchars($commentaire['pseudo']); ?></strong>
                    <em><?php echo htmlspecialchars($commentaire['create_time']); ?></em>
                    <p><?php echo nl2br(htmlspecialchars($commentaire['commentaire'])); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>