
<!-- Affichage des méta données de l'article -->
<?php 
$cat = get_the_category_list('</span> <span class="w3-tag w3-round-large w3-theme-l4">');
$tag = get_the_tag_list('', '</span> <span class="w3-tag w3-round-large w3-theme-l4">');
?>
<hr/>
<span class="">publié le 
<time class="entry-date" 
datetime="<?php echo esc_attr(get_the_date('c'));?>">
<?php echo esc_html(get_the_date());?>
</time></span>
<span class="w3-tag w3-round-large w3-theme-l4"><?php echo $cat; ?></span>
<span class="w3-tag w3-round-large w3-theme-l4"><?php echo $tag; ?></span>
