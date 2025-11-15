// Écoute le chargement du DOM
document.addEventListener('DOMContentLoaded', () => {

    // Sélection du profil identifiant (contenu modifiable)
    let profil_identifiant = document.getElementById('profil_identifiant');
    // Sélection du profil mail (contenu modifiable)
    let profil_mail = document.getElementById('profil_mail');
    // Sélection du bouton de modification
    let modifier_profil = document.getElementById('bouton_modifier_profil');

    let divFavoris = document.getElementById('favoris');

    // Ajoute un écouteur d’évènements pour afficher le bouton de modification lorsque l’identifiant est modifié
    profil_identifiant?.addEventListener('input', (event) => {
        modifier_profil.classList.remove('d-none'); // Affiche le bouton de modification
    });

    // Ajoute un écouteur d’évènements pour afficher le bouton de modification lorsque le mail est modifié
    profil_mail?.addEventListener('input', (event) => {
        modifier_profil.classList.remove('d-none'); // Affiche le bouton de modification
    });

    if (divFavoris !== null){
        fetch("?c=Favori&a=getFavoris&x")
        .then(response => response.json())
        .then(response => {
            JSON.stringify(response);
            divFavoris.innerHTML = "<ul>";
            divFavoris.innerHTML += response.map(favori => {
                return `<li><a href='?c=Recette&a=detail&id=${favori.id}'>${favori.titre}</a></li>`;
            }).join("");
            divFavoris.innerHTML += "</ul>";
        })
    }
});
