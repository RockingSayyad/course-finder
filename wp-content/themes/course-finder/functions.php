<?php

// ENQUEUE
function enqueue_scripts() {
    wp_enqueue_script('custom-js', get_template_directory_uri().'/assets/js/app.js', ['jquery'], null, true);

    wp_localize_script('custom-js', 'ajax_object', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');


//  POST TYPES (PDF REQUIREMENT)
add_action('init', function(){

    register_post_type('course', [
        'label' => 'Courses',
        'public' => true,
        'supports' => ['title', 'editor'],
        'has_archive' => true
    ]);

    register_post_type('provider', [
        'label' => 'Providers',
        'public' => true,
        'supports' => ['title']
    ]);

    register_post_type('instructor', [
        'label' => 'Instructors',
        'public' => true,
        'supports' => ['title']
    ]);

    register_taxonomy('course_category', 'course', [
        'label' => 'Categories',
        'hierarchical' => true,
        'public' => true
    ]);

});


// AJAX
add_action('wp_ajax_filter_courses', 'filter_courses');
add_action('wp_ajax_nopriv_filter_courses', 'filter_courses');


// QUERY BUILDERS (OR logic)
function build_provider_query($providers){
    $query = ['relation' => 'OR'];

    foreach($providers as $p){
        $query[] = [
            'key' => 'providers',
            'value' => '"' . $p . '"',
            'compare' => 'LIKE'
        ];
    }

    return $query;
}

function build_location_query($locations){
    $query = ['relation' => 'OR'];

    foreach($locations as $loc){
        $query[] = [
            'key' => 'location',
            'value' => $loc,
            'compare' => 'LIKE'
        ];
    }

    return $query;
}

function build_date_query($dates){
    $query = ['relation' => 'OR'];

    foreach($dates as $d){
        $query[] = [
            'key' => 'start_date',
            'value' => $d,
            'compare' => 'LIKE'
        ];
    }

    return $query;
}


//  MAIN FILTER (AND logic top level)
function filter_courses() {

    parse_str($_POST['data'], $filters);

    $args = [
        'post_type' => 'course',
        'posts_per_page' => -1,
        'meta_query' => ['relation' => 'AND'],
        'tax_query' => ['relation' => 'AND']
    ];

    // SEARCH
    if(!empty($filters['search'])){
        $args['s'] = sanitize_text_field($filters['search']);
    }

    // PROVIDER
    if(!empty($filters['provider'])){
        $args['meta_query'][] = build_provider_query($filters['provider']);
    }

    // LOCATION
    if(!empty($filters['location'])){
        $args['meta_query'][] = build_location_query($filters['location']);
    }

    // DATE
    if(!empty($filters['date'])){
        $args['meta_query'][] = build_date_query($filters['date']);
    }

    // CATEGORY
    if(!empty($filters['category'])){
        $args['tax_query'][] = [
            'taxonomy' => 'course_category',
            'field' => 'term_id',
            'terms' => $filters['category']
        ];
    }

    $query = new WP_Query($args);

    if($query->have_posts()){
        while($query->have_posts()){
            $query->the_post();

            echo "<div class='course-card'>";
            echo "<h3>".get_the_title()."</h3>";
            echo "<p>".get_field('short_description')."</p>";
            echo "<p><b>Price:</b> ".get_field('price')."</p>";
            echo "<p><b>Location:</b> ".get_field('location')."</p>";
            echo "<p><b>Date:</b> ".get_field('start_date')."</p>";
            echo "</div>";
        }
    } else {
        echo "No courses found";
    }

    wp_die();
}