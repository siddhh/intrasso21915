/**
 * Recherche des natures
 */
 $(document).ready(function () {

    console.log("nature/Listening.js");

    /**
     * Initialisation
     */
    var url_donnees = '/ajax/nature/recherche';
    var $tableau = $('#tableau-resultats')
    var $donnees = $tableau.find('tbody');

    /**
     * Méthodes utiles
     */
    // Ajout d'un nature dans le tableau de résultats
    var tableau_ajout_nature = function(nature) {
        $donnees.append(
            $('<tr class="item"></tr>').append(
                '<td> <a href="/gestion/nature/' + nature.id + '/modifier">' + nature.label + '</a>' + '</td>',
                '<td>' + nature.genres + '</a>' + '</td>',
            )
        );
    };

    // Permet de faire un appel serveur
    $('.recherche-nature').on('click', function(event){
        event.preventDefault();
        $('.recherche-nature').prop('disabled', 'disabled');
        $('.recherche-nature').addClass('btn-loading');
        console.log("soumise");
        $.ajax({
            url: url_donnees,
            method: 'POST',
            data:{
                Label: $('#recherche_nature_label').val(),
                Genres: $('#recherche_nature_genres').val(),
            }
        })
        .done(function(reponse) {
            console.log("DONE");
            $('#tableau-resultats tbody').empty();
            $('.page-list').show();
            if (reponse.donnees.length === 0){
                $tr=$('<tr><td colspan="7" font-size="1rem" ><b>Les critères sélectionnés ne corresponde à aucun nature.</td></tr>');
                $('#tableau-resultats tbody').append($tr);
            } else {
                $(reponse.donnees).each(function(){
                    tableau_ajout_nature(this);
                });
            }
            $('html, body').stop(true, true).animate({
                scrollTop: $("#tableau-resultats").offset().top
            }, 500);

            $('.recherche-nature').prop('disabled', null);
            $('.recherche-nature').removeClass('btn-loading');
        })
        .fail(function(erreur) {
            console.log("FAIL");
            if (erreur.status !== 0) {
                alert("Impossible de récupérer les données pour l'instant.");
            }
        });
    });
});
