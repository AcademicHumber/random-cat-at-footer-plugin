<?php

/**
 * 
 * @link              https://www.linkedin.com/in/adrian-fernandez-1701/
 * @since             1.0.0
 * @package           Related Categories
 *
 * @wordpress-plugin
 * Plugin Name:       Related Category
 * Plugin URI:        https://github.com/AcademicHumber/order-reminder-plugin
 * Description:       Show related category posts at the end of category page.
 * Version:           1.0.0
 * Author:            Adrian Fernandez
 * Author URI:        https://www.linkedin.com/in/adrian-fernandez-1701/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       related-cat
 */

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/includes/admin/settings.php';

/**
 * Enqueue the styles
 */

function rc_load_stylesheets()
{

    wp_register_style('custom_rc_stylesheet', plugins_url('includes/css/styles.css', __FILE__), '', 1, 'all');
    wp_enqueue_style('custom_rc_stylesheet');
}
add_action('wp_enqueue_scripts', 'rc_load_stylesheets');


/*add_action('init', function () {

    $categories_data = rc_get_categories_data();
    $random_category = $categories_data[array_rand($categories_data)];
    $random_slug = $random_category['slug'];
    echo do_shortcode("[my_categoryposts slug='$random_slug']");
}, 12);*/
