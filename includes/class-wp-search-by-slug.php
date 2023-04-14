<?php
/**
 * Init all plugin
 *
 * @since   1.0.0
 *
 * @package SearchBySlug
 */

namespace SearchBySlug;

use WP_Query;

defined('ABSPATH') || exit;

class Search_By_Slug
{

    use Singleton;

    /**
     * Slug for search
     *
     * @var string $slug
     */
    private string $slug = '';

    /**
     * Init core of the plugin
     *
     * @since 1.0.0
     */
    public function init(): void
    {
        if (is_admin()) {
            add_filter('pre_get_posts', array($this, 'search_by_slug'));
            add_filter('posts_where', array($this, 'add_where_name_like'), 10, 2);
        }
    }

    /**
     * Catch the search query from wp_list_table
     *
     * @param WP_Query $query Object of query with all needed args.
     *
     * @return WP_Query
     */
    public function search_by_slug(WP_Query $query): WP_Query
    {
        if (empty($query->query_vars['s'])) {
            return $query;
        }

        $exploded_search = explode(':', $query->query_vars['s']);

        $is_slug_search = isset($exploded_search[0]) && 'slug' === strtolower($exploded_search[0]);
        if ( ! $is_slug_search) {
            return $query;
        }

        $this->slug = $exploded_search[1] ?? '';
        if (empty($this->slug)) {
            return $query;
        }

        $query->set('s', '');

        return $query;
    }

    /**
     * Add where clause to search by slug if needed.
     *
     * @param $where
     * @param $query
     *
     * @return mixed|string
     */
    public function add_where_name_like($where, $query): mixed
    {
        global $wpdb;

        if ( ! empty($this->slug)) {
            $like  = '%' . $wpdb->esc_like($this->slug) . '%';
            $where .= " AND {$wpdb->posts}.post_name LIKE '{$like}'";
        }

        return $where;
    }

}
