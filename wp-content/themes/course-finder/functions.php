<?php

function create_post_types() {

    // COURSE
    register_post_type('course', [
        'labels' => [
            'name' => 'Courses',
            'singular_name' => 'Course'
        ],
        'public' => true,
        'menu_icon' => 'dashicons-book',
        'supports' => ['title'],
    ]);

    // PROVIDER
    register_post_type('provider', [
        'labels' => [
            'name' => 'Providers',
            'singular_name' => 'Provider'
        ],
        'public' => true,
        'menu_icon' => 'dashicons-building',
        'supports' => ['title'],
    ]);

    // INSTRUCTOR
    register_post_type('instructor', [
        'labels' => [
            'name' => 'Instructors',
            'singular_name' => 'Instructor'
        ],
        'public' => true,
        'menu_icon' => 'dashicons-admin-users',
        'supports' => ['title'],
    ]);
}

add_action('init', 'create_post_types');