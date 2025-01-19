<?php

get_header();
pageBanner([
    "title" => "Past Events",
    "subtitle" => "A recap of our past events.",
]);

?>

<div class="container container--narrow page-section">
    <?php

    // using the same custom WP_Query format, but with meta_query compare value set to "<"
    // this is so it would not include today's date and include the current active event.
    $date_today = date('Ymd');

    $pastEvents = new WP_Query([
        'paged' => get_query_var('paged', 1),
        'post_type' => 'event',
        'orderby' => 'meta_value_num',
        'meta_key' => 'event_date',
        'order' => 'ASC',
        'meta_query' => [
            'key' => 'event_date',
            'compare' => '<',
            'value' => $date_today,
            'type' => 'numeric',
        ],
    ]);

    while ($pastEvents->have_posts()) {
        $pastEvents->the_post();

        // DateTime class:- By default, this will always return the current date and time.
        $eventDate = new DateTime(get_field('event_date'));
        ?>
        <div class="event-summary">
            <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
                <span class="event-summary__month"><?= $eventDate->format('M') ?></span>
                <span class="event-summary__day"><?= $eventDate->format('d') ?></span>
            </a>
            <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a
                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?= wp_trim_words(get_the_content(), 18); ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn
                        more</a></p>
            </div>
        </div>

        <?php

    }
    /* `echo paginate_links()` is a WordPress function that generates pagination links for a list of
    posts or custom post types. In this specific code snippet, `echo paginate_links(['total' =>
    ->max_num_pages]);` is outputting the pagination links for the list of past events
    retrieved using the custom WP_Query. */
    echo paginate_links([
        'total' => $pastEvents->max_num_pages
    ]);

    ?>
</div>
<?php
get_footer();
?>