<?php
function rc_get_categories_data()
{

    $categories_data = [];

    $taxonomy     = 'category';
    $orderby      = 'name';
    $show_count   = 0;
    $pad_counts   = 0;
    $hierarchical = 1;
    $title        = '';
    $empty        = 0;

    $args = array(
        'taxonomy'     => $taxonomy,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'hide_empty'   => $empty
    );
    $all_categories = get_categories($args);

    foreach ($all_categories as $category) {
        $categories_data[$category->name] = ['name' => $category->name, 'slug' => $category->slug];
    }

    return $categories_data;
}

// Shortcode to show post by category

function rc_postsbycategory($atts)
{
    // the query
    $the_query = new WP_Query(array(
        'post_type' => 'post',
        'category_name' => $atts['slug'],
        'posts_per_page' => 3
    ));
    $image_classes = "attachment-jannah-image-large size-jannah-image-large";

    $string = "<div class='mag-box-container clearfix'>";

    // The Loop
    if ($the_query->have_posts()) {
        $string .= '<ul class="rc-container post-items post-list-container">';
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $post_id = get_the_ID();
            if (has_post_thumbnail()) {
                $string .= '<li class="tie-standard has-post-thumbnail">';
                $string .= '<a href="' . get_the_permalink() . '" class="post-thumb">' . get_the_post_thumbnail($post_id, array('class' => $image_classes)) . '</a>';
                $string .= '<div class="post-details"><h2 class="post-title"><a href="' . get_the_permalink() . '" >' . get_the_title() . '</a></h2></div>' . '</li>';
            } else {
                // if no featured image is found
                $string .= '<li><a href="' . get_the_permalink() . '" rel="bookmark">' . get_the_title() . '</a></li>';
            }
        }
    } else {
        $string = "No se encontraron posts";
    }
    $string .= '</ul><div>';

    return $string;

    /* Restore original Post Data */
    wp_reset_postdata();
}

add_action('init', function () {
    // Add a shortcode
    add_shortcode('my_categoryposts', 'rc_postsbycategory');
}, 10);
