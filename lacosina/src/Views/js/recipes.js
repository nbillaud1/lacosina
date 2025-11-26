function actionsRecipe(){
    // Sélectionne toutes les recettes avec la classe 'recipe'
    let recipes = document.querySelectorAll('.recipe');

    let favIcons = document.querySelectorAll(".recipfav");

    let recipmodif = document.querySelectorAll(".modif");

    let suppRecetteIcons = document.querySelectorAll(".supp-recette");

    suppRecetteIcons.forEach(icon => {
        const id_recette = icon.dataset.id;

        icon.addEventListener("mouseover", (event) => {
            icon.style.cursor = 'pointer';
        });

        icon.addEventListener('mouseout', (event) => {
            icon.style.pointer = '';
        });

         icon.addEventListener("click", (event) => {
            const id_recette = icon.dataset.id;
            window.open(`index.php?c=Recette&a=supprimer&id=${id_recette}`, '_self');
        });
    });

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
            window.open(`index.php?c=Recette&a=detail&id=${recipeId}`, '_self'); // Ouvre le détail 
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
}

// Écoute le chargement du DOM
document.addEventListener('DOMContentLoaded', () => {
    actionsRecipe();

    let btnsFiltre = document.querySelectorAll(".btnFiltre");
    
    let filtreTous = document.getElementById("filtreTous");
    filtreTous.classList.add('bg-primary-subtle');

    btnsFiltre.forEach(btnFiltre => {
        btnFiltre.addEventListener('mouseover', (event) => {
            btnFiltre.style.cursor = 'pointer';
            btnFiltre.style.backgroundColor = 'lightgray';
        });

        btnFiltre.addEventListener('mouseout', (event) => {
            btnFiltre.style.pointer = '';
            btnFiltre.style.backgroundColor = '';
        });

        btnFiltre.addEventListener('click', (event) => {
            btnsFiltre.forEach(o => o.classList.remove('bg-primary-subtle'))
            btnFiltre.classList.add('bg-primary-subtle');
            let filterValue = btnFiltre.dataset.filtre;
            // Mettre à jour la liste des recettes avec le filtre par fetch qui renvoie une réponse en html
            fetch('?c=Recette&a=index&filtre=' + filterValue)
                .then(response => response.text()) // Récupère le texte de la réponse
                .then(html => {

                    // Parse le HTML pour créer un document DOM
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(html, 'text/html');

                    // Sélectionner le div avec une classe ou un ID spécifique
                    let divContent = doc.querySelector('#listeRecettes'); // Par exemple, un div avec l'ID "listeRecettes"

                    // Change le contenu de la div listeRecettes avec le HTML récupéré filtré sur l'id listeRecettes
                    document.getElementById('listeRecettes').innerHTML =
                        divContent.innerHTML; // Affiche le HTML dans la div recipes
                    actionsRecipe();
                });
        });
    });
});
