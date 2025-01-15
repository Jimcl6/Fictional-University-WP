<?php

function university_post_type()
{
    // event post type
    register_post_type('event', [
        'has_archive' => true,
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
        'rewrite' => ['slug' => 'events'],
        'public' => true,
        'show_in_rest' => true,
        'labels' => [
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'new_item' => 'New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event',
        ],
        'menu_icon' => 'dashicons-calendar',
    ]);

    // program post type
    register_post_type('program', [
        'has_archive' => true,
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
        'rewrite' => ['slug' => 'programs'],
        'public' => true,
        'show_in_rest' => true,
        'labels' => [
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'new_item' => 'New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program',
        ],
        'menu_icon' => 'dashicons-awards',
    ]);
}
add_action('init', 'university_post_type');

