<?php
/**
 * Helpers
 *
 * @author  Balcomsoft
 * @package Lizr
 * @version 1.0.0
 * @since   1.0.0
 */

/**
 * Lizr get Lordicon Animation Types
 *
 * @return array
 */
function lizr_get_lordicon_animations() {
	return array(
		'hover'          => esc_html__( 'Hover', 'lizr' ),
		'click'          => esc_html__( 'Click', 'lizr' ),
		'loop'           => esc_html__( 'Loop', 'lizr' ),
		'loop-on-hover'  => esc_html__( 'Loop on Hover', 'lizr' ),
		'morph'          => esc_html__( 'Morph', 'lizr' ),
		'in-screen'      => esc_html__( 'In-screen', 'lizr' ),
		'in-screen-once' => esc_html__( 'In-screen Once', 'lizr' ),
	);
}

/**
 * Lizr get Lordicon Default Icon Measurement Options
 *
 * @return array
 */
function lizr_get_default_measurement_options() {
	return array(
		'px' => esc_html__( 'Pixels', 'lizr' ),
		'%'  => esc_html__( 'Percentage', 'lizr' ),
	);
}

/**
 * Lizr Get Lordicon Icon Size, Default is 75px
 *
 * @param int    $size Size.
 * @param string $measurement Measurement.
 * @return string
 */
function lizr_get_lordicon_icon_size( $size = 75, $measurement = 'px' ) {
	$size = intval( $size );
	if ( $size > 0 ) {
		return $size . $measurement;
	}
	return $size . $measurement;
}

/**
 * Lizr get Lordicon Style
 *
 * @param string $icon_size Size.
 * @return string
 */
function lizr_get_lordicon_style( $icon_size ) {
	if ( is_array( $icon_size ) ) {
		$width  = lizr_get_lordicon_icon_size( $icon_size['width']['size'], $icon_size['width']['measurement'] );
		$height = lizr_get_lordicon_icon_size( $icon_size['height']['size'], $icon_size['height']['measurement'] );
	} else {
		$width  = lizr_get_lordicon_icon_size( $icon_size );
		$height = lizr_get_lordicon_icon_size( $icon_size );
	}

	return sprintf( 'height: %s; width: %s', $height, $width );
}

/**
 * Get Lordicon Colors
 *
 * @param array $options Array of options.
 * @return string
 */
function lizr_get_lordicon_colors( $options = array() ) {
	$default_colors = array();

	$colors = '';
	if ( isset( $options['primary_color'] ) && ! empty( $options['primary_color'] ) ) {
		$colors .= 'primary:' . $options['primary_color'] . ',';
	} elseif ( isset( $default_colors['primary'] ) ) {
		$colors .= 'primary:' . $default_colors['primary'] . ',';
	}
	if ( isset( $options['secondary_color'] ) && ! empty( $options['secondary_color'] ) ) {
		$colors .= 'secondary:' . $options['secondary_color'] . ',';
	} elseif ( isset( $default_colors['secondary'] ) ) {
		$colors .= 'secondary:' . $default_colors['secondary'] . ',';
	}

	if ( ! empty( $colors ) ) {
		return 'colors="' . $colors . '"';
	}

	return $colors;
}

/**
 * Lizr VC Parse Advanced Size Value
 *
 * @param string $value Value.
 * @return array
 */
function lizr_vc_parse_size( $value ) {
	$response = array(
		'size'        => 0,
		'measurement' => 'px',
	);

	if ( empty( $value ) ) {
		return $response;
	}

	$value            = explode( '|', $value );
	$response['size'] = absint( $value[0] );

	if ( count( $value ) > 1 ) {
		$response['measurement'] = trim( $value[1] );
	} else {
		$response['measurement'] = 'px';
	}

	return $response;
}

/**
 * Render Lordicon Icon HTML
 *
 * @param string $src Source URL.
 * @param array  $options Array of options.
 * @return void
 */
