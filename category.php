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
        <?php while (have_posts()): the_post();?>
          <?php 
            if ( is_user_logged_in()
            and is_denfert_cookie("denfert_private_checked") ):
              if ( $post->post_status == 'private'):
                get_template_part('content');
              endif;
            else:
              get_template_part('content');
            endif;
          ?>
        <?php endwhile;?>
      <?php endif;?>
      <?php wp_reset_postdata();?>
    </div><!-- w3-col -->

    <?php get_template_part('sidebar');?>

  </div><!-- w3-row -->
</div><!-- w3-main -->

<?php get_footer();?>
