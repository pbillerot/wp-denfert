<?php get_header();?>

<!-- !PAGE CONTENT! -->
<section class="w3-main" style="margin-left:340px;margin-right:40px">
 <!-- Grid -->
 <div class="w3-row">
    <!-- Content -->
    <div class="w3-col l8 s12">
    <?php if (have_posts()): ?>
      <?php while (have_posts()): the_post();?>
      <!-- Header -->
      <div class="w3-container" style="margin-top:80px" id="showcase">
        <h1 class="w3-xxxlarge w3-text-theme"><b><?php the_title();?></b></h1>
        <hr style="width:50px;border:5px solid" class="w3-round w3-text-theme">

        <?php the_content();?>

      </div><!-- /container -->
    <?php endwhile;?>
    <?php endif;?>
    </div><!-- end w3-col -->

    <?php get_template_part('sidebar');?>
  </div><!-- /row -->
  </section><!-- w3-main -->

<?php get_footer();?>
