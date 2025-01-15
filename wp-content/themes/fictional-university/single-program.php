<?php get_header();

while (have_posts()) {
    the_post();
    ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?= get_theme_file_uri('/images/ocean.jpg') ?>)">
        </div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo get_the_title(); ?></h1>
            <div class="page-banner__intro">
                <p>Don't Forget to replace me later.</p>
            </div>
        </div>
    </div>

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

                ?>
                <div class="event-summary">
                    <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
                        <span class="event-summary__month">
                            <?php
                            $eventDate = new DateTime(get_field('event_date'));

                            echo $eventDate->format('M');

                            ?>
                        </span>
                        <span class="event-summary__day"><?= $eventDate->format('d'); ?></span>
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a
                                href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p><?= (has_excerpt()) ? get_the_excerpt() : wp_trim_words(get_the_content(), 18); ?><a
                                href="<?php the_permalink(); ?>" class="nu gray">Learn
                                more</a>
                        </p>
                    </div>
                </div>
                <?php

            }

        }
        ?>
        <?php
}
get_footer(); ?>