/**
 * Recherche des articles
 */
$(document).ready(function () {
    console.log("creationArticle.js")
    // $('#div-id').triggerevent(function(){
    //     console.log("ONCLIC-creationArticle.js")

    //     $('#div-id').html(newContent);
    // });
    
    /**
     * Initialisation
     */
     var url_donnees = '/ajax/genreParNature/recherche';
     //var $tableau = $('#tableau-resultats')
     //var $donnees = $tableau.find('tbody');

    /**
     * Initialisation
     */
    //var url_donnees = '/ajax/article/recherche';
    var $nature = $('#article_natures');
    var $genresOptions = $('#article_genresBis option');

    console.log("$categories av -->" + $genresOptions.text());
    //$genres.remove();
    console.log("$categories ap-->" + $nature.val());

    // $('#article_genresBis option').each((index, data) => {
    //    console.log(data.attributes.value.value);
    //    $(this).attr("style","display: none;");
    //    $(this).css( "background-color", "blue");
    // })
    var affichageGenresOption = function(listNatureGenre) {
        console.log("fonction")
        console.log($(this).find('#article_genresBis option'));
        $genresOptions.each(function(index,valeur){
            if(listNatureGenre.includes(valeur.value)) {
                $(this).show();
            } else {
                $(this).hide();
            }
            //$(this).css( "background-color", "red");
        })
    }

    $nature.change(function (e) {
        console.log("les temps changent...")
        $.ajax({
            url: url_donnees,
            method: 'POST',
            data:{
                Nature: $nature.val(),            }
        })
        .done(function(reponse) {
            console.log("DONE");
            if (reponse.length === 0){
                alert("Les critères sélectionnés ne corresponde à aucun genre");
            } else {
               reponseString = JSON.stringify(reponse);
               affichageGenresOption(reponseString); 
            }

            $('.recherche-article').prop('disabled', null);
        })
        .fail(function(e) {
            alert("Impossible de récupérer les données pour l'instant.");
        });
    });

    // var names = ["Mike","Matt","Nancy","Adam","Jenny","Nancy","Carl"];
    // var uniqueNatures = [];
    // $.each($natures, function(i, el){
    //     if($.inArray(el, uniqueNatures) === -1)
    //     uniqueNatures.push(el);
    //     console.log("i-->"+i);
    //     console.log("el-->"+el.innerHTML); 

    // });
    // console.log("uniqueNatures-->"+ uniqueNatures);


    // var $donnees = $tableau.find('tbody');

    // /**
    //  * Méthodes utiles
    //  */
    // // Ajout d'un article dans le tableau de résultats
    // var tableau_ajout_article = function(article) {
    //     $donnees.append(
    //         $('<tr class="item"></tr>').append(
    //             '<td>' + article.titre + '</a></td>',
    //             '<td>' + article.nature + '</a></td>',
    //             '<td>' + article.categorie + '</td>',
    //             '<td>' + article.auteurs  + '</td>',
    //             '<td>' + article.langages + '</td>',
    //             '<td>' + (article.estEmprunte ? "Oui" : "<b>NON</b>") + '</td>',
    //         )
    //     );
    // };

    // // Permet de faire un appel serveur
    // $('.recherche-article').on('click', function(event){
    //     event.preventDefault();
    //     $('.recherche-article').prop('disabled', 'disabled');
    //     $('.recherche-article').addClass('btn-loading');
    //     $.ajax({
    //         url: url_donnees,
    //         method: 'POST',
    //         data:{
    //             Titre: $('#recherche_article_titre').val(),
    //             Description: $('#recherche_article_description').val(),
    //             Categorie: $('#recherche_article_categorie').val(),
    //             //Auteurs: $('#recherche_article_auteurs').val(),
    //             EstEmprunte: $('#recherche_article_estEmprunte').val(),            }
    //     })
    //     .done(function(reponse) {
    //         console.log("DONE");
    //         $('#tableau-resultats tbody').empty();
    //         $('.page-list').show();
    //         if (reponse.donnees.length === 0){
    //             $tr=$('<tr><td colspan="7" font-size="1rem" ><b>Les critères sélectionnés ne corresponde à aucun article.</td></tr>');
    //             $('#tableau-resultats tbody').append($tr);
    //         } else {
    //             $(reponse.donnees).each(function(){
    //                 tableau_ajout_article(this);
    //             });
    //         }
    //         $('html, body').stop(true, true).animate({
    //             scrollTop: $("#tableau-resultats").offset().top
    //         }, 500);

    //         $('.recherche-article').prop('disabled', null);
    //         $('.recherche-article').removeClass('btn-loading');
    //     })
    //     .fail(function(erreur) {
    //         console.log("FAIL");
    //         if (erreur.status !== 0) {
    //             alert("Impossible de récupérer les données pour l'instant.");
    //         }
    //     });
    // });
});
