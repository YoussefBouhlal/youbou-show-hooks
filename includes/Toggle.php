<?php
/**
 * Handle Activation/Deactivation actions.
 *
 * @package YoubouShowHooks
 * @since 1.0.0
 */

namespace YoubouShowHooks;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Install class
 */
final class Toggle {

	/**
	 * Activate action.
	 */
	public function activate() {

		do_action( 'youboushowhooks_activate' );
	}

	/**
	 * Deactivate action.
	 */
	public function deactivate() {

		do_action( 'youboushowhooks_deactivate' );
	}
}
