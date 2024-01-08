<?php
/**
 * Lizr VC functions
 *
 * @author  Balcomsoft
 * @package Lizr
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! function_exists( 'lizr_vc_regular_fields' ) ) {
	/**
	 * Lizr VC function
	 *
	 * @param string $asset Asset.
	 * @param array  $options Array of options.
	 * @return mixed
	 */
	function lizr_vc_regular_fields( $asset, $options = array() ) {
		$response = array();

		$animation_group = esc_html__( 'Animation', 'lizr' );

		$animations          = array();
		$lordicon_animations = lizr_get_lordicon_animations();
		foreach ( $lordicon_animations as $key => $animation ) {
			$animations[ $animation ] = $key;
		}

		switch ( $asset ) {
			case 'lizr_element_class':
				$response = array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'HTML Class', 'lizr' ),
					'param_name'  => 'lizr_element_class',
					'admin_label' => true,
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'lizr' ),
				);
				break;

			case 'lizr_element_id':
				$response = array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'HTML ID', 'lizr' ),
					'param_name'  => 'lizr_element_id',
					'admin_label' => true,
				);
				break;

			case 'lizr_css':
				$response = array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS', 'lizr' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'lizr' ),
				);
				break;

			case 'lizr_lordicon_icon_size':
				$response = array(
					'type'        => 'lizr_number',
					'heading'     => esc_html__( 'Icon Size', 'lizr' ),
					'param_name'  => 'lizr_lordicon_icon_size',
					'value'       => '75',
					'description' => esc_html__( 'Enter icon size (Width, Height in pixel', 'lizr' ),
				);
				break;

			case 'lizr_lordicon_icon_size_adv':
				$response = array(
					'type'        => 'lizr_size',
					'heading'     => esc_html__( 'Icon Size', 'lizr' ),
					'param_name'  => 'lizr_lordicon_icon_size_adv',
					'value'       => '75',
					'description' => esc_html__( 'Enter icon size (Width, Height in pixel', 'lizr' ),
				);
				break;

			case 'lizr_lordicon_animation':
				$response = array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Lordicon Animation', 'lizr' ),
					'param_name'  => 'lizr_lordicon_animation',
					'admin_label' => true,
					'value'       => $animations,
				);
				break;

			case 'lizr_lordicon_color_primary':
				$response = array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Lordicon Primary Color', 'lizr' ),
					'param_name'  => 'lizr_lordicon_color_primary',
					'description' => esc_html__( 'Select Primary Color of Lordicon', 'lizr' ),
				);
				break;

			case 'lizr_lordicon_color_secondary':
				$response = array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Lordicon Secondary Color', 'lizr' ),
					'param_name'  => 'lizr_lordicon_color_secondary',
					'description' => esc_html__( 'Select Secondary Color of Lordicon', 'lizr' ),
				);
				break;
		}

		return array_merge( $response, $options );
	}
}

if ( function_exists( 'vc_add_shortcode_param' ) ) {
	vc_add_shortcode_param( 'lizr_number', 'lizr_vc_number_field' );
	vc_add_shortcode_param( 'lizr_size', 'lizr_vc_size_field' );
}

if ( ! function_exists( 'lizr_vc_number_field' ) ) {
	/**
	 * Lizr Number field
	 *
	 * @param array  $settings Array of options.
	 * @param string $value Value.
	 * @return string
	 */
	function lizr_vc_number_field( $settings, $value ) {
		$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$type       = isset( $settings['type'] ) ? $settings['type'] : '';
		$class      = 'lizr-vc-number-container';

		$output = '<div class="' . esc_attr( $class ) . '">';
		ob_start();
		?>
		<label>
			<input type="number" name="<?php echo esc_attr( $param_name ); ?>" class="wpb_vc_param_value <?php echo esc_attr( $param_name ) . ' ' . esc_attr( $type ); ?>_field lizr-vc-number" value="<?php echo esc_attr( $value ); ?>"/>
		</label>
		<?php
		$output .= ob_get_clean();
		$output .= '</div>';

		return $output;
	}
}

if ( ! function_exists( 'lizr_vc_size_field' ) ) {
	/**
	 *  Lizr Advanced Size Field
	 *
	 * @param array  $settings Array of options.
	 * @param string $value Value.
	 * @return string
	 */
	function lizr_vc_size_field( $settings, $value ) {
		$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$type       = isset( $settings['type'] ) ? $settings['type'] : '';
		$options    = isset( $settings['options'] ) ? $settings['options'] : lizr_get_default_measurement_options();
		$class      = 'lizr-vc-size-container';

		$parsed_value = lizr_vc_parse_size( $value );
		$disabled     = 1 === count( $options ) ? 'disabled' : '';

		$output = '<div class="' . esc_attr( $class ) . '">';
		ob_start();
		?>
		<div class="lizr-advanced-size-wrapper">
			<label>
				<input class="" min="0" type="number" name="lizr-size-number" value="<?php echo esc_attr( $parsed_value['size'] ); ?>"/>
			</label>
			<label>
				<select name="lizr-size-measurement" <?php echo esc_attr( $disabled ); ?>>
					<?php
					foreach ( $options as $key => $option ) {
						?>
							<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $parsed_value['measurement'] ); ?>><?php echo esc_html( $option ); ?></option>
							<?php
					}
					?>
				</select>
			</label>
			<input type="hidden" name="<?php echo esc_attr( $param_name ); ?>"  value="<?php echo esc_attr( $value ); ?>" class="wpb_vc_param_value <?php echo esc_attr( $param_name ) . ' ' . esc_attr( $type ); ?>_field lizr-vc-size">
		</div>
		<?php
		$output .= ob_get_clean();
		$output .= '</div>';

		return $output;
	}
}

