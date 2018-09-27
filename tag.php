<?php get_header();?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">
  <!-- Grid -->
  <div class="w3-row">
    <!-- Content -->
    <div class="w3-col l8 s12">
      <div class="w3-container w3-margin-top">
        <span class="w3-xlarge">Articles classés dans</span>
        <span class="w3-tag w3-xlarge w3-round-large w3-theme"><?php single_cat_title( '', true ) ?></span>
      </div><!-- container -->
      <!-- Blog entry -->
      <?php if (have_posts()): ?>      
        <?php while (have_posts()): the_post(); ?>
          <?php //if ($post->post_status != 'private'): ?>
            <?php get_template_part('content');?>
          <?php //endif; ?>
        <?php endwhile;?>
      <?php endif;?>
      <?php wp_reset_postdata();?>
    </div><!-- w3-col -->

    <?php get_template_part('sidebar');?>

  </div><!-- w3-row -->
</div><!-- w3-main -->

<?php get_footer();?>
