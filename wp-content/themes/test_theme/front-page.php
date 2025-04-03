<?php get_header();

if ( have_posts() ) : ?>
    <section>
        <?php while ( have_posts() ) : the_post(); ?>
            <a href="<?php the_permalink();?>">
                <h2><?php the_title()?></h2>
                    <?php the_post_thumbnail();?>

                    <?php the_excerpt(); ?>
                <?php endwhile; ?>
                <?php //comments_template('/comments.php',true); ?>
            </a>
    </section>
<?php endif; ?>
<?php echo do_shortcode('[filters_block]')?>
<?php get_footer(); ?>

