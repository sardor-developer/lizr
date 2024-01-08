<?php
/**
 * Elementor Widget.
 *
 * @author  Balcomsoft
 *
 * @package Lizr
 * @version 2.3.0
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Lizr Elementor Widget.
 *
 * Elementor widget that inserts a card with title and description.
 *
 * @since 1.0.0
 */
class Lizr_Elementor_Widget extends \Elementor\Widget_Base {


	/**
	 * Get script depends
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function get_script_depends() {
		wp_register_script( 'widget-lizr', LIZR_URL . 'assets/js/lizr_lordicon.js', __FILE__, '1.0.0', true );
		return array(
			'widget-lizr',
		);

	}


	/**
	 * Get widget name.
	 *
	 * Retrieve Lizr widget name.
	 *
	 * @return string Widget name.
	 * @since  1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'Lordicon';
	}


	/**
	 * Get widget title.
	 *
	 * Retrieve Lordicon widget title.
	 *
	 * @return string Widget title.
	 * @since  1.0.0
	 * @access public
	 */
	public function get_title() {
		return esc_html__( 'Lordicon', 'lizr' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Lordicon widget icon.
	 *
	 * @return string Widget icon.
	 * @since  1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-favorite';
	}


	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @return string Widget help URL.
	 * @since  1.0.0
	 * @access public
	 */
	public function get_custom_help_url() {
		return '';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Card widget belongs to.
	 *
	 * @return array Widget categories.
	 * @since  1.0.0
	 * @access public
	 */
	public function get_categories() {
		return array( 'general' );
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the Card widget belongs to.
	 *
	 * @return array Widget keywords.
	 * @since  1.0.0
	 * @access public
	 */
	public function get_keywords() {
		return array( 'lordicon' );
	}


	/**
	 * Register Lordicon widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// our control function code goes here.
		$this->start_controls_section(
			'section_query',
			array(
				'label' => esc_html__( 'General', 'lizr' ),
			)
		);
		$this->add_control(
			'icon_method',
			array(
				'label'   => esc_html__( 'Icon method', 'lizr' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'paste_url'        => esc_html__( 'Paste Lordicon URL', 'lizr' ),
					'upload_json_file' => esc_html__( 'Upload Lordicon JSON File', 'lizr' ),
				),
				'default' => 'paste_url',
			)
		);
		$this->add_control(
			'cdn_lordicon',
			array(
				'label'     => esc_html__( 'Paste CDN', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => array(
					'icon_method' => 'paste_url',
				),
				'dynamic'   => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'json_lordicon',
			array(
				'label'      => esc_html__( 'Json File', 'lizr' ),
				'type'       => \Elementor\Controls_Manager::MEDIA,
				'condition'  => array(
					'icon_method' => 'upload_json_file',
				),
				'default'    => array(
					'url' => '',
				),
				'media_type' => 'application/json',
			)
		);
		$this->add_control(
			'animation_trigger',
			array(
				'label'   => esc_html__( 'Animation Trigger', 'lizr' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'loop'           => esc_html__( 'Loop (always animate)', 'lizr' ),
					'click'          => esc_html__( 'Click', 'lizr' ),
					'loop-on-hover'  => esc_html__( 'Loop on Hover', 'lizr' ),
					'morph'          => esc_html__( 'Morph', 'lizr' ),
					'in-screen'      => esc_html__( 'In-screen', 'lizr' ),
					'in-screen-once' => esc_html__( 'In-screen Once', 'lizr' ),
				),
				'default' => 'loop',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'lizr' ),
			)
		);
		$this->add_control(
			'title_switcher',
			array(
				'label'        => esc_html__( 'Show title', 'lizr' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => esc_html__( 'Yes', 'lizr' ),
				'label_off'    => esc_html__( 'No', 'lizr' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'lizr' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'title_switcher' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'text_switcher',
			array(
				'label'        => esc_html__( 'Show text', 'lizr' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => esc_html__( 'Yes', 'lizr' ),
				'label_off'    => esc_html__( 'No', 'lizr' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'text',
			array(
				'label'       => esc_html__( 'Description', 'lizr' ),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'default'     => '',
				'placeholder' => esc_html__( 'Type your description here', 'plugin-name' ),
				'condition'   => array(
					'text_switcher' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'enable_link_lordicon',
			array(
				'label'        => esc_html__( 'Enable Link', 'lizr' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'lizr' ),
				'label_off'    => esc_html__( 'No', 'lizr' ),
				'description'  => esc_html__( 'if no button will add link to icon' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'button_link_lordicon',
			array(
				'label'       => esc_html__( 'Link', 'lizr' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'Paste URL or type', 'plugin-name' ),
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				),
				'condition'   => array(
					'enable_link_lordicon' => array( 'yes' ),
				),
				'label_block' => true,
			)
		);
		$this->add_control(
			'show_button_lordicon',
			array(
				'label'     => esc_html__( 'Show Button', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'lizr' ),
				'label_off' => esc_html__( 'No', 'lizr' ),
				'condition' => array(
					'enable_link_lordicon' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'button_text_lordicon',
			array(
				'label'       => esc_html__( 'Button Text', 'lizr' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Learn more',
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'show_button_lordicon' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();
		// Style icon controls.
		$this->start_controls_section(
			'section_icon',
			array(
				'label' => esc_html__( 'Icon', 'lizr' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'lordicon_size',
			array(
				'label'      => esc_html__( 'Size', 'lizr' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 5,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 200,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lord-icon lord-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'lordicon_one_color',
			array(
				'default' => '#08a88a',
				'label'   => esc_html__( 'Color One', 'lizr' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
			)
		);
		$this->add_control(
			'lordicon_two_color',
			array(
				'default' => '#08a88a',
				'label'   => esc_html__( 'Color Two', 'lizr' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
			)
		);
		$this->add_responsive_control(
			'lordicon_stroke',
			array(
				'label'   => esc_html__( 'Stroke', 'lizr' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range'   => array(
					'' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
				),
				'default' => array(
					'size' => 30,
				),
			)
		);
		$this->add_control(
			'lordicon_background',
			array(
				'label'     => esc_html__( 'Icon Background', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .lord-icon lord-icon' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'border',
			array(
				'label' => esc_html__( 'Icon Border', 'lizr' ),
				'type'  => \Elementor\Controls_Manager::SWITCHER,
			)
		);
		$this->add_responsive_control(
			'border_style',
			array(
				'label'     => esc_html__( 'Icon Border Style', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => array(
					''       => esc_html__( 'None', 'plugin-name' ),
					'solid'  => esc_html__( 'Solid', 'plugin-name' ),
					'double' => esc_html__( 'Double', 'plugin-name' ),
					'dotted' => esc_html__( 'Dotted', 'plugin-name' ),
					'dashed' => esc_html__( 'Dashed', 'plugin-name' ),
					'groove' => esc_html__( 'Groove', 'plugin-name' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .lord-icon lord-icon' => 'border-style: {{VALUE}}',
				),
				'condition' => array(
					'border' => 'yes',
				),
			)
		);
		$this->add_control(
			'border_color',
			array(
				'label'     => esc_html__( 'Icon Border Color', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .lord-icon lord-icon' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'border_radius',
			array(
				'label'     => esc_html__( 'Icon Border Radius', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .lord-icon lord-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array(
					'border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'border_width',
			array(
				'label'     => esc_html__( 'Icon Border Width', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .lord-icon lord-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array(
					'border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'margin',
			array(
				'label'      => esc_html__( 'Icon Margin', 'lizr' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lord-icon lord-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'label'    => esc_html__( 'Icon Shadow', 'textdomain' ),
				'selector' => '{{WRAPPER}} .lord-icon lord-icon',
			)
		);
		$this->add_responsive_control(
			'padding',
			array(
				'label'      => esc_html__( 'Icon Padding', 'lizr' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lord-icon lord-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
		// Box controls.
		$this->start_controls_section(
			'section_box',
			array(
				'label' => esc_html__( 'Box', 'lizr' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'text_align',
			array(
				'label'   => esc_html__( 'Icon Alignment', 'lizr' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'lizr' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'lizr' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'lizr' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default' => 'center',
				'toggle'  => true,
			)
		);
		$this->add_responsive_control(
			'box_padding',
			array(
				'label'      => esc_html__( 'Box Padding', 'lizr' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-lizr-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'box_background',
			array(
				'label'     => esc_html__( 'Box Background', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .elementor-lizr-widget' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'border_box',
			array(
				'label' => esc_html__( 'Box Border', 'lizr' ),
				'type'  => \Elementor\Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'border_box_style',
			array(
				'label'     => esc_html__( 'Box Border Style', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => array(
					''       => esc_html__( 'None', 'plugin-name' ),
					'solid'  => esc_html__( 'Solid', 'plugin-name' ),
					'double' => esc_html__( 'Double', 'plugin-name' ),
					'dotted' => esc_html__( 'Dotted', 'plugin-name' ),
					'dashed' => esc_html__( 'Dashed', 'plugin-name' ),
					'groove' => esc_html__( 'Groove', 'plugin-name' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-lizr-widget' => 'border-style: {{VALUE}}',
				),
				'condition' => array(
					'border_box' => 'yes',
				),
			)
		);
		$this->add_control(
			'border_box_color',
			array(
				'label'     => esc_html__( 'Box Border Color', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .elementor-lizr-widget' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'border_box' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'border_box_radius',
			array(
				'label'     => esc_html__( 'Box Border Radius', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .elementor-lizr-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array(
					'border_box' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'border_box_width',
			array(
				'label'     => esc_html__( 'Box Border Width', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .elementor-lizr-widget' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array(
					'border_box' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'box_layout',
			array(
				'label'     => esc_html__( 'Box Layout', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'column',
				'options'   => array(
					'column'      => esc_html__( 'Column', 'plugin-name' ),
					'unset'       => esc_html__( 'Column Reverse', 'plugin-name' ),
					'row'         => esc_html__( 'Row', 'plugin-name' ),
					'row-reverse' => esc_html__( 'Row Reverse', 'plugin-name' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-lizr-widget' => 'flex-direction: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		// Box hover controls.
		$this->start_controls_section(
			'section_box_hover',
			array(
				'label' => esc_html__( 'Box Hover', 'lizr' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'box_background_hover',
			array(
				'label'     => esc_html__( 'Background Hover', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .elementor-lizr-widget:hover' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'border_box_hover',
			array(
				'label' => esc_html__( 'Border Hover', 'lizr' ),
				'type'  => \Elementor\Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'border_box_style_hover',
			array(
				'label'     => esc_html__( 'Border Hover', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => array(
					''       => esc_html__( 'None', 'plugin-name' ),
					'solid'  => esc_html__( 'Solid', 'plugin-name' ),
					'double' => esc_html__( 'Double', 'plugin-name' ),
					'dotted' => esc_html__( 'Dotted', 'plugin-name' ),
					'dashed' => esc_html__( 'Dashed', 'plugin-name' ),
					'groove' => esc_html__( 'Groove', 'plugin-name' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-lizr-widget:hover' => 'border-style: {{VALUE}}',
				),
				'condition' => array(
					'border_box_hover' => 'yes',
				),
			)
		);
		$this->add_control(
			'box_color_hover',
			array(
				'label'     => esc_html__( 'Box Border Color', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .elementor-lizr-widget:hover' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'border_box_hover' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'box_radius_hover',
			array(
				'label'     => esc_html__( 'Box Border Radius', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .elementor-lizr-widget:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array(
					'border_box_hover' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'box_width_hover',
			array(
				'label'     => esc_html__( 'Box Border Width', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .elementor-lizr-widget:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array(
					'border_box_hover' => 'yes',
				),
			)
		);
		$this->add_control(
			'box_icon_background_hover',
			array(
				'label'     => esc_html__( 'Icon Background Hover', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .elementor-lizr-widget:hover .lord-icon lord-icon' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'hover_animation',
			array(
				'label' => esc_html__( 'Box Hover ', 'textdomain' ),
				'type'  => \Elementor\Controls_Manager::HOVER_ANIMATION,
			)
		);
		$this->end_controls_section();
		// Typography controls.
		$this->start_controls_section(
			'section_style',
			array(
				'label' => esc_html__( 'Typography', 'lizr' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'title_options',
			array(
				'label'     => esc_html__( 'Title Options', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#f00',
				'selectors' => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .lord-icon-content .lord-icon-title',
			)
		);
		$this->add_control(
			'title_spacing',
			array(
				'label'     => esc_html__( 'Title Spacing', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'default'   => array(
					'unit' => '%',
				),
				'selectors' => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'description_options',
			array(
				'label'     => esc_html__( 'Description Options', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'description_color',
			array(
				'label'     => esc_html__( 'Color', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#f00',
				'selectors' => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-text' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .lord-icon-content .lord-icon-text',
			)
		);
		$this->add_control(
			'description_spacing',
			array(
				'label'     => esc_html__( 'Text Spacing', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'default'   => array(
					'unit' => '%',
				),
				'selectors' => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-text' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'text_align_typography',
			array(
				'label'   => esc_html__( 'Content Alignment', 'lizr' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => array(
					'inherit' => array(
						'title' => esc_html__( 'inherit', 'lizr' ),
						'icon'  => 'eicon-text-align-inherit',
					),
					'left'    => array(
						'title' => esc_html__( 'Left', 'lizr' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => esc_html__( 'Center', 'lizr' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => esc_html__( 'Right', 'lizr' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default' => 'inherit',
				'toggle'  => true,
			)
		);
		$this->end_controls_section();
		// Button controls.
		$this->start_controls_section(
			'section_button',
			array(
				'label' => esc_html__( 'Button', 'lizr' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_group_control',
				'label'    => esc_html__( 'Button Typography', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .lord-icon-content .lord-icon-button',
			)
		);
		$this->add_control(
			'hover_animation_button',
			array(
				'label' => esc_html__( 'Button Hover Animation', 'textdomain' ),
				'type'  => \Elementor\Controls_Manager::HOVER_ANIMATION,
			)
		);
		$this->add_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Icon Padding', 'lizr' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				array(
					'top'      => '10',
					'right'    => '20',
					'bottom'   => '10',
					'left'     => '20',
					'unit'     => '',
					'isLinked' => '',
				),
			)
		);
		$this->add_control(
			'button_background',
			array(
				'label'     => esc_html__( 'Button Background color', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#9C9C9C',
				'selectors' => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-button' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_hover_background',
			array(
				'label'     => esc_html__( 'Button Background color hover', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#9C9C9C',
				'selectors' => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-button:hover' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_color',
			array(
				'label'     => esc_html__( 'Button Text color', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-button' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_color_hover',
			array(
				'label'     => esc_html__( 'Button Text color hover', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#f00',
				'selectors' => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-button:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_spaceing',
			array(
				'label'     => esc_html__( 'Button Spacing', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors' => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-button' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'button_border',
			array(
				'label' => esc_html__( 'Button Border', 'lizr' ),
				'type'  => \Elementor\Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'button_border_style',
			array(
				'label'     => esc_html__( 'Button Border Style', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => array(
					''       => esc_html__( 'None', 'plugin-name' ),
					'solid'  => esc_html__( 'Solid', 'plugin-name' ),
					'double' => esc_html__( 'Double', 'plugin-name' ),
					'dotted' => esc_html__( 'Dotted', 'plugin-name' ),
					'dashed' => esc_html__( 'Dashed', 'plugin-name' ),
					'groove' => esc_html__( 'Groove', 'plugin-name' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-button' => 'border-style: {{VALUE}}',
				),
				'condition' => array(
					'button_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'button_border_color',
			array(
				'label'     => esc_html__( 'Button Border Color', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-button' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'button_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'     => esc_html__( 'Button Border Radius', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array(
					'button_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'button_border_width',
			array(
				'label'     => esc_html__( 'Button Border Width', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array(
					'button_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'button_type',
			array(
				'label'     => esc_html__( 'Button Type', 'lizr' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => array(
					'auto' => esc_html__( 'Auto Width', 'plugin-name' ),
					'100%' => esc_html__( 'Full Width', 'plugin-name' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .lord-icon-content .lord-icon-button' => 'width: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();

	}

	/**
	 * Render Lordicon widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings             = $this->get_settings_for_display();
		$title                = $settings['title'];
		$text                 = $settings['text'];
		$button_text_lordicon = $settings['button_text_lordicon'];
		$stroke               = $settings['lordicon_stroke']['size'];
		$cdn_lordicon         = $settings['cdn_lordicon'];
		$animation_trigger    = $settings['animation_trigger'];
		$enable_link_lordicon = $settings['enable_link_lordicon'];
		$show_button_lordicon = $settings['show_button_lordicon'];
		if ( ! empty( $settings['button_link_lordicon']['url'] ) ) {
			$this->add_link_attributes( 'button_link_lordicon', $settings['button_link_lordicon'] );
		}
		$allowed_html = array(
			'a'      => array(
				'href'  => array(),
				'title' => array(),
			),
			'br'     => array(),
			'em'     => array(),
			'strong' => array(),
		);
		if ( 'yes' === $enable_link_lordicon ) : ?>
			<a <?php echo wp_kses( $this->get_render_attribute_string( 'button_link_lordicon' ), $allowed_html ); ?>>
		<?php endif; ?>
		<div class="elementor-lizr-widget elementor-animation-<?php echo esc_attr( $settings['hover_animation'] ); ?>" style="text-align: <?php echo esc_attr( $settings['text_align'] ); ?>; display: flex; transition: 0.3s;">
		<div class="lord-icon">
			<lord-icon
					src="
					<?php
					echo ( ! empty( $cdn_lordicon ) ) ? esc_url( $cdn_lordicon ) : '';
					echo ( ! empty( $settings['json_lordicon']['url'] ) ) ? esc_url( $settings['json_lordicon']['url'] ) : '';
					?>
					"
					trigger="<?php echo esc_attr( $animation_trigger ); ?>"
					stroke="<?php echo esc_attr( $stroke ); ?>"
					colors="primary:<?php echo esc_attr( $settings['lordicon_one_color'] ); ?>,secondary:<?php echo esc_attr( $settings['lordicon_two_color'] ); ?>"
			>
			</lord-icon>
		</div>
		<?php if ( 'yes' === $enable_link_lordicon ) : ?>
		<?php endif; ?>
		</a>
		<div class="lord-icon-content" style="text-align: <?php echo esc_attr( $settings['text_align_typography'] ); ?>">
			<div class="lord-icon-title"><?php echo esc_html( $title ); ?></div>
			<div class="lord-icon-text"><?php echo wp_kses_post( $text ); ?></div>
			<?php if ( 'yes' === $show_button_lordicon ) : ?>
				<a <?php echo wp_kses( $this->get_render_attribute_string( 'button_link_lordicon' ), $allowed_html ); ?>
				class="lord-icon-button elementor-button-link elementor-button elementor-animation-<?php echo esc_attr( $settings['hover_animation_button'] ); ?>"><?php echo esc_html( $button_text_lordicon ); ?></a><?php endif; ?>
		</div>
		</div>
		<?php

	}

}


