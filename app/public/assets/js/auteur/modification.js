/**
 * Création/modification des auteurs
 */
 $(document).ready(function () {

    console.log("modification.js");

    $('#retourArriere').click(function(e) {
        e.preventDefault();
        window.location = document.referrer;
        console.log("clic retour arriere !!!");
    })
});
