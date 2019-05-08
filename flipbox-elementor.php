<?php
/**
 * Plugin Name: Flip Box Click
 * Description: This is custom elementor flip box widget.
 * Version: 1.0.0
 * Author: Ashraful Islam Oli
 * Author URI: http://ashrafuloli.com
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: flip-box
 */

/*
Flip Box Click Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Flip Box Click Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Flip Box Click Plugin. If not, see http://www.gnu.org/licenses/gpl-2.0.html.
*/

defined( "ABSPATH" ) or die( __( "Direct Access is not allowed.", 'flip-box' ) );

use \Elementor\Plugin as Plugin;

final class FlipBoxExtension {

	const VERSION = "1.0.0";
	const MINIMUM_ELEMENTOR_VERSION = "2.0.0";
	const MINIMUM_PHP_VERSION = "7.0";

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	public function init() {
		// text domain load
		load_plugin_textdomain( 'flip-box' );

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );

			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );

			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );

			return;
		}

		// widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

		// widgets categories
		add_action( 'elementor/elements/categories_registered', [ $this, 'registered_new_category' ] );

		// widgets style
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'widget_scripts' ] );

	}

	function widget_styles() {
		wp_enqueue_style( 'flip-box', plugins_url( '/', __FILE__ ) . 'assets/css/flipbox.css' );
	}

	function widget_scripts() {
		wp_enqueue_script( 'flip-box', plugins_url( '/', __FILE__ ) . 'assets/js/flipbox.js', [ 'jquery', ], false, true );
	}

	// create widget category
	public function registered_new_category( $manager ) {
		$manager->add_category( 'testcategory', [
			'title' => __( 'Test Category', 'flip-box' ),
			'icon'  => 'fa fa-image'
		] );
	}


	// widgets init
	public function init_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/widgets/flipbox-widget.php' );

		// Register widget
		Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Flipbox_Widget() );

	}

	// notice install elemantor
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'flip-box' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'flip-box' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'flip-box' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	// notice elemantor version
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'flip-box' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'flip-box' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'flip-box' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	// notice Php version
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'flip-box' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'flip-box' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'flip-box' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}


	public function includes() {
	}

}

FlipBoxExtension::instance();

