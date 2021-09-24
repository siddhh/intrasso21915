/**
 * Recherche des articles
 */
 $(document).ready(function () {

    console.log("article/listing.js");
    
    /**
     * Initialisation
     */
    var url_donnees = '/ajax/article/recherche';
    var $tableau = $('#tableau-resultats')
    var $donnees = $tableau.find('tbody');

    /**
     * Méthodes utiles
     */
    // Ajout d'un article dans le tableau de résultats
    var tableau_ajout_article = function(article) {
        $donnees.append(
            $('<tr class="item"></tr>').append(

                //{{ asset('assets/img/intrasso.png') }}                
                '<td><img src="/assets/img/' + article.image + '" alt="Pochette" width="100"/>' + '</td>',
                //'<td>' + article.image + '</td>',
                '<td> <a href="/gestion/article/' + article.id + '/modifier">' + article.titre + '</a>' + '</td>',
                '<td>' + article.natures + '</a></td>',
                '<td>' + article.genres + '</td>',
                '<td>' + article.auteurs  + '</td>',
                '<td>' + article.langages + '</td>',
                '<td>' + article.proprietaire + '</td>',
                '<td>' + (article.estEmprunte ? "<b>OUI</b>" : "<b style='color: black;'>NON</b>") + '</td>',
                '<td>' + article.emprunteur + '</td>',
                '<td>' + article.dateRestitution + '</td>',
                '<td> <a href="/gestion/article/' + article.id + '/modifier" type="button" class="btn btn-warning">Emprunter</a>' + '</td>',
            )
        );
    };
    

    // Permet de faire un appel serveur
    $('.recherche-article').on('click', function(event){
        event.preventDefault();
        $('.recherche-article').prop('disabled', 'disabled');
        $('.recherche-article').addClass('btn-loading');
        $.ajax({
            url: url_donnees,
            method: 'POST',
            data:{
                Titre: $('#recherche_article_titre').val(),
                Description: $('#recherche_article_description').val(),
                Categorie: $('#recherche_article_categorie').val(),
                //Auteurs: $('#recherche_article_auteurs').val(),
                EstEmprunte: $('#recherche_article_estEmprunte').val(),            }
        })
        .done(function(reponse) {
            console.log("DONE");
            $('#tableau-resultats tbody').empty();
            $('.page-list').show();
            if (reponse.donnees.length === 0){
                $tr=$('<tr><td colspan="7" font-size="1rem" ><b>Les critères sélectionnés ne corresponde à aucun article.</td></tr>');
                $('#tableau-resultats tbody').append($tr);
            } else {
                $(reponse.donnees).each(function(){
                    tableau_ajout_article(this);
                });
            }
            $('html, body').stop(true, true).animate({
                scrollTop: $("#tableau-resultats").offset().top
            }, 500);

            $('.recherche-article').prop('disabled', null);
            $('.recherche-article').removeClass('btn-loading');
        })
        .fail(function(erreur) {
            console.log("FAIL");
            if (erreur.status !== 0) {
                alert("Impossible de récupérer les données pour l'instant.");
            }
        });
    });
});
