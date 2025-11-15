// Écoute le chargement du DOM
document.addEventListener('DOMContentLoaded', () => {

    // Sélectionne toutes les recettes avec la classe 'recipe'
    let recipes = document.querySelectorAll('.recipe');

    let favIcons = document.querySelectorAll(".recipfav");

    let recipmodif = document.querySelectorAll(".modif");

    favIcons.forEach(icon => {
        icon.addEventListener("mouseover", (event) => {
            icon.style.cursor = 'pointer';
        });

        icon.addEventListener('mouseout', (event) => {
            icon.style.pointer = '';
        });

         icon.addEventListener("click", (event) => {
            const id_recette = icon.dataset.id;

            if (icon.innerHTML.includes("bi-heart-fill")) {
                // Retirer des favoris
                fetch("?c=Favori&a=supprimer&id=" + id_recette)
                    .then(() => {
                        location.reload();
                    });
            } else {
                // Ajouter aux favoris
                fetch("?c=Favori&a=ajouter&id=" + id_recette)
                    .then(() => {
                        location.reload();
                    });
            }
        });
    });

    // Ajoute un écouteur d'événements sur chaque recette
    recipes.forEach(recipe => {

        recipe.addEventListener('mouseover', (event) => {
            recipe.style.backgroundColor = 'lightgray'; // Ajoute un fond gris lorsque la souris passe dessus la recette
            recipe.style.cursor = 'pointer'; // Change le curseur pour indiquer que c'est cliquable;
        });

        recipe.addEventListener('mouseout', (event) => {
            recipe.style.backgroundColor = ''; // Retire le fond gris lorsque la souris sort de la recette
            recipe.style.pointer = ''; // remet le curseur par défaut
        });

        recipe.addEventListener('click', (event) => {
            event.preventDefault(); // Empêche le comportement par défaut
            let recipeId = recipe.dataset.id; // Récupère l'ID de la recette
            window.open(`index.php?c=Recette&a=detail&id=${recipeId}`, '_self'); // Ouvre le détail dans un nouvel onglet
        });
    });

    recipmodif.forEach(icon => {
        const id_recette = icon.dataset.id;

        icon.addEventListener("mouseover", (event) => {
            icon.style.cursor = 'pointer';
        });

        icon.addEventListener('mouseout', (event) => {
            icon.style.pointer = '';
        });

         icon.addEventListener("click", (event) => {
            const id_recette = icon.dataset.id;
            window.open(`index.php?c=Recette&a=modifier&id=${id_recette}`, '_self');
        });
    });
});
