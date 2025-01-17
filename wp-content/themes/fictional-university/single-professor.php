<?php get_header();

while (have_posts()) {
    the_post();
    ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php $page_banner_image = get_field('page_banner_background_img');
        echo $page_banner_image['sizes']['page-banner']; ?>)">
        </div>
        <div class="page-banner__content container container--narrow">

            <h1 class="page-banner__title"><?php echo get_the_title(); ?></h1>
            <div class="page-banner__intro">
                <p><?= get_field('page_banner_subtitle'); ?></p>
            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">
        <div class="generic-content">
            <?php print_r($page_banner_image) ?>
            <div class="row-group">
                <div class="one-third">
                    <?php the_post_thumbnail('professor-portrait') ?>
                </div>
                <div class="two-thirds">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>


    <div class="container container--narrow page-section">
        <?php
        $related_program = get_field('related_programs');

        if ($related_program) {

            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Subject(s) taught:</h2>';
            echo '<ul class="link-list min-list">';
            foreach ($related_program as $program) {
                ?>
                <li><a href="<?= get_the_permalink($program) ?>"><?= get_the_title($program->ID) ?></a></li>
                <?php
            }
            echo '</ul>';
        }
        ?>
    </div>

    <?php
}
get_footer(); ?>