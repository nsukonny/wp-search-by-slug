<?php
/**
 * Init all plugin
 *
 * @since   1.0.0
 *
 * @package SearchBySlug
 */

namespace SearchBySlug;

defined('ABSPATH') || exit;

class Search_By_Slug
{

    use Singleton;

    /**
     * Init core of the plugin
     *
     * @since 1.0.0
     */
    public function init(): void
    {
        if (is_admin()) {
            //add_action('init_search_by_slug', array($this, 'admin_init'));
        }

        do_action('init_search_by_slug');
    }

}
