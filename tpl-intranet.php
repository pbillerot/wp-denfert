<?php
/*
Template Name: Intranet
 */
?>
<?php get_header('intranet');?>

<!-- Liste des MEDIA de la catégorie sélectionnée -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">
    <section class="w3-container" style="margin-top: 20px" id="showcase">
        <div class="w3-hide-large" style="margin-top: 60px"></div>
         <!-- Header -->
        <h1 class="w3-xxxlarge w3-text-theme"><b><?php the_title();?></b></h1>
        <hr style="width:50px;border:5px solid" class="w3-round w3-text-theme">
        <?php 
        if ( isset($_GET['category']) ): 
            $category = $_GET['category'];
            $query_media_args = array(
                'post_type' => 'attachment',
                // 'post_mime_type' =>'image',
                'post_status' => 'inherit',
                'posts_per_page' => 10,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => $category,
                    ),
                ),
            );
            $query_images = new WP_Query( $query_media_args );
            // dump($query_images);
            ?>
            <?php while ($query_images->have_posts()): 
                $query_images->the_post();
                $id = get_post_thumbnail_id($post->ID);
                $url = wp_get_attachment_url($id);
                $link = wp_get_attachment_link($id);
                $legend = get_the_post_thumbnail_caption( $post );
                $image = wp_get_attachment_image($id, array(96, 96));
                $alt_val = get_post_meta( $id, '_wp_attachment_image_alt');
                //dump($image);
                ?> 
                <div class="w3-left">
                <a href="<?php echo $url; ?>" target="_blank">
                    <div class="w3-card-2 w3-margin w3-center w3-hover-light-grey" style="width: 180px; height: 180px">
                    <div style="height: 96px; max-height: 96px">
                <?php if ( preg_match_all("/image\//", $post->post_mime_type) ): ?>
                        <div class="w3-bar-item w3-padding wp-block-image">
                            <?php echo $image ?>
                        </div>
                <?php elseif (strpos($post->post_mime_type, 'pdf') > 0): ?>
                        <i class="fa fa-file-pdf-o fa-fw w3-xxlarge w3-bar-item w3-text-theme w3-padding-24"></i>
                <?php else: ?>
                        <i class="fa fa-file-o fa-fw w3-xxlarge w3-bar-item w3-text-theme w3-padding-24"></i>
                <?php endif; ?>
                        </div><!-- /width height-->
                    <div class="w3-container w3-center w3-small" site="height: 48px; max-height: 48px">
                        <?php the_excerpt(); ?>
                    </div><!-- /container -->
                    </div><!-- /card -->
                </a>
                </div><!-- /left -->
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </section>
  </div><!-- w3-main -->

<?php get_footer();?>
