/**
 * Script du thème 
 */

jQuery(document).ready(function($) {

    // Ajout de css sur le widget Fichier de Guttembert
    $('.wp-block-file a').each(function(index, elem) {
        //console.log(index, elem);
        $(elem).toggleClass("w3-text-theme w3-large");
        $(elem).css('text-decoration', 'none');
        if ($(elem).attr('href').indexOf('.pdf') >= 0) {
            $(elem).prepend('<i class="fa fa-file-pdf-o fa-fw w3-xxlarge w3-margin-right"></i>');
        } else {
            $(elem).prepend('<i class="fa fa-file-o fa-fw w3-xxlarge w3-margin-right"></i>');
        }
        //console.log($(elem).attr('href'));
    });
});