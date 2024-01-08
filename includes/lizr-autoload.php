<?php
/**
 * Autoload
 *
 * @author  Balcomsoft
 * @package Lizr
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! function_exists( 'lizr_autoload' ) ) {
	/**
	 * Locate class files to load
	 *
	 * @param string $path path to class file.
	 *
	 * @return void
	 */
	function lizr_autoload( $path ) {
		$items = glob( $path . DIRECTORY_SEPARATOR . '*' );

		foreach ( $items as $item ) {
			if ( is_file( $item ) ) {
				if ( 'php' === pathinfo( $item )['extension'] && ( false !== strpos( $item, 'class-' ) ) ) {
					require_once $item;
				}
			}
		}

		// Load files in subdirectories.
		foreach ( $items as $item ) {
			if ( is_dir( $item ) ) {
				lizr_autoload( $item );
			}
		}
	}
}

require_once LIZR_PATH . '/includes/gutenberg/lordicon-block.php';

if ( defined( 'WPB_VC_VERSION' ) ) {
	require_once LIZR_PATH . '/includes/wpbakery/lizr-helpers.php';
	wp_enqueue_style( 'lizr-vc-style', LIZR_ASSETS . '/css/admin/vc-style.css', array(), LIZR_VERSION );
	wp_enqueue_script( 'lizr-vc-script', LIZR_ASSETS . '/js/vc-scripts.js', array( 'jquery' ), LIZR_VERSION, true );
	lizr_autoload( LIZR_PATH . '/includes/wpbakery' );
	require_once LIZR_PATH . '/includes/wpbakery/lizr-functions.php';
}


