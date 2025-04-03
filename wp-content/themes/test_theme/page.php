<?php get_header();

global $post;
?><div class="main"><div class="left-side"><?php
    dynamic_sidebar( 'custom-sidebar' );
?></div><div class="right-side"><?php
    ?><h1><?php the_title()?></h1><?php
    ?><section><?php the_content()?></section>
</div><?php

get_footer();

?>
