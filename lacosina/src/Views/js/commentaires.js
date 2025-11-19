// Écoute le chargement du DOM
document.addEventListener('DOMContentLoaded', () => {

    let btnAjoutCommentaire = document.getElementById('btn-ajout-commentaire');
    let divCommentaire = document.getElementById('commentaires');
    let suppIcons = document.querySelectorAll('.supprimer-commentaire');

    // Ajout de l'événement click sur chaque icône de suppression
    suppIcons.forEach(icon => {
        icon.addEventListener("mouseover", (event) => {
            icon.style.cursor = 'pointer';
        });

        icon.addEventListener('mouseout', (event) => {
            icon.style.pointer = '';
        });

         icon.addEventListener("click", (event) => {
            const id = icon.dataset.id;

            // Retirer le commentaire
            window.open(`index.php?c=Commentaire&a=supprimer&id=${id}`, '_self');
        });
    });
        
    btnAjoutCommentaire.addEventListener('click', () => {
        // Créer un élément <form>
        let formComment = document.createElement('form');
        formComment.method = 'post';
        formComment.action = '?c=Commentaire&a=ajouter&id=' + btnAjoutCommentaire.dataset.id; // Action du formulaire

        // Créer un textarea
        let textarea = document.createElement('textarea');
        textarea.name = 'commentaire';
        textarea.placeholder = 'Saisir le commentaire';
        textarea.rows = '4';
        textarea.classList.add('form-control');
        textarea.required = true; // Ajoute un attribut required pour vérifier la saisie

        // Crée un bouton submit
        let submitButton = document.createElement('button');
        submitButton.type = 'submit'; // Type de bouton
        submitButton.textContent = 'Valider le commentaire'; // Texte du bouton
        submitButton.classList.add('btn', 'btn-primary'); // Ajoute une classe au bouton

        // Ajoute un div de class mb-3
        let divMessage = document.createElement('div');
        divMessage.classList.add('mb-3');

        divMessage.appendChild(textarea);
        divMessage.appendChild(submitButton);

        // Ajoute les éléments dans le formulaire
        formComment.appendChild(divMessage);

        divCommentaire.prepend(formComment); // Ajoute le formulaire au div commentairer
        btnAjoutCommentaire.classList.add('d-none'); // Affiche le div commentaire

        submitButton.addEventListener('click', (event) => {
            fetch("?c=Recette&a=detail&id=" + btnAjoutCommentaire.dataset.id)
                    .then(() => {
                        location.reload();
                    });
        });
    });
});