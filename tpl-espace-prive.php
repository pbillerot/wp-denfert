<?php
/*
Template Name: Espace Privé
 */
?>
<?php get_header('espace-prive');?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">
<section class="w3-container" style="margin-top: 20px" id="showcase">
        <div class="w3-hide-large" style="margin-top: 60px"></div>
  <!-- Grid -->
  <div class="w3-row">
    <!-- Header -->
    <h1 class="w3-xxxlarge w3-text-theme"><b><?php the_title();?></b></h1>
    <hr style="width:50px;border:5px solid" class="w3-round w3-text-theme">
    <!-- Content -->
    <div class="w3-col l8 s12">
        <!-- Blog entry -->
        <?php wp_reset_postdata();?>
        <?php
        dump(add_query_arg( array(), $wp->request ));
        $args_blog = array(
            'post_type' => 'post',
            'post_status' => 'private',
            'posts_per_page' => -1
        );
        if ( isset($_GET['category']) ) {
            $args_blog['category_name'] = $_GET['category'];
        }
        if ( isset($_GET['tag']) ) {
            $args_blog['tag'] = $_GET['tag'];
        }
        $req_blog = new WP_Query($args_blog);
        ?>
        <?php if ($req_blog->have_posts()): ?>
            <?php while ($req_blog->have_posts()): $req_blog->the_post();?>
            <?php global $post; if ($post->post_status == 'private'): ?>
                <?php get_template_part('content');?>
            <?php endif;?>
            <?php endwhile;?>
        <?php else:?>
        <p class="w3-text-red">Aucun article ne correspond à la recherche</p>
        <?php endif;?>
    </div><!-- w3-col -->
    <?php get_template_part('sidebar-espace');?>

  </div><!-- w3-row -->
</div><!-- w3-main -->

<?php get_footer();?>