/**
 * Recherche de l'historique
 */
 $(document).ready(function () {


    /**
     * Initialisation
     */
    var url_donnees = '/ajax/genre/recherche';
    var $tableau = $('#tableau-resultats')
    var $donnees = $tableau.find('tbody');

    /**
     * Méthodes utiles
     */
    // Ajout d'un genre dans le tableau de résultats
    var tableau_ajout_genre = function(genre) {
        $donnees.append(
            $('<tr class="item"></tr>').append(
                '<td> <a href="/gestion/genre/' + genre.id + '/modifier">' + genre.label + '</a>' + '</td>',
                '<td>' + genre.natures + '</a>' + '</td>',
            )
        );
    };

    // Permet de faire un appel serveur
    $('.recherche-genre').on('click', function(event){
        event.preventDefault();
        $('.recherche-genre').prop('disabled', 'disabled');
        $('.recherche-genre').addClass('btn-loading');
        console.log("soumise");
        $.ajax({
            url: url_donnees,
            method: 'POST',
            data:{
                Prenom: $('#recherche_genre_prenom').val(),
                Nom: $('#recherche_genre_nom').val(),
            }
        })
        .done(function(reponse) {
            console.log("DONE");
            $('#tableau-resultats tbody').empty();
            $('.page-list').show();
            if (reponse.donnees.length === 0){
                $tr=$('<tr><td colspan="7" font-size="1rem" ><b>Les critères sélectionnés ne corresponde à aucun genre.</td></tr>');
                $('#tableau-resultats tbody').append($tr);
            } else {
                $(reponse.donnees).each(function(){
                    tableau_ajout_genre(this);
                });
            }
            $('html, body').stop(true, true).animate({
                scrollTop: $("#tableau-resultats").offset().top
            }, 500);

            $('.recherche-genre').prop('disabled', null);
            $('.recherche-genre').removeClass('btn-loading');
        })
        .fail(function(erreur) {
            console.log("FAIL");
            if (erreur.status !== 0) {
                alert("Impossible de récupérer les données pour l'instant.");
            }
        });
    });
});
