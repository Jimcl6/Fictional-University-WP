<?php
get_header();
pageBanner([
    'title' => 'All Events',
    'subtitle' => 'See what is going on in our world.',
]);
?>

<div class="container container--narrow page-section">
    <?php
    $events_archive = new WP_Query([
        'post_type' => 'event',
        'orderby' => 'meta_value_num',
        'meta_key' => 'event_date',
        'order' => 'ASC',
        // this block allows us to not display past events.
        'meta_query' => [
            [
                'key' => 'event_date',
                'compare' => '>=',
                'value' => date('Ymd'),
                'type' => 'numeric',
            ]
        ]
        // ----------------end of block----------------
    ]);
    while ($events_archive->have_posts()) {
        $events_archive->the_post();

        // DateTime class:- By default, this will always return the current date and time.
        $eventDate = new DateTime(get_field('event_date'));
        ?>
        <div class="event-summary">
            <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
                <span class="event-summary__month"><?php echo $eventDate->format('M') ?></span>
                <span class="event-summary__day"><?php echo $eventDate->format('d') ?></span>
            </a>
            <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a
                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?php echo wp_trim_words(get_the_content(), 18); ?><a href="<?php the_permalink(); ?>"
                        class="nu gray">Learn
                        more</a></p>
            </div>
        </div>

        <?php

    }
    echo paginate_links();

    ?>

    <hr class="section-break">
    <p>Looking for a recap of past events? <a href="<?= site_url('/past-events') ?>">Check out our past events
            archive.</a></p>
</div>
<?php
get_footer();
?>