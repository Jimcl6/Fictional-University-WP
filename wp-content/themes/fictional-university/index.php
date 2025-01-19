<?php get_header();
pageBanner([
  "title" => "Welcome to our Blog!",
  "subtitle" => "Keep up with our latest news.",
]);

?>

<div class="container container--narrow page-section">
  <?php
  while (have_posts()) {
    the_post();
    ?>
    <div class="post-item">
      <h2 class="headline headline--medium headline--post-tile"><a href="<?php the_permalink() ?>"
          style="text-decoration:none;"><?php the_title() ?></a></h2>
      <div class="metabox">
        <p>Posted by: <strong><?php the_author_posts_link(); ?></strong> on <strong><?php the_time('M j, Y'); ?></strong>
          in <strong><?php echo get_the_category_list(', '); ?></strong></p>
      </div>
      <div class="generic-content">
        <?php the_excerpt(); ?>
        <p><a href="<?php the_permalink() ?>" class="btn btn--blue">Continue Reading</a></p>
      </div>
    </div>

    <?php
  }
  echo paginate_links();
  ?>
</div>
<?php get_footer() ?>