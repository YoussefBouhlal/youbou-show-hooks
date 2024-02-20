<?php
/**
 * Utility methods.
 *
 * @package YoubouShowHooks
 * @since 1.0.0
 */

namespace YoubouShowHooks;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Plugin util class.
 */
final class Utils {

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin, ajax, cron or frontend.
	 * @return bool
	 */
	public static function is_request( $type ) {

		switch ( $type ) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined( 'DOING_AJAX' ) && DOING_AJAX;
			case 'cron':
				return defined( 'DOING_CRON' ) && DOING_CRON;
			case 'frontend':
				return ( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) && ( ! defined( 'DOING_CRON' ) || ! DOING_CRON );
		}
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	public static function plugin_url() {
		return untrailingslashit( plugins_url( '/', PLUGIN_FILE ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public static function plugin_path() {
		return untrailingslashit( plugin_dir_path( PLUGIN_FILE ) );
	}
}
