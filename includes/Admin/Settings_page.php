<?php
/**
 * Settings page functionalities.
 *
 * @package YoubouShowHooks
 * @since 1.0.0
 */

namespace YoubouShowHooks\Admin;

use YoubouShowHooks\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Settings page functionalities.
 */
class Settings_Page {

	const SETTINGS_ID = 'youbou_show_hooks_settings';

	/**
	 * Initialize class
	 */
	public function init() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
		add_action( 'admin_menu', array( $this, 'add_page' ) );
		add_action( 'init', array( $this, 'register_settings' ) );
		add_filter( 'plugin_action_links', array( $this, 'add_settings_link' ), 10, 2 );
	}

	/**
	 * Enqueue scripts and styles
	 *
	 * @param string $hook_suffix Current page.
	 */
	public function enqueue_scripts_styles( $hook_suffix ) {
		if ( 'settings_page_youbou-show-hooks' === $hook_suffix ) {
			$assets = include Utils::plugin_path() . '/build/admin-settings.asset.php';

			wp_enqueue_style(
				'youbou-show-hooks-settings',
				Utils::plugin_url() . '/build/admin-settings.css',
				array_filter(
					$assets['dependencies'],
					function ( $style ) {
						return wp_style_is( $style, 'registered' );
					}
				),
				$assets['version']
			);

			wp_enqueue_script(
				'youbou-show-hooks-settings',
				Utils::plugin_url() . '/build/admin-settings.js',
				$assets['dependencies'],
				$assets['version'],
				array(
					'in_footer' => true,
				)
			);
		}
	}

	/**
	 * Add page to admin menu
	 */
	public function add_page() {
		add_options_page(
			__( 'Youbou Show Hooks', 'youboushowhooks' ),
			__( 'Youbou Show Hooks', 'youboushowhooks' ),
			'manage_options',
			'youbou-show-hooks',
			array( $this, 'render_page' )
		);
	}

	/**
	 * Render settings page
	 */
	public function render_page() {
		printf(
			'<div class="wrap" id="youbou-show-hooks">%s</div>',
			esc_html__( 'Loading…', 'youboushowhooks' )
		);
	}

	/**
	 * Register settings
	 */
	public function register_settings() {

		$default = array(
			'pluginsStatus' => $this->plugins_status(),
			'showTheme'     => '1',
		);
		$schema  = array(
			'type'       => 'object',
			'properties' => array(
				'pluginsStatus' => array(
					'type'  => 'assoc',
					'items' => array(
						'type' => 'string',
					),
				),
				'showTheme'     => array(
					'type' => 'string',
				),
			),
		);

		register_setting(
			'options',
			self::SETTINGS_ID,
			array(
				'type'         => 'object',
				'default'      => $default,
				'show_in_rest' => array(
					'schema' => $schema,
				),
			)
		);
	}

	/**
	 * Add settings link to the plugin listing page
	 *
	 * @param array  $actions     An array of plugin action links.
	 * @param string $plugin_file Path to the plugin file relative to the plugins directory.
	 *
	 * @return array
	 */
	public function add_settings_link( $actions, $plugin_file ) {
		if ( 'youbou-show-hooks/youbou-show-hooks.php' === $plugin_file ) {
			$actions['settings'] = '<a href="options-general.php?page=youbou-show-hooks">' . __( 'Settings', 'youboushowhooks' ) . '</a>';
		}

		return $actions;
	}

	/**
	 * Get all active plugins
	 */
	private function plugins_status() {
		$plugins_slugs = array();
		$plugins       = wp_get_active_and_valid_plugins();

		foreach ( $plugins as $plugin ) {
			$basename               = plugin_basename( $plugin );
			$extension              = pathinfo( $basename, PATHINFO_EXTENSION );
			$name                   = str_replace( '.' . $extension, '', $basename );
			$plugins_slugs[ $name ] = '1';
		}

		return $plugins_slugs;
	}
}
