<!-- Contenu de l'article -->
<div class="w3-container" style="margin-top:80px" id="showcase">
  <h1 class="w3-xxlarge w3-text-theme"><b><?php the_title();?></b></h1>
  <hr style="width:50px;border:5px solid" class="w3-round w3-text-theme">
  <?php the_content();?>
  <?php 
  // dump(home_url( add_query_arg( array(), $wp->request ) ));
  // dump(add_query_arg( array(), $wp->request ) );
  $page_name = add_query_arg( array(), $wp->request );
  get_template_part('meta');
  ?>
</div>
