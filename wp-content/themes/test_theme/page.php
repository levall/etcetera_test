<?php get_header();

global $post;
?><div class="container">
    <div class="main">
        <div class="left-side"><?php
            dynamic_sidebar( 'custom-sidebar' );
        ?></div>
        <div class="right-side">
            <h1><?php the_title()?></h1>
            <section><?php the_content()?></section>
        </div>

    </div>
</div><?php

get_footer();


