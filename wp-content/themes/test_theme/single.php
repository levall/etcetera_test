<?php get_header();

global $post; ?>

<section>

    <h1><?php the_title(); ?></h1>

    <div class="flex-row">
        <span class="category">
          <?php the_category(', '); ?>
        </span>

        <div class="author">
          By <?php the_author_meta( 'display_name', $post->post_author ); ?>
        </div>
    </div>

    <div style="text-align: center;">
      <?php if ( has_post_thumbnail() ) { ?>
          <img src="  <?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>" alt="">
      <?php } ?>
    </div>

  <?php the_content(); ?>

</section>
<?php get_footer(); ?>