function lizr_render_lordicon_html( $src, $options = array() ) {
	$attrs = array();
	if ( isset( $options['target'] ) && ! empty( $options['target'] ) ) {
		$attrs[] = 'target="' . esc_attr( $options['target'] ) . '"';
	}
	if ( isset( $options['trigger'] ) && ! empty( $options['trigger'] ) ) {
		$attrs[] = 'trigger="' . esc_attr( $options['trigger'] ) . '"';
	}
	if ( isset( $options['icon_size'] ) && ! empty( $options['icon_size'] ) ) {
		$attrs[] = 'style="' . lizr_get_lordicon_style( $options['icon_size'] ) . '"';
	}
	if ( isset( $options['unique_class'] ) && ! empty( $options['unique_class'] ) ) {
		$attrs['class'] = 'class="' . esc_attr( $options['unique_class'] ) . '"';
	}
	$attrs[] = lizr_get_lordicon_colors( $options );

	if ( ! empty( $src ) ) :
		?>
		<lord-icon src="<?php echo esc_url( $src ); ?>"
			<?php echo wp_kses_post( implode( ' ', $attrs ) ); ?>></lord-icon>
	<?php endif; ?>
	<?php
}


/**
 * Add file picker shortcode param.
 *
 * @param array $settings   Array of param settings.
 * @param int   $value      Param value.
 */
function lizr_file_picker_settings_field( $settings, $value ) {
	$select_file_class = '';
	$remove_file_class = ' hidden';
	$attachment_url    = wp_get_attachment_url( $value );
	if ( $attachment_url ) {
		$select_file_class = ' hidden';
		$remove_file_class = '';
	}

	ob_start();

	$input_class = esc_attr( $settings['param_name'] ) . ' ';
	if ( isset( $settings['type'] ) ) {
		$input_class .= esc_attr( $settings['type'] ) . '_field';
	}

	?>
	<div class="file_picker_block">
		<div class="<?php echo esc_attr( $settings['type'] ); ?>_display"><?php echo esc_url( $attachment_url ); ?></div>
		<input type="hidden" name="<?php echo esc_attr( $settings['param_name'] ); ?>" class="wpb_vc_param_value wpb-textinput <?php echo esc_attr( $input_class ); ?> '" value="<?php echo esc_attr( $value ); ?>" />
		<button class="button file-picker-button <?php echo esc_attr( $select_file_class ); ?>"><?php echo esc_html__( 'Select File', 'lizr' ); ?></button>
		<button class="button file-remover-button <?php echo esc_attr( $remove_file_class ); ?>"><?php echo esc_html__( 'Remove File', 'lizr' ); ?></button>
	</div>
	<?php

	return ob_get_clean();
}

vc_add_shortcode_param( 'file_picker', 'lizr_file_picker_settings_field', LIZR_ASSETS . '/js/file_picker.js' );

if ( ! function_exists( 'lizr_vc_add_inline_style' ) ) {
	/**
	 * Lizr Add Custom Styles as Inline Style
	 *
	 * @param string $css Style.
	 * @param string $custom_title Title.
	 *
	 * @since   2.2.0
	 * @return void
	 */
	function lizr_vc_add_inline_style( $css, $custom_title = 'lizr_vc_inline' ) {
		$name = 'lizr_vc_inline-' . $custom_title;
		wp_register_style( $name, false, array(), LIZR_VERSION );
		wp_enqueue_style( $name );
		wp_add_inline_style( $name, $css );
	}
}

if ( ! function_exists( 'lizr_generate_random_class' ) ) {
	/**
	 * Lizr Generate Random Class
	 *
	 * @param int $length Css file name length.
	 *
	 * @since   2.2.0
	 * @return bool|string
	 */
	function lizr_generate_random_class( $length = 10 ) {
		$x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		return substr(
			str_shuffle(
				str_repeat(
					$x,
					ceil( $length / strlen( $x ) )
				)
			),
			1,
			$length
		);
	}
}
