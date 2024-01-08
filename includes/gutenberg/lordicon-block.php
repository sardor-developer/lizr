<?php
/**
 * Lizr Gutenberg Block.
 *
 * @author  Balcomsoft
 * @package Lizr
 * @version 1.0.0
 * @since   1.0.0
 */

/**
 * Register Lordicon Block
 *
 * @return void
 */
function lizr_lordicon_block() {
	register_block_type_from_metadata( LIZR_PATH . '/includes/gutenberg' );
}
add_action( 'init', 'lizr_lordicon_block' );

/**
 * Enqueue Lordicon related assets
 *
 * @return void
 */
function lizr_lordicon_block_assets() {
	wp_enqueue_script(
		'widget-lizr',
		LIZR_URL . 'assets/js/lizr_lordicon.js',
		__FILE__,
		LIZR_VERSION,
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'lizr_lordicon_block_assets' );
add_action( 'enqueue_block_assets', 'lizr_lordicon_block_assets' );
