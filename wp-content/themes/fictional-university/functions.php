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
    add_theme_support('title-tag');
    // theme_support thumbnail must always be added to be able to use post thumbnails/featured image.
    add_theme_support('post-thumbnails');
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

