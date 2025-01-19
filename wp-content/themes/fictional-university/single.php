<?php get_header();

while (have_posts()) {
  the_post();
  pageBanner();
  ?>



  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a class="metabox__blog-home-link" href="<?php echo site_url('/blog') ?>"><i class="fa fa-home"
            aria-hidden="true"></i>&nbsp;Blog Home</a> <span class="metabox__main">Posted by:
          <strong><?php the_author_posts_link(); ?></strong> on <strong><?php the_time('M j, Y'); ?></strong> in
          <strong><?php echo get_the_category_list(', '); ?></strong></span>
      </p>
    </div>

    <div class="generic-content">
      <?php the_content(); ?>
    </div>


    <?php
}

get_footer();
?>