
<!-- SIDEBAR -->
<div class="w3-col l4">
  <!-- A LA UNE -->
  <div class="w3-card w3-margin">
    <div class="w3-container w3-center w3-theme" style="margin-top:80px">
      <h3 class="">À la Une</h3>
    </div>
<?php
$args_blog = array(
    'post_type' => 'post',
    'post__in' => get_option( 'sticky_posts')
);
$req_blog = new WP_Query($args_blog);
?>
    <ul class="w3-ul w3-hoverable w3-white">
<?php if ($req_blog->have_posts()): ?>
  <?php while ($req_blog->have_posts()): $req_blog->the_post();?>
    <?php 
      if ( is_user_logged_in()
      and is_denfert_cookie("denfert_private_checked") ):
        if ( $post->post_status == 'private'):?>
          <li class="w3-padding-16 w3-text-theme">
            <a href="<?php the_permalink();?>" style="text-decoration: none;"><span class="w3-large"><?php the_title();?></span></a>
	        </li>
        <?php endif; ?>
        <?php else: ?>
	        <li class="w3-padding-16 w3-text-theme">
            <a href="<?php the_permalink();?>" style="text-decoration: none;"><span class="w3-large"><?php the_title();?></span></a>
	        </li>
      <?php endif; ?>
	  <?php endwhile;?>
<?php endif;?>
<?php wp_reset_postdata();?>
      <li class="w3-padding-16">
      <a href="/blog" type="button" class="w3-btn w3-theme w3-small w3-right">Tous les articles...</a>
      </li>
    </ul>
  </div><!-- w3-card -->
  <!-- /A LA UNE -->
  <!-- CLASSEMENT -->
  <div class="w3-card w3-margin">
    <div class="w3-container w3-center w3-theme" style="margin-top:80px">
      <h4 class="">Classement</h4>
    </div>
    <div class="w3-container">
      <p>
    <?php
      if ( is_user_logged_in(  ) ) {
        if ( is_denfert_cookie("denfert_private_checked")) {
          $cats_tags = denfert_get_categories_tags('private'); 
        } else {
          $cats_tags = denfert_get_categories_tags('publish,private'); 
        }
      } else {
        $cats_tags = denfert_get_categories_tags('publish'); 
      }
      $cats = $cats_tags['categories'];
      $tags = $cats_tags['tags'];
      ?>
    <?php foreach ($cats as $slug => $name): ?>
      <span class="w3-tag w3-round-large w3-margin-bottom w3-theme-l4">
      <a href="/category/<?php echo $slug;?>" style="text-decoration: none;">
      <?php echo $name;?></a>
      </span>
    <?php endforeach;?>
      </p>
      <p>
    <?php foreach ($tags as $slug => $name): ?>
      <span class="w3-tag w3-round-large w3-margin-bottom w3-theme-l4">
      <a href="/tag/<?php echo $slug;?>" style="text-decoration: none;">
      <?php echo $name;?></a>
      </span>
    <?php endforeach;?>
      </p>
      <!-- Coche Privé seulement -->
      <?php if ( is_user_logged_in() ): ?>
        <p>
        <input id="denfert_private_checked_id" class="w3-check" type="checkbox" <?php echo is_denfert_cookie('denfert_private_checked') ? 'checked="checked"' : '';?>>
        <label>Articles Privés seulement</label>
        </p>
      <?php endif; ?>
    </div><!-- container -->
  <!-- /CLASSEMENT -->
  </div><!-- w3-card -->
</div><!-- w3-col -->
<!-- /SIDEBAR -->
