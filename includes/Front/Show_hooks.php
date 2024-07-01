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

		add_filter( 'all', array( $this, 'hook_all_hooks' ), 100, 2 );
	}

	/**
	 * Hook all hooks.
	 */
	public function hook_all_hooks( $one, $two = null ) {

		if ( wp_doing_ajax() ) {
			// error_log( 'ajax' );
			return $one;
		}

		// error_log( 'not ajax' );

		return $one;
	}
}
