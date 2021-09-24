$(document).ready(function() {
    
    // /**
    //  * Initialisation
    //  */
    let $body = $('body');
    var $tableau = $('#tableau-resultats-modal')
    var $donnees = $tableau.find('tbody');
    var menuGestionReferentielsVisible = false;
    var url_donnees_liste_articles_empruntes = '/ajax/gestion/article/listeArticlesEmpruntes';
    
    $('#btn-menu-gestion-referentiels').on('click', function(e) {
        e.stopPropagation();
        if (menuGestionReferentielsVisible === false) {
            menuGestionReferentielsVisible = true;
            $(this).nextUntil("#fin-menu-gestion-referentiels").removeAttr("hidden");
            $(document).one('click', function() {
                menuGestionReferentielsVisible = false;
                $('#btn-menu-gestion-referentiels').nextUntil("#fin-menu-gestion-referentiels").attr("hidden", true);
            });
        }
        else {
            menuGestionReferentielsVisible = false;
            $('#btn-menu-gestion-referentiels').nextUntil("#fin-menu-gestion-referentiels").attr("hidden", true);
        }
    });

    
    ///LISTE ARTICLES EMPRUNTES///
    
    // Ajout d'un article dans le tableau de résultats
    var tableau_ajout_article = function(article) {
        $donnees.append(
            $('<tr class="item"></tr>').append(
                '<td>' + article.natures + '</a></td>',
                '<td>' + article.titre + '</td>',
                '<td>' + article.dateRestitution + '</td>',
            )
        )
    };
    var appel_serveur_liste_articles_empruntes = function(event){
        if (event) {
            event.preventDefault();
        } 
        $.ajax({
            url: url_donnees_liste_articles_empruntes,
            method: 'GET',
        })
        .done(function(reponse) {
            console.log("DONE");
            $(reponse).each(function(){
                console.log(this);
                tableau_ajout_article(this);
            });
        })
        .fail(function(erreur) {
            if (erreur.status !== 0) {
                console.log("Impossible de fournir des éléments d'information pour l'instant.");
            }
        });
    };

    /**
     * Évènement lors d'un clic sur le bouton de la validation pour tous
     */
    $body.on('click', '.articleEmpruntes ', function(e) {
        e.preventDefault();
        appel_serveur_liste_articles_empruntes();
        var $modal = $('#detailArticleEmpruntesModal');
        $modal.modal('show');
    });
});
