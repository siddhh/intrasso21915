/**
 * Recherche des auteurs
 */
 $(document).ready(function () {
    
    /**
     * Initialisation de variables
     */
    var url_donnees = '/ajax/auteur/recherche';
    var url_donnees_suppression_auteurs = '/ajax/auteur/suppression';
    
    var $tableau = $('#tableau-resultats');
    var $donnees = $tableau.find('tbody');
    var $rechercheAuteur = $('.recherche-auteur')
    let $boutonSupprimer = $('.supprimer');
    let $body = $('body');
    let $checkboxesContainer = $('.checkall-container');
    let $checkall = $('.checkall');

    if ($checkall.is(':checked')) {
        $checkboxesContainer.find('.checkall').prop('checked', null);
        
    }

    // Purge des pilotes dans le tableau de résultats
    var tableau_purge = function() {
        $donnees.find('tr').remove();
    };

    // /**
    //  * Gestion des "Tout sélectionner" par conteneur
    //  * .checkall-container          => Conteneur d'où l'événement "CheckboxesChange" est lancé, à capturer dans le script
    //  *      .checkall               => Case "Tout"
    //  *
    //  *      .checkall-box-handle    => (Facultatif) Au clic sur cet élément, on coche / décoche la case enfant (pratique pour cocher une case associée à une ligne entière)
    //  *          .checkall-box       => Case "Item unique"
    //  *
    //  *      .checkall-box-handle
    //  *          .checkall-box
    //  *
    //  *      .checkall-box-handle
    //  *          .checkall-box
    //  *
    //  *      (...)
    //  */
    // // On décoche tout en arrivant sur la page et on initialise les containers
    // $('.checkall, .checkall-box').prop('checked', '');
    // $('.checkall-container').data('checkedBoxes', $([]));
    // // Lors d'un changement de valeur au niveau de la case "Tout selectionner"
    // $('.checkall').change(function(e) {
    //     e.preventDefault();
    //     // On initialise quelques variables
    //     let $this = $(this);
    //     let $checkboxesContainer = $this.parents('.checkall-container');
    //     let $checkboxes = $checkboxesContainer.find('.checkall-box');
    //     let $checkboxesHandler = $checkboxesContainer.find('.checkall-box-handle');

    //     // Si on est coché, alors on coche toutes les cases à cocher
    //     if ($this.is(':checked')) {
    //         $checkboxes.prop('checked', 'checked');
    //         $checkboxesHandler.addClass('checkall-box-checked');
    //     // Sinon, on décoche toutes les cases à cocher
    //     } else {
    //         $checkboxes.prop('checked', null);
    //         $checkboxesHandler.removeClass('checkall-box-checked');
    //     }

    //     // On récupère toutes les cases cochées du container
    //     let $checkboxesChecked = $checkboxesContainer.find('.checkall-box:checked');

    //     // On émet un événement depuis le container afin de pouvoir le capturer par la suite, on lui passe également
    //     // le nombre de case cochées ainsi que les cases cochées.
    //     $checkboxesContainer.trigger('CheckboxesChange', [
    //         $checkboxesChecked.length,
    //         $checkboxesChecked
    //     ]);
    //     $checkboxesContainer.data('checkedBoxes', $checkboxesChecked);
    // });
    // // Lors d'un changement de valuer au niveau d'une case ".checkall-box"
    // $body.on('change', '.checkall-box', function (e) {
    //     e.preventDefault();
    //     // On initialise quelques variables
    //     let $this = $(this);
    //     let $checkboxeHandler = $this.parents('.checkall-box-handle');
    //     let $checkboxesContainer = $this.parents('.checkall-container');
    //     let $checkboxes = $checkboxesContainer.find('.checkall-box');
    //     let $checkboxesChecked = $checkboxesContainer.find('.checkall-box:checked');
    //     let $checkAll = $checkboxesContainer.find('.checkall');

    //     // On ajoute / retire la classe "checkall-box-checked" du handler
    //     $checkboxeHandler.toggleClass('checkall-box-checked', $this.is(':checked'));

    //     // Si le nombre total de case à coché du container est égal au nombre déjà coché, alors on coche "Tout sélectionner"
    //     if ($checkboxes.length === $checkboxesChecked.length) {
    //         $checkAll.prop('checked', 'checked');
    //     // Sinon, on le décoche
    //     } else {
    //         $checkAll.prop('checked', null);
    //     }

    //     // On émet un événement depuis le container afin de pouvoir le capturer par la suite, on lui passe également
    //     // le nombre de case cochées ainsi que les cases cochées.
    //     $checkboxesContainer.trigger('CheckboxesChange', [
    //         $checkboxesChecked.length,
    //         $checkboxesChecked
    //     ]);
    //     $checkboxesContainer.data('checkedBoxes', $checkboxesChecked);
    // });
    // Lors d'un clic sur un élément ".checkall-box-handle"
    $body.on('click', '.checkall-box-handle', function(e) {
        let $ckb = $(this).find('.checkall-box');
        console.log("checkall-box-handle1");
        if (e.target !== $ckb.get(0)) {
            e.preventDefault();
            e.stopPropagation();
            console.log("checkall-box-handle2");
            $ckb.prop('checked', $ckb.is(':checked') ? '' : 'checked');
            $ckb.trigger('change');
        }
    });

    /////////////   
    //RECHERCHE//
    /////////////

    // Ajout d'un auteur dans le tableau de résultats
    var tableau_ajout_auteur = function(auteur) {
        $donnees.append(
            $('<tr class="checkall-box-handle checkall-box-checked"></tr>').append(
                '<td> <a href="/gestion/auteur/' + auteur.id + '/modifier">' + auteur.nom + '</a>' + '</td>',
                '<td>' + auteur.prenom + '</td>',
                '<td>' + auteur.dateSuppression + '</td>',
                auteur.dateSuppression == "-" ? '<td><input name="auteur[]" type="checkbox" class="checkall-box" value="'+auteur.id+'" /></td>':""
            )
        );
    };

    // Permet de faire un appel serveur
    var appel_serveur_recherche_auteurs = function(vueChoisie) {
        tableau_purge();
        $.ajax({
            url: url_donnees,
            method: 'POST',
            data:{
               VueChoisie: vueChoisie,
            }
        })
        .done(function(reponse) {
            console.log("DONE-->"+reponse.length);
            //$('#tableau-resultats tbody').empty();
            //$('.page-list').show();
            
            if (reponse.length === 0){
                $checkall.hide();
                $tr=$('<tr><td colspan="7" font-size="1rem" ><b>Les critères sélectionnés ne corresponde à aucun auteur.</td></tr>');
                $('#tableau-resultats tbody').append($tr);
            } else {
                if (vueChoisie != "2"){
                    $checkall.show();
                } else {
                    $checkall.hide();
                } 
                $(reponse).each(function(){
                    tableau_ajout_auteur(this);
                });
                //$('.supprimer').prop('style', 'display: block;');
            }
        })
        .fail(function(erreur) {
            $checkall.hide()
            console.log("FAIL",erreur.status);
            if (erreur.status !== 0) {
                alert("Impossible de récupérer les données pour l'instant.");
            }
        });
    }
    $('#recherche_auteur_vuePredefinie').change(function(event){ 
        console.log("CHANGE");
        vueChoisieId = $('#recherche_auteur_vuePredefinie').val();
        if ((vueChoisieId == "1") || (vueChoisieId == "2") || (vueChoisieId == "3")) { 
            appel_serveur_recherche_auteurs(vueChoisieId);
        } else {
            tableau_purge();
        }
    });

    //recherche les auteurs au démanrrage de la page.
    //appel_serveur_recherche_auteurs();
   
    //////////////
    //SUPRESSION//
    //////////////

    //appel serveur
    var appel_serveur_suppression_auteurs = function(auteurIds) {
        $.ajax({
            url: url_donnees_suppression_auteurs,
            method: 'POST',
            data:{
                ListeAuteurSupprime: auteurIds,
            }
        })
        .done(function(reponse) {
            console.log("DONE-->"+auteurIds);
            $checkboxesContainer.data('checkedBoxes').each(function(){
                idChecked = $(this).val();
                console.log("idChecked-->"+idChecked);
                $donnees.find('tr td input[value="' + idChecked + '"]').parents('tr').hide();
            });
            //location.reload();    
        })
        .fail(function(erreur) {
            console.log("FAIL");
            if (erreur.status !== 0) {
                alert("Impossible de récupérer les données pour l'instant.");
            }
        });
    }

    //GESTION DES COCHES
    //Gestion de la coche pour tous sélectionner
    $('.checkall').change(function(e) {
        e.preventDefault();
        // On initialise quelques variables
        let $this = $(this);
        let $checkboxesContainer = $this.parents('.checkall-container');
        let $checkboxes = $checkboxesContainer.find('.checkall-box');
        let $checkboxesHandler = $checkboxesContainer.find('.checkall-box-handle');
        

        // Si la coche "Tous" est cochée, alors on coche toutes les cases à cocher
        if ($this.is(':checked')) {
            $checkboxes.prop('checked', 'checked');
            //console.log("$this1->"+$this);
            $checkboxesHandler.addClass('checkall-box-checked');
        // Sinon, on décoche toutes les cases à cocher
        } else {
            $checkboxes.prop('checked', null);
            //console.log("$this1->"+$this.html());
            $checkboxesHandler.removeClass('checkall-box-checked');
        }

        // On récupère toutes les cases cochées du container
        let $checkboxesChecked = $checkboxesContainer.find('.checkall-box:checked');
        // // On émet un événement depuis le container afin de pouvoir le capturer par la suite, on lui passe également
        // le nombre de case cochées ainsi que les cases cochées.
        $checkboxesContainer.trigger('CheckboxesChange', [
            $checkboxesChecked.length,
            $checkboxesChecked
        ]);
        $checkboxesContainer.data('checkedBoxes', $checkboxesChecked);
    });

    // Lors d'un changement de valeur au niveau d'une case ".checkall-box"
    $body.on('change', '.checkall-box', function (e) {
        e.preventDefault();
        // On initialise quelques variables
        let $this = $(this);
        let $checkboxeHandler = $this.parents('.checkall-box-handle');
        let $checkboxesContainer = $this.parents('.checkall-container');
        let $checkboxes = $checkboxesContainer.find('.checkall-box');
        let $checkboxesChecked = $checkboxesContainer.find('.checkall-box:checked');
        let $checkAll = $checkboxesContainer.find('.checkall');

        // On ajoute / retire la classe "checkall-box-checked" du handler
        $checkboxeHandler.toggleClass('checkall-box-checked', $this.is(':checked'));

        // Si le nombre total de case à coché du container est égal au nombre déjà coché, alors on coche "Tout sélectionner"
        if ($checkboxes.length === $checkboxesChecked.length) {
            $checkAll.prop('checked', 'checked');
        // Sinon, on le décoche
        } else {
            $checkAll.prop('checked', null);
        }

        // On émet un événement depuis le container afin de pouvoir le capturer par la suite, on lui passe également
        // le nombre de case cochées ainsi que les cases cochées.
        $checkboxesContainer.trigger('CheckboxesChange', [
            $checkboxesChecked.length,
            $checkboxesChecked
        ]);
        $checkboxesContainer.data('checkedBoxes', $checkboxesChecked);
        if ($checkboxesChecked.length > 0) {
            $boutonSupprimer.attr('style',"display:block;")

        } else {
            $boutonSupprimer.attr('style',"display:none;")
        }
    });

    /**
    * Gestion du bouton Supprimer
    */
    $boutonSupprimer.on('click', function(e) {
        e.preventDefault();
        var $modal = $('#confirmationSuppressionModal');
        $modal.modal('show');
        let auteurIds = [];

        $checkboxesContainer.data('checkedBoxes').each(function(){
            auteurIds.push($(this).val());
        });
    });
        
    $('#confirmationSuppressionModal').on('click', '.btn.btn-primary', function(e) {
        e.preventDefault();
        let auteurIds = [];
        $checkboxesContainer.data('checkedBoxes').each(function(){
            //console.log($(this));
            auteurIds.push($(this).val());
        });
        appel_serveur_suppression_auteurs(auteurIds);
        
    });
});
