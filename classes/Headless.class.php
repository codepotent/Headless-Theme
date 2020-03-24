<?php

/**
 * -----------------------------------------------------------------------------
 * Purpose: Core headless theme primary class.
 * Copyright 2020, Code Potent, https://codepotent.com
 * -----------------------------------------------------------------------------
 */

// Declare the namespace.
namespace CodePotent\Headless;

// Prevent direct access.
if (!defined('ABSPATH')) {
	die();
}

class Headless {

	/**
	 * A simple constructor.
	 *
	 * @author John Alarcon
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		$this->init();

	}

	/**
	 * Hook the code into the system.
	 *
	 * @author John Alarcon
	 *
	 * @since 1.0.0
	 */
	private function init() {

		// Enqueue public styles.
		add_action('wp_enqueue_scripts', [$this, 'enqueue_public_assets']);

		// Enqueue admin scripts and styles.
		add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);

		// Ensure rewrite structure is correct.
		add_action('init', [$this, 'set_rewrite_structure']);

		// Remove feeds.
		add_action('do_feed', [$this, 'redirect_feed_request'], 1);
		add_action('do_feed_rdf', [$this, 'redirect_feed_request'], 1);
		add_action('do_feed_rss', [$this, 'redirect_feed_request'], 1);
		add_action('do_feed_rss2', [$this, 'redirect_feed_request'], 1);
		add_action('do_feed_atom', [$this, 'redirect_feed_request'], 1);
		add_action('do_feed_rss2_comments', [$this, 'redirect_feed_request'], 1);
		add_action('do_feed_atom_comments', [$this, 'redirect_feed_request'], 1);

		// Remove "Really Simple Discovery" tag; not needed if XML-RPC is disabled.
		remove_action('wp_head', 'rsd_link');

		// Remove "Windows Live Writer Manifest" tag.
		remove_action('wp_head', 'wlwmanifest_link');

		// Remove emoji JavaScript tags.
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('admin_print_scripts', 'print_emoji_detection_script');

		// Remove emoji CSS tags.
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_action('admin_print_styles', 'print_emoji_styles');

		// Remove emoji DNS prefetch tag.
		add_filter('emoji_svg_url' , '__return_false');

		// Remove generator tag.
		remove_action('wp_head', 'wp_generator');

		// Remove WordPress API call tag.
		remove_action('wp_head', 'rest_output_link_wp_head');

	}

	/**
	 * Enqueue admin scripts and styles.
	 *
	 * @author John Alarcon
	 *
	 * @since 1.0.0
	 */
	public function enqueue_admin_assets() {

		// Enqueue admin styles.
		wp_enqueue_style('headless-theme', WP_CONTENT_URL.'/themes/codepotent-headless/assets/styles/admin.css');

		// Enqueue admin scripts.
		wp_enqueue_script('headless-theme', WP_CONTENT_URL.'/themes/codepotent-headless/assets/scripts/admin.js', ['jquery'], time());

		// Localize a notice for use in the enqueued script.
		wp_localize_script('headless-theme', 'theme_info', sprintf(
			esc_html__('The %sHeadless%s theme has no customizer options. Instead, add any custom markup directly to the %sindex.php%s template file in the Headless theme.', 'codepotent-headless'),
			'<strong>',
			'</strong>',
			'<code>',
			'</code>'
		));

	}

	/**
	 * Enqueue public styles
	 *
	 * @author John Alarcon
	 *
	 * @since 1.0.0
	 */
	public function enqueue_public_assets() {

		// Enqueue admin styles.
		wp_enqueue_style('headless-theme', WP_CONTENT_URL.'/themes/codepotent-headless/assets/styles/public.css');

	}

	/**
	 * Set rewrite structure
	 *
	 * This function ensures that permalinks are set to the required "Post name"
	 * structure. This ensures proper 404s and redirects for the Headless theme.
	 *
	 * @author John Alarcon
	 *
	 * @since 1.0.0
	 */
	public function set_rewrite_structure() {

		// Bring the rewrite object into scope.
		global $wp_rewrite;

		// Set (or reset) the permalink structure.
		$wp_rewrite->set_permalink_structure('/%postname%/');

	}

	/**
	 * Disable feeds
	 *
	 * A headless site will typically be exposing data through the REST API, not
	 * through feeds. This method redirects feed requests to the home page.
	 *
	 * @author John Alarcon
	 *
	 * @since 1.0.0
	 */
	public function redirect_feed_request() {

		// Go home!
		header('Location: '.site_url());

		// Don't call us; we'll call you.
		exit;

	}

}

// Off with its head!
new Headless;