<?php
/*
Template Name: Foire en images
 */
?>
<?php get_header();?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">
    <section class="w3-container" style="margin-top: 20px" id="showcase">
        <div class="w3-hide-large" style="margin-top: 60px"></div>
        <!-- Menu des Foires en images -->
        <div class="w3-center">
        <div class="w3-bar">
        <?php 
            $locations = get_nav_menu_locations(); 
            $menuID = $locations['location_menu_foire_images'];
            if (! empty ($menuID)) {
                $menuNav = wp_get_nav_menu_items($menuID);
                foreach ( $menuNav as $navItem ):
                    echo '<a href="'.$navItem->url.'" title="'.$navItem->title.'" class="w3-button w3-round-xlarge w3-margin-bottom w3-margin-left w3-theme">'.$navItem->title.'</a>';
                endforeach;
            }
        ?>
        </div><!-- end w3-bar -->
        </div><!-- end w3-center -->
        <!--  Le contenuu de la page -->
        <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post();?>
            <!-- Header -->
            <h1 class="w3-xxxlarge w3-text-theme"><b><?php the_title();?></b></h1>
            <hr style="width:50px;border:5px solid red" class="w3-round">

        <?php the_content();?>

        <?php endwhile;?>
        <?php endif;?>

    </section>
  </div><!-- w3-main -->

<?php get_footer();?>
