/**
 * Recherche des adherents
 */
 $(document).ready(function () {

    // /**
    //  * Initialisation
    //  */
    let $body = $('body');
    var url_donnees = '/ajax/adherent/recherche';
    var url_donnees_supprimer = '/ajax/adherent/supprimer/';
    var $tableau = $('#tableau-resultats')
    var $donnees = $tableau.find('tbody');
    var $donnees = $tableau.find('tbody');

    
    ///CREATION DU TABLEAU///
    /**
     * Méthodes utiles
     */
    // Ajout d'un adherent dans le tableau de résultats
    var tableau_ajout_adherent = function(adherent) {
        $donnees.append(
            $('<tr data-id=' + adherent.id + ' class="item"></tr>').append(
                '<td> <a href="/gestion/adherent/' + adherent.id + '/modifier">' + adherent.email + '</a>' + '</td>',
                '<td>' + adherent.prenom + '</a></td>',
                '<td class="nom">' + adherent.nom + '</td>',
                '<td>' + (adherent.roles == 'ROLE_USER' ? "Adhérent" : "Administrateur") + '</td>',
                '<td>' + adherent.nbrEmpruntPossible + '</td>',
                '<td>' + adherent.nbrEmpruntEnCours + '</td>',
                '<td>' + (adherent.isVerified ? "Oui" : "<b>NON</b>") + '</td>',
                '<td>' + (adherent.actif ? "Oui" : "<b>NON</b>") + '</td>',
                '<td class="dateSuppression">' + adherent.dateSuppression + '</td>',
                (adherent.isVerified == true && adherent.actif == false && adherent.dateSuppression == "-") ? '<td> <a href="/gestion/adherent/' + adherent.id+ '/valider"><button title="Valider" type="button" class="btn btn-success">V</button></a>' + '</td>': "",
                (adherent.isVerified == true && adherent.actif == true && adherent.dateSuppression == "-") ? '<td> <a href="/gestion/adherent/' + adherent.id + '/deValider"><button title="Dé-Valider" type="button" class="btn btn-warning">D</button></a>' + '</td>' : "",
                (adherent.dateSuppression == "-") ? '<td><button title="Supprimer" type="button" class="btn btn-danger btn-delete">X</button>' + '</td>' : "",
                //'<td> <a href="/gestion/adherent/' + adherent.id + '/supprimer">
            )
        );
    };

    // Fonction permettant de faire un appel serveur
    var appel_serveur = function(event){
        if (event) {
            event.preventDefault();
        } 
        $('.recherche-adherent').prop('disabled', 'disabled');
        $('.recherche-adherent').addClass('btn-loading');
        $.ajax({
            url: url_donnees,
            method: 'POST',
            data:{
                Email: $('#recherche_adherent_email').val(),
                Prenom: $('#recherche_adherent_prenom').val(),
                Nom: $('#recherche_adherent_nom').val(),
            }
        })
        .done(function(reponse) {
            $('#tableau-resultats tbody').empty();
            $('.page-list').show();
            if (reponse.donnees.length === 0){
                $tr=$('<tr><td colspan="7" font-size="1rem" ><b>Les critères sélectionnés ne corresponde à aucun adherent.</td></tr>');
                $('#tableau-resultats tbody').append($tr);
            } else {
                $(reponse.donnees).each(function(){
                    tableau_ajout_adherent(this);
                });
            }
            $('html, body').stop(true, true).animate({
                scrollTop: $("#tableau-resultats").offset().top
            }, 500);

            $('.recherche-adherent').prop('disabled', null);
            $('.recherche-adherent').removeClass('btn-loading');
        })
        .fail(function(erreur) {
            if (erreur.status !== 0) {
                alert("Impossible de récupérer les données pour l'instant.");
            }
        });
    };

    /**
     * Récupération des informations
     */
     appel_serveur();

    $('.recherche-adherent').on('click', appel_serveur());


    ///SUPPRESSION///    
    // Fonction permettant une suppression d'adhérent faire un appel serveur
    var appel_serveur_suppression = function(adherentId, $adherentLigne){    
        $.ajax({
            url: url_donnees_supprimer + adherentId,
            method: 'PUT',
        })
        .done(function(reponse) {
            console.log(reponse['statut']);
            $adherentLigne.find('.btn').prop( 'style', "display: none;");
            $adherentLigne.find('.dateSuppression').text(reponse['statut']);
            

        })
        .fail(function(erreur) {
            if (erreur.status !== 0) {
                console.log("Impossible de supprimer cet adhérent pour l'instant.");
            }
        });
    };

    /**
     * Évènement lors d'un clic sur le bouton de suppression d'une entrée
     */

     $donnees.on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var $adherentLigne = $(this).parents('tr');
        var $modal = $('#confirmationSuppressionModal');
        var valeur = $donnees.find('tr').index($adherentLigne);
        $modal.attr('data-row', valeur);        
        $modal.modal('show');
     });

     $('#confirmationSuppressionModal').on('click', '.btn.btn-primary', function(e) {
        e.preventDefault();
        var $modal = $(this).parents('.modal');
        var rowId = $modal.attr('data-row');
        var $adherentLigne = $($donnees.find('tr').get(rowId));
        var adherentId = $adherentLigne.attr('data-id');
        
        $adherentLigne.find('input, select, button').prop('disabled');
        appel_serveur_suppression(adherentId, $adherentLigne);
        $adherentLigne.find('input, select, button').prop('disabled', null);
        console.log("3-->"+$adherentLigne.html())
     });
     
     //VALIDER TOUS///    
    // Fonction permettant de valider tous les adhérents en attente
    var appel_serveur_validation_tous = function(adherentId, $adherentLigne){    
        $.ajax({
            url: url_donnees_valider_tous,
            method: 'PUT',
        })
        .done(function(reponse) {
            console.log(reponse['statut']);
            $adherentLigne.find('.btn').prop( 'style', "display: none;");
            $adherentLigne.find('.dateSuppression').text(reponse['statut']);
        })
        .fail(function(erreur) {
            if (erreur.status !== 0) {
                console.log("Impossible de supprimer cet adhérent pour l'instant.");
            }
        });
    };

    /**
     * Évènement lors d'un clic sur le bouton de la validation pour tous
     */
    $body.on('click', '.activerTous ', function(e) {
        e.preventDefault();
        var $modal = $('#confirmationActiverTousModal');
        $modal.modal('show');
    });

    $('#confirmationActiverTousModal').on('click', '.btn.btn-primary', function(e) {
        e.preventDefault();
        var url = "/gestion/adherent/validerTous";
        $(location).attr('href',url);
        //window.location('/gestion/adherent/validerTous');
    });
});
