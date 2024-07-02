<?php
/**
 * Showing hooks functionalities.
 *
 * @package YoubouShowHooks
 * @since 1.0.0
 */

namespace YoubouShowHooks\Front;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Showing hooks functionalities.
 */
class Show_Hooks {

	/**
	 * Constructor.
	 */
	public function __construct() {

		if ( wp_doing_ajax() ) {
			return;
		}

		add_filter( 'all', array( $this, 'hook_all_hooks' ), 100 );
	}

	/**
	 * Hook all hooks.
	 */
	public function hook_all_hooks( $hook, $extra_data = null ) {

		if ( $hook === 'plugin_loaded' ) {
			// $plugin_slug = plugin_basename( $extra_data );
			// error_log( 'AAA: ' . $extra_data );
			// $this->plugins[] = $plugin_slug;
		}

		return $hook;
	}
}
