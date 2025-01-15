# Notes for reference.

### DateTime Class: - A PHP class that by default will always return us the current date and time value.

### 'order_by'

'order_by': - this allows us order our custom post type accordingly

### 'meta_value'

'meta_value': - this allows us to access our custom fields.

### 'meta-key'

'meta_key': - this allows us to enter the name of our custom field.

### 'order'

'order': - this parameter allows us to organize our custom WP_Query accordingly to how we deem it necessary for us.

### `meta_query` parameter

This parameter allows us to customize our already predefined custom WordPress Query. Hence in this project this allowed us to customize our events post type, and hide past events from our front-page.php file.
<br>
syntax:-

```php
$date_today = date('Ymd');
$homepage_events = new WP_Query([
'posts_per_page' => -1,
'post_type' => 'event',
'orderby' => 'meta_value',
'meta_key' => 'event_date',
'order' => 'ASC',
// this block allows us to not display past events.
'meta_query' => [
    [
    'key' => 'event_date',
    'compare' => '>=',
    'value' => $date_today,
    'type' => 'numeric',
    ]
]
// ----------------end of block----------------
]);
```

### Manipulating Default URL Based Queries

```php
function university_adjust_queries($query)
{

    // this function allows us to "override" the default WordPress Query
    // and by doing so, what we've done here is manipulate the WordPress
    // query to only display archived post types from 'event' post type
    $date_today = date('Ymd');

    // this if logical operator checks if the user is on the admin panel
    // , is in the archive of post type 'event, and will check if the
    // $query is a main WordPress Query.
    if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {

        $query->set('posts_per_page', '-1');
        $query->set('order_by', 'met_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_key', 'event_date');
        $query->set('meta_query', [
            [
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $date_today,
                'type' => 'numeric',
            ]
        ]);

    }
}
// this action and hook allows us to
add_action('pre_get_posts', 'university_adjust_queries');
```

### 'paged' parameter

paged (int) – number of page. Show the posts that would normally show up just on page X when using the “Older Entries” link.

```php
// using the same custom WP_Query format, but with meta_query compare value set to "<"
    // this is so it would not include today's date and include the current active event.
    $date_today = date('Ymd');

    $pastEvents = new WP_Query([

        'paged' => get_query_var('paged', 1), //this line will set the default content of the page, now with get_query_var() as its value, this will automatically grab the pagination value and display its proper content onto the page.
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
                <p><?= wp_trim_words(get_the_content(), 18); ?><a href="<?php the_permalink(); ?>"
                        class="nu gray">Learn
                        more</a></p>
            </div>
        </div>

        <?php

    }
    echo paginate_links([
        'total' => $pastEvents->max_num_pages
    ]);


```

### 'paginate_links method & total parameter'

echo paginate_links() is a WordPress function that generates pagination links for a list of<br>
posts or custom post types. In this specific code snippet, `echo paginate_links(['total' =>->max_num_pages]);` is outputting the pagination links for the list of past events retrieved using the custom WP_Query.

```php
echo paginate_links([
        'total' => $pastEvents->max_num_pages
    ]);
```
