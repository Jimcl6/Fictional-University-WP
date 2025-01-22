<?php

function university_files()
{
    wp_enqueue_style('univerity_fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('university_bootstrap', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_files', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_main_style', get_theme_file_uri('/build/index.css'));

    // scripts
    wp_enqueue_script('university_script', get_theme_file_uri('/build/index.js'), ['jquery'], '1.0', true);
}
add_action('wp_enqueue_scripts', 'university_files');


function university_features()
{
    // this feature allows us to get WordPress to use their title tag for our header.php, rather than hard-coding it.
    add_theme_support('title-tag');


    // theme_support thumbnail must always be added to be able to use post thumbnails/featured image.
    add_theme_support('post-thumbnails');

    // this functions will not initiate instantly, it would rather apply the sizes in future uploaded images.
    add_image_size('professor-landscape', 400, 260, true);
    add_image_size('professor-portrait', 480, 650, true);
    add_image_size('page-banner', 1500, 350, true);
}
add_action('after_setup_theme', 'university_features');


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

    // programs
    if (!is_admin() and is_post_type_archive('program') and $query->is_main_query()) {
        $query->set('posts_per_page', '-1');
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
    }
}
// this action and hook allows us to 
add_action('pre_get_posts', 'university_adjust_queries');

// ------------------------------Content Section------------------------------

// pageBanner function
function pageBanner($args = null)
{
    if (!isset($args["title"])) {
        $args['title'] = get_the_title();
    }

    if (!isset($args['subtitle'])) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if (!isset($args['photo'])) {
        /* This block of code is checking if a custom field named 'page_banner_background_image' exists
        and if the current page is not an archive or the homepage. */
        if (get_field('page_banner_background_img') and !is_archive() and !is_home()) {
            $args['photo'] = get_field('page_banner_background_img')['sizes']['page-banner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }
    ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?= $args['photo']; ?>)">
        </div>
        <div class="page-banner__content container container--narrow">

            <h1 class="page-banner__title"><?= $args['title']; ?></h1>
            <div class="page-banner__intro">
                <p><?= $args['subtitle'] ?></p>
            </div>
        </div>
    </div>
    <?php
}