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

    // Bouton Edition d'un post
    $('.denfert_edit_post').each(function(index, elem) {
        //console.log(index, elem);
        $(elem).toggleClass("");
        // $(elem).css('text-decoration', 'none');
        $(elem).html('<i class="fa fa-edit fa-fw w3-text-theme w3-large"></i>');
    });

    $('#denfert_private_checked_id').each(function(index, elem) {
        if (isCookie('denfert_private_checked')) {
            $(elem).attr('checked', 'checked');
        } else {
            $(elem).removeAttr('checked');
        }
    });
    $('#denfert_private_checked_id').click(function() {
        if (isCookie('denfert_private_checked')) {
            $(this).removeAttr('checked');
            removeCookie('denfert_private_checked');
        } else {
            $(this).attr('checked', 'checked');
            setCookie('denfert_private_checked', 'checked');
        }
        location.reload();
    });
});

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function removeCookie(cname) {
    document.cookie = cname + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/';
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function isCookie(cname) {
    var cookie = getCookie(cname);
    if (cookie != "") {
        return true;
    } else {
        return false;
    }
}