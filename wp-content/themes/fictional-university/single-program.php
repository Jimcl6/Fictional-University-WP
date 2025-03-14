<?php get_header();

while (have_posts()) {
    the_post();
    pageBanner();
    ?>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i
                        class="fa fa-home" aria-hidden="true"></i>&nbsp;All Programs</a> <span
                    class="metabox__main"><?php the_title(); ?></span>
            </p>
        </div>

        <div class="generic-content">
            <?php the_content(); ?>
        </div>



        <?php

        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Taught by:</h2>';
        $related_professors = new WP_Query([
            'posts_per_page' => -1,
            'post_type' => 'professor',
            'orderby' => 'title',
            'order' => 'ASC',
            // this block allows us to not display past events.
            'meta_query' => [
                [
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => get_the_ID(),
                ],
            ]
        ]);

        if ($related_professors->have_posts()) {

            echo '<ul class="professor-cards">';
            while ($related_professors->have_posts()) {
                $related_professors->the_post();

                ?>
                <li class="professor-card__list-item">
                    <a class="professor-card" href="<?php the_permalink(); ?>">
                        <img src="<?php the_post_thumbnail_url('professor-landscape'); ?>" alt="<?php echo get_the_title(); ?>"
                            class="professor-card__image">
                        <span class="professor-card__name"><?php the_title() ?></span>
                    </a>
                </li>
            <?php }
            echo '</ul>';
        }

        wp_reset_postdata();

        // upcoming events code block
        $program_title = get_the_title();
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">' . "Upcoming {$program_title} Events:" . '</h2>';
        $date_today = date('Ymd');
        $homepage_events = new WP_Query([
            'posts_per_page' => 2,
            'post_type' => 'event',
            'orderby' => 'meta_value_num',
            'meta_key' => 'event_date',
            'order' => 'ASC',
            // this block allows us to not display past events.
            'meta_query' => [
                [
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $date_today,
                    'type' => 'numeric',
                ],
                [
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => get_the_ID(),
                ]
            ]
            // ----------------end of block----------------
        ]);

        if ($homepage_events->have_posts()) {
            while ($homepage_events->have_posts()) {
                $homepage_events->the_post();

                get_template_part('template-parts/content', 'event');

            }

        }
        wp_reset_postdata();
        ?>
    </div>
    <?php
}
get_footer(); ?>