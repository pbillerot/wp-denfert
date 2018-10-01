<?php
/*
http://www.geekpress.fr/wp-query-creez-des-requetes-personnalisees-dans-vos-themes-wordpress/
 */

/**
Chargement des scripts du front-end
 */
define('DENFERT_VERSION', '0.2.0');

// Chargement dans le front-end
function denfert_enqueue_scripts()
{
    // chargement des fonts
    wp_enqueue_style('denfert-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), DENFERT_VERSION, 'all');
    // chargement des styles
    wp_enqueue_style('denfert-w3', get_template_directory_uri() . '/css/w3.css', array(), DENFERT_VERSION, 'all');
    // le thème W3
    // wp_enqueue_style('denfert-w3-theme', get_template_directory_uri() . '/css/w3-theme-teal.css', array('denfert-w3'), DENFERT_VERSION, 'all');

    $options = get_option('denfert_options');
    wp_enqueue_style('denfert-w3-theme', 'https://www.w3schools.com/lib/w3-theme-'.$options['theme-w3css'].'.css', array('denfert-w3'), DENFERT_VERSION, 'all');

    // le style du site
    wp_enqueue_style('denfert-style', get_template_directory_uri() . '/style.css', array('denfert-w3-theme'), DENFERT_VERSION, 'all');

    // chargement des scripts
    wp_enqueue_script('w3-js', get_template_directory_uri() . '/js/w3.js', array('jquery'), DENFERT_VERSION, true);
    wp_enqueue_script('denfert-script', get_template_directory_uri() . '/js/denfert.js', array('jquery', 'w3-js'), DENFERT_VERSION, true);

} // fin function denfert_enqueue_scripts

add_action('wp_enqueue_scripts', 'denfert_enqueue_scripts');

/**
Chargement dans l'admin
 */
function denfert_admin_init()
{
    // *** action 1
    function denfert_admin_scripts()
    {
        // chargement des styles admin
        wp_enqueue_style('denfert-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), DENFERT_VERSION, 'all');
        // chargement des styles
        wp_enqueue_style('denfert-w3', get_template_directory_uri() . '/css/w3.css', array(), DENFERT_VERSION, 'all');

    } // fin function denfert_admin_scripts
    // add_action('admin_enqueue_scripts', 'denfert_admin_scripts');

    // *** action 2 - Setting des options
    // Enregistrement des options
    register_setting( 'denfert_options', // nom du groupe d'options utilisé par settings_fields
        'denfert_options', // nom des options
        'denfert_options_validate' ); // fonction qui validera la saisie
    // Création de la section des options
    add_settings_section('denfert_main', // identifiant unique de la section
        'Choix du thème de la feuille de style W3.CSS', // titre de la section
        'denfert_section_text', // fonction d'affichage de la section
        'options_theme'); // slug de la page fonction appelé par do_settings_sections
    // Création du champ de saisie
    add_settings_field('denfert_theme_w3css', // id du champ
        'Nom du thème W3.CSS', // son label
        'denfert_setting_theme_w3css', // sa fonction pour l'afficher
        'options_theme', // le slug de la page
        'denfert_main'); // id de la section

} // denfert_admin_init
add_action('admin_init', 'denfert_admin_init');

/**
Ajout d'un menu dans les options du thème
 */
 function denfert_admin_menus()
 {
     add_menu_page(
         'Denfert Options', // Title de la page du menu
         'Options du thème', // Titre de la page 
         'manage_options', // le menu sera placé en dessous
         'options_theme', // slug du menu
         'denfert_options_page' // function qui affichera la page
     );
 
     // Contient la fonction denfert_options_page
     include 'options-page.php';
 
 }
 add_action('admin_menu', 'denfert_admin_menus');
 
/**
Utilitaires
 */
function denfert_setup()
{

    // support des vignettes
    add_theme_support('post-thumbnails');

    // Création nouveau format image front-slider 1140x420
    //add_image_size('front-slider', 1140, 420, true);

    // enlève générateur de version
    remove_action('wp_head', 'wp_generator');

    // enlève les guillemets à la française
    // remove_filter('the_content', 'wptexturize');

    // support du titre
    add_theme_support('title-tag');

    // active la gestion des menus dans l'administration
    register_nav_menus(array(
        'location_menu_primary' => 'Location Menu Primary',
        'location_menu_foire_images' => "Location Menu Foire en images",
        'location_menu_footer_public' => "Location Menu Footer Public",
        'location_menu_footer_prive' => "Location Menu Footer Privé",
    ));

    // le rôle editor aura les possiblités de gérer le menu
    $roleObject = get_role('editor');
    if (!$roleObject->has_cap('edit_theme_options')) {
        $roleObject->add_cap('edit_theme_options');
    }

    // les abonnés pouront lire les artcles privés
    $unRole = get_role('subscriber');
    $unRole->add_cap('read_private_pages');
    $unRole->add_cap('read_private_posts');

} // fin denfert_setup

add_action('after_setup_theme', 'denfert_setup');

/**
Affichage date + catégories + étiquettes de l'article lu
 */
function denfert_get_meta_01()
{

    $chaine = 'publié le <time class="entry-date" datetime="';
    $chaine .= esc_attr(get_the_date('c')); // date format interne
    $chaine .= '">';
    $chaine .= esc_html(get_the_date()); // date format humain
    $chaine .= '</time> dans la catégorie: ';
    $chaine .= get_the_category_list(', ');
    $tags = get_the_tag_list('', ', ');
    if (strlen($tags) > 0):
        $chaine .= ' avec les étiquettes: ' . $tags;
    endif;
    return $chaine;
}

/**
Modification du texte "lire la suite"
 */
function denfert_excert_more($more)
{
    return ' <a class="more-link" href="' . get_permalink() . '"> [lire la suite]</a> ';
}
add_filter('excerpt_more', 'denfert_excert_more');

// /**
// Changement du menu footer si le user est connecté
// */
// function denfert_wp_nav_menu_args($args = '')
// {
//     if ( $args->theme_location == 'footer_menu' ) {
//         if( is_user_logged_in() ) {
//             $args['menu'] = 'footer_menu_abonne';
//         } else {
//             $args['menu'] = 'footer_menu';
//         }
//     }
//     return $args;
// }
// // événement nav_menu émis dans footer.php
// // wp_nav_menu( array( 'theme_location' => 'footer_menu', 'menu_class' => 'nav-menu' ) );
// add_filter('wp_nav_menu_args', 'denfert_wp_nav_menu_args');

/**
Dump d'une variable dans le navigateur
 */
function dump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

/**
Ajout category et post_tag aux attachments
Seront gérés ensuite par le plugin "F4 Media Taxonomies"
 */
function denfert_add_categories_to_attachments()
{
    // Création d'une nouvelle catégorie "Dossiers"
    // https://code.tutsplus.com/articles/applying-categories-tags-and-custom-taxonomies-to-media-attachments--wp-32319
    $labels = array(
        'name' => 'Dossiers',
        'singular_name' => 'Dossier',
        'search_items' => 'Rechercher dans les dossiers',
        'all_items' => 'Tous les dossiers',
        'parent_item' => 'Dossier parent',
        'parent_item_colon' => 'Dossier parent:',
        'edit_item' => 'Modifier le dossier',
        'update_item' => 'Mettre à jour le dossier',
        'add_new_item' => 'Ajouter un nouveau dossier',
        'new_item_name' => 'Nouveau nom de dossier',
        'menu_name' => 'Dossiers',
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'query_var' => 'true',
        'rewrite' => 'true',
        'show_admin_column' => 'true',
    );
    // Enregistrement des taxonomies pour les Media
    //register_taxonomy('dossier', 'attachment', $args);
    register_taxonomy_for_object_type('category', 'attachment');
    register_taxonomy_for_object_type('post_tag', 'attachment');

}
add_action('init', 'denfert_add_categories_to_attachments');

/**
Ajout de widgets
 */
// function denfert_widgets_init()
// {
//     register_sidebar(array(
//         'name' => 'Footer Widget Zone',
//         'description' => 'Widgets affichés dans le footer: 3 au maximum',
//         'id' => 'widgetized-footer',
//         'before_widget' => '<div id="%1$s" class="w3-col m4 %2$s">',
//         'after_widget' => '</div>',
//         'before_title' => '<h3">',
//         'after_title' => '</h3>',
//     ));
// }
// add_action('widgets_init', 'denfert_widgets_init');

/**
Obtention des catégories et tags des artcles publiés et privés (si connecté)
 */
function denfert_get_categories_tags($status)
{
    // dump($status);
    $args = array(
        'post_type' => 'post',
        'post_status' => $status, // ça ne marche pas
        'posts_per_page' => -1,
    );
    $req = new WP_Query($args);
    $cata = array();
    $taga = array();
    if ($req->have_posts()) {
        while ($req->have_posts()) {
            $req->the_post();
            global $post;
            if ( strpos($status, $post->post_status) !== false ):
                $cats = get_the_category();
                foreach ($cats as $cat) {
                    $cata[$cat->slug] = $cat->name;
                }
                $tags = get_the_tags();
                if ($tags) {
                    foreach ($tags as $tag) {
                        $taga[$tag->slug] = $tag->name;
                    }
                }
            endif;
        }
    }
    wp_reset_postdata();
    return array('categories' => $cata, 'tags' => $taga);
}

/**
Is cookie
*/
function is_denfert_cookie($cookie_name) {
    // dump($_COOKIE[$cookie_name]);
    if ( isset($_COOKIE[$cookie_name]) and $_COOKIE[$cookie_name] != "") {
        return true;
    } else {
        return false;
    }
}
