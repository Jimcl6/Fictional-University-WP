<?php get_header();

while (have_posts()) {
    the_post();
    pageBanner();
    ?>



    <div class="container container--narrow page-section">
        <div class="generic-content">
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