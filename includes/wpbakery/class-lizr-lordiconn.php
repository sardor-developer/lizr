<?php
/**
 * Lizr VC Class for icons.
 *
 * @author  Balcomsoft
 * @package Lizr
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}
if ( ! class_exists( 'Lizr_Lordiconn' ) ) {
	/**
	 * Class for Backery Lordicon feature
	 *
	 * @class   Lizr_Lordiconn
	 * @author  Balcomsoft
	 * @package Lizr
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	class Lizr_Lordiconn {

		/**
		 * Slug
		 *
		 * @var string
		 */
		protected $slug = 'lizr-vc-lord-icon';

		/**
		 * Name escaped
		 *
		 * @var string
		 */
		protected $name_escaped;

		/**
		 *  Constructor
		 */
		public function __construct() {
			$this->set_name();
			add_action( 'init', array( $this, 'mapping' ), 999 );
			add_shortcode( $this->slug . '-shortcode', array( $this, 'render' ) );
		}

		/**
		 *  Set name
		 */
		private function set_name() {
			$this->name_escaped = esc_html__( 'Lordicon', 'lizr' );
		}

		/**
		 * Mapping
		 *
		 * @return void
		 */
		public function mapping() {
			$lizr_styles = array(
				esc_html__( 'Paste URL', 'lizr' )        => 'lizr_url',
				esc_html__( 'Upload JSON File', 'lizr' ) => 'lizr_json',
			);

			$size_group = esc_html__( 'Icon Size', 'lizr' );

			$options = lizr_get_default_measurement_options();
			unset( $options['%'] );

			vc_map(
				array(
					'base'     => $this->slug . '-shortcode',
					'name'     => $this->name_escaped,
					'category' => esc_html__( 'Animated Icons', 'lizr' ),
					'icon'     => LIZR_URL . 'icon.png',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'heading'     => esc_html__( 'Icon Method', 'lizr' ),
							'param_name'  => 'lizr_method',
							'admin_label' => true,
							'value'       => $lizr_styles,
						),
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Icon url', 'lizr' ),
							'param_name'  => 'lizr_lordicon_icon',
							'value'       => '',
							'description' => wp_kses_post( 'Enter Icon URL (Only .json file acceptable)' ),
							'dependency'  => array(
								'element' => 'lizr_method',
								'value'   => array( 'lizr_url' ),
							),
						),
						array(
							'type'       => 'file_picker',
							'class'      => '',
							'heading'    => __( 'Attach Media', 'js_composer' ),
							'param_name' => 'lizr_lordicon_file',
							'value'      => '',
							'dependency' => array(
								'element' => 'lizr_method',
								'value'   => array( 'lizr_json' ),
							),
						),
						array(
							'type'       => 'checkbox',
							'heading'    => __( 'Advanced Size Control', 'lizr' ),
							'value'      => array( esc_html__( 'Yes, please', 'lizr' ) => 'yes' ),
							'param_name' => 'lizr_advanced_size',
							'group'      => $size_group,
						),
						lizr_vc_regular_fields(
							'lizr_lordicon_icon_size',
							array(
								'group'      => $size_group,
								'dependency' => array(
									'element'            => 'lizr_advanced_size',
									'value_not_equal_to' => array( 'yes' ),
								),
							)
						),
						lizr_vc_regular_fields(
							'lizr_lordicon_icon_size_adv',
							array(
								'param_name'  => 'lizr_lordicon_icon_size_width',
								'heading'     => esc_html__( 'Icon Size (Width)', 'lizr' ),
								'description' => esc_html__( 'Enter icon width (in pixels and percentage)', 'lizr' ),
								'group'       => $size_group,
								'dependency'  => array(
									'element' => 'lizr_advanced_size',
									'value'   => array( 'yes' ),
								),
							)
						),
						lizr_vc_regular_fields(
							'lizr_lordicon_icon_size_adv',
							array(
								'param_name'  => 'lizr_lordicon_icon_size_height',
								'options'     => $options,
								'heading'     => esc_html__( 'Icon Size (Height)', 'lizr' ),
								'group'       => $size_group,
								'description' => esc_html__( 'Enter icon height (only in pixels)', 'lizr' ),
								'dependency'  => array(
									'element' => 'lizr_advanced_size',
									'value'   => array( 'yes' ),
								),
							)
						),
						lizr_vc_regular_fields(
							'lizr_lordicon_icon_size_adv',
							array(
								'param_name'  => 'lizr_lordicon_icon_size_tablet_height',
								'options'     => $options,
								'heading'     => esc_html__( 'Icon Size (Height) in Tablets', 'lizr' ),
								'group'       => $size_group,
								'description' => esc_html__( 'Enter icon height (only in pixels), if it\'s value is 0, desktop version of height value will be applied.', 'lizr' ),
								'dependency'  => array(
									'element' => 'lizr_advanced_size',
									'value'   => array( 'yes' ),
								),
							)
						),
						lizr_vc_regular_fields(
							'lizr_lordicon_icon_size_adv',
							array(
								'param_name'  => 'lizr_lordicon_icon_size_mobile_height',
								'options'     => $options,
								'heading'     => esc_html__( 'Icon Size (Height) in Mobile', 'lizr' ),
								'group'       => $size_group,
								'description' => esc_html__( 'Enter icon height (only in pixels), if it\'s value is 0, desktop version of height value will be applied.', 'lizr' ),
								'dependency'  => array(
									'element' => 'lizr_advanced_size',
									'value'   => array( 'yes' ),
								),
							)
						),
						lizr_vc_regular_fields( 'lizr_lordicon_color_primary' ),
						lizr_vc_regular_fields( 'lizr_lordicon_color_secondary' ),
						lizr_vc_regular_fields( 'lizr_lordicon_animation' ),
						array(
							'type'       => 'vc_link',
							'heading'    => esc_html__( 'Link', 'lizr' ),
							'param_name' => 'lizr_link',
						),
						lizr_vc_regular_fields( 'lizr_element_class' ),
						lizr_vc_regular_fields( 'lizr_element_id' ),
						lizr_vc_regular_fields( 'lizr_css' ),
					),
				)
			);
		}

		/**
		 * Render
		 *
		 * @param array  $atts Array of attributes.
		 * @param string $content Content body.
		 * @return string
		 */
		public function render( $atts, $content ) {

			wp_enqueue_script( 'lizr-animate-js', LIZR_ASSETS . '/js/lizr_lordicon.js', array( 'jquery' ), LIZR_VERSION, true );

			ob_start();

			if ( ! is_array( $atts ) ) {
				$atts = array();
			}

			if ( ! empty( $content ) ) {
				$atts['content'] = $content;
			}

			if ( isset( $atts['lizr_link'] ) ) {
				$atts['lizr_link'] = vc_build_link( $atts['lizr_link'] );
			} else {
				$atts['lizr_link'] = null;
			}
			$args = $atts;

			$result = shortcode_atts(
				array(
					'lizr_link'                      => array(),
					'lizr_method'                    => '',
					'lizr_lordicon_icon'             => '',
					'lizr_lordicon_file'             => '',
					'lizr_advanced_size'             => '',
					'lizr_lordicon_icon_size'        => 75,
					'lizr_lordicon_icon_size_width'  => '75|px',
					'lizr_lordicon_icon_size_height' => '75|px',
					'lizr_lordicon_icon_size_tablet_height' => '',
					'lizr_lordicon_icon_size_mobile_height' => '',
					'lizr_lordicon_animation'        => 'hover',
					'lizr_lordicon_color_primary'    => '',
					'lizr_lordicon_color_secondary'  => '',
					'lizr_element_id'                => '',
					'lizr_css'                       => '',
					'lizr_element_class'             => '',
					'lizr_unique_class'              => '',
					'lizr_title'                     => '',
				),
				$args
			);

			extract( $result ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

			$unique_class = 'lizr_vc_' . lizr_generate_random_class();
			$class_name   = 'lizr_icon ' . $unique_class;

			$icon_size = array(
				'width'  => lizr_vc_parse_size( $lizr_lordicon_icon_size ),
				'height' => lizr_vc_parse_size( $lizr_lordicon_icon_size ),
			);

			$icon_tablet_size = array();
			$icon_mobile_size = array();
			if ( 'yes' === $lizr_advanced_size ) {
				$icon_size['width']  = lizr_vc_parse_size( $lizr_lordicon_icon_size_width );
				$icon_size['height'] = lizr_vc_parse_size( $lizr_lordicon_icon_size_height );

				if ( ! empty( $lizr_lordicon_icon_size_tablet_height ) ) {
					$icon_tablet_size['height'] = lizr_vc_parse_size( $lizr_lordicon_icon_size_tablet_height );
				}
				if ( ! empty( $lizr_lordicon_icon_size_mobile_height ) ) {
					$icon_mobile_size['height'] = lizr_vc_parse_size( $lizr_lordicon_icon_size_mobile_height );
				}
			}

			$css = '';
			if ( ! empty( $icon_tablet_size ) || ! empty( $icon_mobile_size ) ) {
				if ( ! empty( $icon_tablet_size ) && isset( $icon_tablet_size['height']['size'] ) && absint( $icon_tablet_size['height']['size'] ) > 0 ) {
					$css .= '@media screen and (min-width: 768px) and (max-width: 991px) {';
					$css .= '.lord-icon .lizr_icon.' . $unique_class . '{';
					$css .= 'height: ' . lizr_get_lordicon_icon_size( $icon_tablet_size['height']['size'] ) . '!important';
					$css .= '}';
					$css .= '}';
				}
				if ( ! empty( $icon_mobile_size ) && isset( $icon_mobile_size['height']['size'] ) && absint( $icon_mobile_size['height']['size'] ) > 0 ) {
					$css .= '@media screen and (max-width: 767px) {';
					$css .= '.lord-icon .lizr_icon.' . $unique_class . '{';
					$css .= 'height: ' . lizr_get_lordicon_icon_size( $icon_mobile_size['height']['size'] ) . '!important';
					$css .= '}';
					$css .= '}';
				}
			}

			if ( ! empty( $css ) ) {
				lizr_vc_add_inline_style( $css, 'style_' . $unique_class );
			}

			if ( isset( $lizr_link['url'] ) ) :
				?>
				<a href="<?php echo esc_url( $lizr_link['url'] ); ?>"><?php endif; ?>
			<div <?php echo ( ! empty( $lizr_element_id ) ) ? 'id="' . esc_attr( $lizr_element_id ) . '"' : ''; ?>
					class="lord-icon <?php echo esc_attr( $lizr_element_class ); ?>">
				<?php
				$source = 'lizr_json' === $lizr_method ? wp_get_attachment_url( $lizr_lordicon_file ) : $lizr_lordicon_icon;
				lizr_render_lordicon_html(
					$source,
					array(
						'trigger'         => $lizr_lordicon_animation,
						'target'          => $lizr_unique_class,
						'icon_size'       => $icon_size,
						'primary_color'   => $lizr_lordicon_color_primary,
						'secondary_color' => $lizr_lordicon_color_secondary,
						'unique_class'    => $class_name,
					)
				);
				?>
			</div>
			<?php if ( isset( $lizr_link['url'] ) ) : ?>
			</a>
		<?php endif; ?>
			<?php if ( isset( $lizr_link['title'] ) ) : ?>
			<div class="lord-icon-content">
				<div class="lord-icon-title"><?php echo esc_html( $lizr_link['title'] ); ?></div>
			</div>
		<?php endif; ?>
			<?php
			return ob_get_clean();
		}
	}

	new Lizr_Lordiconn();
}

