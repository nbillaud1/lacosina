// Écoute le chargement du DOM
document.addEventListener('DOMContentLoaded', () => {

    // Sélectionne toutes les recettes avec la classe 'recipe'
    let recipes = document.querySelectorAll('.recipe');

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
            window.open(`index.php?c=Recette&a=detail&id=${recipeId}`, '_blank'); // Ouvre le détail dans un nouvel onglet
        });
    });
});
