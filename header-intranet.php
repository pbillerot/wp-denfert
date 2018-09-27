<!doctype html>
<html <?php language_attributes();?>>
<head>
  <meta charset="<?php bloginfo('charset');?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- description de la page pour les moteurs de recherche -->
  <?php if (is_home()): ?>
    <meta name="description" content="Page du blog">
  <?php endif;?>
  <?php if (is_front_page()): ?>
    <meta name="description" content="Page d'accueil">
  <?php endif;?>
  <?php if (is_page() && !is_front_page()): ?>
    <meta name="description" content="Page de contenu">
  <?php endif;?>
  <?php if (is_single()): ?>
    <meta name="description" content="Page d'un article">
  <?php endif;?>
  <?php if (is_category()): ?>
    <meta name="description" content="Liste des articles pour la catégorie [<?php single_cat_title('', true)?>] ">
  <?php endif;?>
  <?php if (is_tag()): ?>
    <meta name="description" content="Liste des articles avec l'étiquette [<?php single_tag_title('', true)?>]">
  <?php endif;?>

  <?php wp_head();?>

</head>
<body>
<!-- MENU -->
<nav class="w3-sidebar w3-theme w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container" style="margin-top: 32px;margin-bottom: 64px;">
    <a style="text-decoration: none;" href="/">
      <div style="font-size: 48px;" style=""><b><?php echo bloginfo("name"); ?></b></div>
      <div style="width: 100%; font-size: 18px;text-align: center"><?php echo bloginfo("description"); ?></div>
    </a>
  </div><!-- end w3-container -->
<!-- CLASSEMENT -->
<div class="w3-bar-block">
    <?php
      $categories = get_categories( array(
        'orderby' => 'name',
        'order'   => 'ASC',
        'hide_empty' => false,
        'exclude' => 'non-classe'
      ) );
    ?>
    <?php foreach ($categories as $category):
      $url = add_query_arg( 'category', $category->slug, '/intranet' );
      ?>
      <span class="w3-tag w3-round-large w3-margin-bottom w3-theme-l4">
      
      <a href="<?php echo $url;?>" style="text-decoration: none;"><?php echo $category->name;?></a></span>
    <?php endforeach;?>
      </p>
  <!-- /CLASSEMENT -->
  </div><!-- w3-bar-block -->
  </nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-theme w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-button w3-theme w3-margin-right" onclick="w3_open()">☰</a>
  <span><?php echo bloginfo("name"); ?> <?php echo bloginfo("description"); ?></span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

