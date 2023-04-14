<?php
/**
 * Plugin Name: Search by slug
 * Plugin URI: nsukonny.agency/search-by-slug
 * Description: Just use slug:name_of_the_slug in your search query. For example: slug:about
 * Version: 1.0.0
 * Author URI:  https://nsukonny.agency
 * Author: NSukonny
 * Text Domain: search-by-slug
 * Domain Path: /languages
 *
 * @package SearchBySlug
 */

namespace SearchBySlug;

defined('ABSPATH') || exit;

define('SBS_PATH', plugin_dir_path(__FILE__));
define('SBS_URL', plugin_dir_url(__FILE__));
define('SBS_VERSION', '1.0.0');

require_once plugin_dir_path(__FILE__) . 'includes/trait-singleton.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-wp-search-by-slug.php';

add_action('admin_init', array(Search_By_Slug::class, 'instance'));
