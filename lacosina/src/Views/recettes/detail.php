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


<a href="?c=Recette&a=index" class="btn btn-primary">Retour à liste des recettes</a>