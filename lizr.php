<?php
/**
 * Plugin Name: Lordiconizer - Animated Icons WP Plugin for Elementor and WPBakery
 * Description: LordIcon Animated Icons WP Plugin for Elementor, WPBakery and Gutenberg
 * Version: 2.3.0
 * Author: Balcomsoft
 * Author URI: https://www.balcomsoft.com/
 * Text Domain: lizr
 * Domain Path: /languages/
 * License: http://www.gnu.org/licenses/gpl.html
 *
 * @author  Balcomsoft
 * @package Lizr
 * @version 2.2.0
 * @since   1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'LIZR_VERSION', '2.2.0' );
define( 'LIZR_FILE', __FILE__ );
define( 'LIZR_URL', plugin_dir_url( LIZR_FILE ) );
define( 'LIZR_PATH', dirname( LIZR_FILE ) );
define( 'LIZR_ASSETS', LIZR_URL . 'assets' );
define( 'LIZR_INCLUDES', LIZR_URL . '/includes' );
define( 'LIZR_LORDICON', LIZR_ASSETS . '/images/icons/' );

require plugin_dir_path( __FILE__ ) . '/includes/lizr-autoload.php';

/**
 * Register Widgets.
 *
 * Include widget file and register widget class.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 * @since 1.0.0
 */
function register_essential_custom_widgets( $widgets_manager ) {

	require plugin_dir_path( __FILE__ ) . 'includes/elementor/class-lizr-elementor-widget.php';  // include the widget file.

	$widgets_manager->register( new \Lizr_Elementor_Widget() );  // register the widget.

}

add_action( 'elementor/widgets/register', 'register_essential_custom_widgets' );

