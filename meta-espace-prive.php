
<!-- Affichage des méta données de l'article -->
<hr/>
<span class="">publié le 
<time class="entry-date" 
datetime="<?php echo esc_attr(get_the_date('c'));?>">
<?php echo esc_html(get_the_date());?>
</time></span>
<?php $cats = get_the_category();
foreach ( $cats as $cat ): ?>
    <span class="w3-tag w3-round-large w3-theme-l4">
    <a href="/espace-prive?category=<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></a>
    </span>
<?php endforeach; ?>
<?php $tags = get_the_tags();
if ( $tags):
foreach ( $tags as $tag ): ?>
    <span class="w3-tag w3-round-large w3-theme-l4">
    <a href="/espace-prive?tag=<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a>
    </span>
<?php 
endforeach; 
endif;?>
