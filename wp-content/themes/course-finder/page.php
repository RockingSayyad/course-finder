<?php get_header(); ?>

<div class="container">

    <div class="course-wrapper">

        <!-- LEFT FILTER -->
        <div class="filters">

            <h3>Find Courses</h3>

            <form id="filterForm">

                <input type="text" name="search" placeholder="Search courses..." class="input">

                <label>Provider</label>
                <select name="provider[]" multiple class="input">
                    <?php
                    $providers = get_posts(['post_type'=>'provider','numberposts'=>-1]);
                    foreach($providers as $p){
                        echo "<option value='{$p->ID}'>{$p->post_title}</option>";
                    }
                    ?>
                </select>

                <label>Location</label>
                <select name="location[]" multiple class="input">
                    <?php
                    global $wpdb;
                    $locations = $wpdb->get_col("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key='location'");
                    foreach($locations as $loc){
                        echo "<option value='{$loc}'>{$loc}</option>";
                    }
                    ?>
                </select>

                <label>Start Date</label>
                <select name="date[]" multiple class="input">
                    <?php
                    $dates = $wpdb->get_col("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key='start_date' ORDER BY meta_value ASC");
                    foreach($dates as $d){
                        echo "<option value='{$d}'>{$d}</option>";
                    }
                    ?>
                </select>

                <label>Category</label>
                <select name="category[]" multiple class="input">
                    <?php
                    $cats = get_terms(['taxonomy'=>'course_category','hide_empty'=>false]);
                    foreach($cats as $c){
                        echo "<option value='{$c->term_id}'>{$c->name}</option>";
                    }
                    ?>
                </select>

                <button type="submit" class="btn">Filter</button>

            </form>

        </div>

        <!-- RIGHT RESULTS -->
        <div class="results">
            <h2>Available Courses</h2>
            <div id="results"></div>
        </div>

    </div>

</div>

<?php get_footer(); ?>