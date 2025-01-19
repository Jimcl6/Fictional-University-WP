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

### wp_reset_postdata()

A WordPress function that resets the global variable after a
custom WP_Query loop. This function restores the global data to the current post in
the main query, ensuring that template tags and functions related to the main query work
correctly after a custom query loop. It is important to use `wp_reset_postdata` after a
custom WP_Query loop to avoid conflicts and ensure proper functionality of subsequent
template tags and functions.

```php
wp_reset_postdata();
```

### the_post_thumbnail_url()

`add_image_size(name:, width:, height:, crop:boolean|array);`
This wordpress function displays the post URL.
syntax:- `the_post_thumbnail()`.

### Image Size(functions.php)

This registers an image size.
**_This image will only apply to future uploaded images, hence if you want this to be preset, register this function before uploading any image._**
<br>
syntax:-

`add_image_size(name:, width:, height:, crop:boolean|array);`

### Featured image sizes and Cropping

To properly crop uploaded featured images on WordPress CMS we can use the plugin Crop Thumbnails.

### print_r() function

Use this function to check the value variables with values similar to the $page_banner_image variable.

```php

$page_banner_image = get_field('page_banner_background_img');

echo $page_banner_image['url']; ?

print_r($page_banner_image)

// this provides an output.
// array( [ID] => 62 [id] => 62 [title] => field [filename] => field-scaled.jpg [filesize] => 819686 [url] => http://fictional-university.local/wp-content/uploads/2025/01/field-scaled.jpg [link] => http://fictional-university.local/professors/dr-meowsalot/field/ [alt] => [author] => 1 [description] => [caption] => [name] => field [status] => inherit [uploaded_to] => 57 [date] => 2025-01-17 08:32:17 [modified] => 2025-01-17 08:32:17 [menu_order] => 0 [mime_type] => image/jpeg [type] => image [subtype] => jpeg [icon] => http://fictional-university.local/wp-includes/images/media/default.png [width] => 2560 [height] => 1707 [sizes] => Array ( [thumbnail] => http://fictional-university.local/wp-content/uploads/2025/01/field-150x150.jpg [thumbnail-width] => 150 [thumbnail-height] => 150 [medium] => http://fictional-university.local/wp-content/uploads/2025/01/field-300x200.jpg [medium-width] => 300 [medium-height] => 200 [medium_large] => http://fictional-university.local/wp-content/uploads/2025/01/field-768x512.jpg [medium_large-width] => 768 [medium_large-height] => 512 [large] => http://fictional-university.local/wp-content/uploads/2025/01/field-1024x683.jpg [large-width] => 1024 [large-height] => 683 [1536x1536] => http://fictional-university.local/wp-content/uploads/2025/01/field-1536x1024.jpg [1536x1536-width] => 1536 [1536x1536-height] => 1024 [2048x2048] => http://fictional-university.local/wp-content/uploads/2025/01/field-2048x1365.jpg [2048x2048-width] => 2048 [2048x2048-height] => 1365 [professor-landscape] => http://fictional-university.local/wp-content/uploads/2025/01/field-400x260.jpg [professor-landscape-width] => 400 [professor-landscape-height] => 260 [professor-portrait] => http://fictional-university.local/wp-content/uploads/2025/01/field-480x650.jpg [professor-portrait-width] => 480 [professor-portrait-height] => 650 [page-banner] => http://fictional-university.local/wp-content/uploads/2025/01/field-1500x350.jpg [page-banner-width] => 1500 [page-banner-height] => 350 ) )
```

### Code block that checks for page_banner_bg_img custom field.

This block of code is checking if a custom field named 'page_banner_background_image' exists
and if the current page is not an archive or the homepage.

```php

if (get_field('page_banner_background_img') and !is_archive() and !is_home()) {
    $args['photo'] = get_field('page_banner_background_img')['sizes']['page-banner'];
} else {
    $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
}

```
