<?php
/**
 * Main Class.
 *
 * @package YoubouShowHooks
 * @since 1.0.0
 */

namespace YoubouShowHooks;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Plugin Class.
 */
class Plugin {

	/**
	 * Singletone Instance.
	 *
	 * @var null
	 */
	protected static $instance = null;

	/**
	 * Get the static instance of this class.
	 *
	 * @return self|null
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor method.
	 */
	public function __construct() {
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( YOUBOUSHOWHOOKS_URL );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( YOUBOUSHOWHOOKS_PATH );
	}
}
