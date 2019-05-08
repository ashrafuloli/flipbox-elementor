<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Scheme_Typography;
use Elementor\Utils;

class Elementor_Flipbox_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'flipbox-pp';
	}

	public function get_title() {
		return __( 'Flip Box Click', 'flip-box' );
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function get_icon() {
		return 'eicon-flip-box';
	}

	public function get_script_depends() {
		return [
			'flip-box-frontend',
		];
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {

		/*-----------------------------------------------------------------------------------*/
		/*	CONTENT TAB
		/*-----------------------------------------------------------------------------------*/

		/**
		 * Content Tab: Front
		 */
		$this->start_controls_section(
			'section_front',
			[
				'label' => esc_html__( 'Front', 'flip-box' )
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label'       => esc_html__( 'Icon Type', 'flip-box' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'none'  => [
						'title' => __( 'None', 'flip-box' ),
						'icon'  => 'fa fa-ban',
					],
					'image' => [
						'title' => __( 'Image', 'flip-box' ),
						'icon'  => 'fa fa-picture-o',
					],
					'icon'  => [
						'title' => __( 'Icon', 'flip-box' ),
						'icon'  => 'fa fa-star',
					],
				],
				'default'     => 'icon',
			]
		);

		$this->add_control(
			'icon_image',
			[
				'label'     => esc_html__( 'Choose Image', 'flip-box' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);

		$this->add_control(
			'icon',
			[
				'label'     => esc_html__( 'Icon', 'flip-box' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-star',
				'condition' => [
					'icon_type' => 'icon'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
					'icon_type'        => 'image',
					'icon_image[url]!' => '',
				],
			]
		);

		$this->add_control(
			'title_front',
			[
				'label'       => esc_html__( 'Title', 'flip-box' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => esc_html__( 'This is the heading', 'flip-box' ),
				'separator'   => 'before'
			]
		);
		$this->add_control(
			'description_front',
			[
				'label'       => esc_html__( 'Description', 'flip-box' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( 'This is the front content. Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'flip-box' ),
			]
		);

		$this->end_controls_section();

		/**
		 * Content Tab: Back
		 */
		$this->start_controls_section(
			'section_back',
			[
				'label' => esc_html__( 'Back', 'flip-box' )
			]
		);

		$this->add_control(
			'icon_type_back',
			[
				'label'       => esc_html__( 'Icon Type', 'flip-box' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'none'  => [
						'title' => __( 'None', 'flip-box' ),
						'icon'  => 'fa fa-ban',
					],
					'image' => [
						'title' => __( 'Image', 'flip-box' ),
						'icon'  => 'fa fa-picture-o',
					],
					'icon'  => [
						'title' => __( 'Icon', 'flip-box' ),
						'icon'  => 'fa fa-star',
					],
				],
				'default'     => 'icon',
			]
		);

		$this->add_control(
			'icon_image_back',
			[
				'label'     => esc_html__( 'Flipbox Image', 'flip-box' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type_back' => 'image'
				]
			]
		);

		$this->add_control(
			'icon_back',
			[
				'label'     => esc_html__( 'Icon', 'flip-box' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-snowflake-o',
				'condition' => [
					'icon_type_back' => 'icon'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail_back',
				'default'   => 'full',
				'condition' => [
					'icon_type_back'        => 'image',
					'icon_image_back[url]!' => '',
				],
			]
		);

		$this->add_control(
			'title_back',
			[
				'label'       => esc_html__( 'Title', 'flip-box' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => esc_html__( 'This is the heading', 'flip-box' ),
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'description_back',
			[
				'label'       => esc_html__( 'Description', 'flip-box' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => __( 'This is the front content. Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'flip-box' ),
			]
		);

		$this->add_control(
			'link_type',
			[
				'label'   => __( 'Link Type', 'flip-box' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'   => __( 'None', 'flip-box' ),
					'title'  => __( 'Title', 'flip-box' ),
					'button' => __( 'Button', 'flip-box' ),
					'box'    => __( 'Box', 'flip-box' ),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => __( 'Link', 'flip-box' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active'     => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY
					],
				],
				'placeholder' => 'https://www.your-link.com',
				'default'     => [
					'url' => '#',
				],
				'dynamic'     => [
					'active' => true,
				],
				'condition'   => [
					'link_type!' => 'none',
				],
			]
		);

		$this->add_control(
			'flipbox_button_text',
			[
				'label'     => __( 'Button Text', 'flip-box' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [
					'active' => true,
				],
				'default'   => __( 'Get Started', 'flip-box' ),
				'condition' => [
					'link_type' => 'button',
				],
				'dynamic'   => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'     => __( 'Button Icon', 'flip-box' ),
				'type'      => Controls_Manager::ICON,
				'default'   => '',
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_control(
			'button_icon_position',
			[
				'label'     => __( 'Icon Position', 'flip-box' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => [
					'after'  => __( 'After', 'flip-box' ),
					'before' => __( 'Before', 'flip-box' ),
				],
				'condition' => [
					'link_type'    => 'button',
					'button_icon!' => '',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Content Tab: Settings
		 */
		$this->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__( 'Settings', 'flip-box' )
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'      => __( 'Height', 'flip-box' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range'      => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .pp-flipbox-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'flip-box' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .pp-flipbox-back, {{WRAPPER}} .pp-flipbox-front' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'flip_effect',
			[
				'label'       => esc_html__( 'Flip Effect', 'flip-box' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'flip',
				'label_block' => false,
				'options'     => [
					'flip'     => esc_html__( 'Flip', 'flip-box' ),
					'slide'    => esc_html__( 'Slide', 'flip-box' ),
					'zoom-in'  => esc_html__( 'Zoom In', 'flip-box' ),
					'zoom-out' => esc_html__( 'Zoom Out', 'flip-box' ),
				],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'flip_direction',
			[
				'label'       => esc_html__( 'Flip Direction', 'flip-box' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'left',
				'label_block' => false,
				'options'     => [
					'left'  => esc_html__( 'Left', 'flip-box' ),
					'right' => esc_html__( 'Right', 'flip-box' ),
					'up'    => esc_html__( 'Top', 'flip-box' ),
					'down'  => esc_html__( 'Bottom', 'flip-box' ),
				],
				'condition'   => [
					'flip_effect!' => [
						'zoom-in',
						'zoom-out',
					],
				],
			]
		);

		$this->end_controls_section();

		/*-----------------------------------------------------------------------------------*/
		/*	STYLE TAB
		/*-----------------------------------------------------------------------------------*/

		/**
		 * Style Tab: Front
		 */
		$this->start_controls_section(
			'section_front_style',
			[
				'label' => esc_html__( 'Front', 'flip-box' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'padding_front',
			[
				'label'      => esc_html__( 'Padding', 'flip-box' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pp-flipbox-front .pp-flipbox-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'content_alignment_front',
			[
				'label'       => esc_html__( 'Text Alignment', 'flip-box' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'   => [
						'title' => esc_html__( 'Left', 'flip-box' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'flip-box' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'flip-box' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'     => 'center',
				'selectors'   => [
					'{{WRAPPER}} .pp-flipbox-front .pp-flipbox-overlay' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'vertical_position_front',
			[
				'label'                => __( 'Vertical Position', 'flip-box' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => [
					'top'    => [
						'title' => __( 'Top', 'flip-box' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'flip-box' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'flip-box' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary' => [
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors'            => [
					'{{WRAPPER}} .pp-flipbox-front .pp-flipbox-overlay' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'background_front',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pp-flipbox-front',
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'border_front',
				'label'     => esc_html__( 'Border Style', 'flip-box' ),
				'selector'  => '{{WRAPPER}} .pp-flipbox-front',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'overlay_front',
			[
				'label'     => esc_html__( 'Overlay', 'flip-box' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'overlay_front',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .pp-flipbox-front .pp-flipbox-overlay',
			]
		);

		$this->add_control(
			'image_style_heading_front',
			[
				'label'     => esc_html__( 'Image', 'flip-box' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);

		$this->add_responsive_control(
			'image_spacing_front',
			[
				'label'     => __( 'Spacing', 'flip-box' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-icon-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);

		$this->add_responsive_control(
			'image_size_front',
			[
				'label'     => esc_html__( 'Size (%)', 'flip-box' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => ''
				],
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-icon-image > img' => 'width: {{SIZE}}%;'
				],
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);

		$this->add_control(
			'icon_style_heading_front',
			[
				'label'     => esc_html__( 'Icon', 'flip-box' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'icon_type' => 'icon'
				]
			]
		);

		$this->add_control(
			'icon_color_front',
			[
				'label'     => esc_html__( 'Color', 'flip-box' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-icon-image .fa' => 'color: {{VALUE}};',
				],
				'condition' => [
					'icon_type' => 'icon'
				]
			]
		);

		$this->add_control(
			'icon_size_front',
			[
				'label'     => __( 'Icon Size', 'flip-box' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-icon-image .fa' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'icon'
				]
			]
		);

		$this->add_responsive_control(
			'icon_spacing_front',
			[
				'label'     => __( 'Spacing', 'flip-box' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-icon-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'icon'
				]
			]
		);

		$this->add_control(
			'title_heading_front',
			[
				'label'     => esc_html__( 'Title', 'flip-box' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'title_color_front',
			[
				'label'     => esc_html__( 'Color', 'flip-box' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-front .pp-flipbox-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography_front',
				'selector' => '{{WRAPPER}} .pp-flipbox-front .pp-flipbox-heading',
			]
		);

		$this->add_control(
			'description_heading_front',
			[
				'label'     => esc_html__( 'Description', 'flip-box' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'description_color_front',
			[
				'label'     => esc_html__( 'Color', 'flip-box' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-front .pp-flipbox-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography_front',
				'selector' => '{{WRAPPER}} .pp-flipbox-front .pp-flipbox-content',
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Back
		 */
		$this->start_controls_section(
			'section_back_style',
			[
				'label' => esc_html__( 'Back', 'flip-box' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'padding_back',
			[
				'label'      => esc_html__( 'Padding', 'flip-box' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pp-flipbox-back .pp-flipbox-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'content_alignment_back',
			[
				'label'       => esc_html__( 'Alignment', 'flip-box' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'   => [
						'title' => esc_html__( 'Left', 'flip-box' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'flip-box' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'flip-box' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'     => 'center',
				'selectors'   => [
					'{{WRAPPER}} .pp-flipbox-back .pp-flipbox-overlay' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'vertical_position_back',
			[
				'label'                => __( 'Vertical Position', 'flip-box' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => [
					'top'    => [
						'title' => __( 'Top', 'flip-box' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'flip-box' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'flip-box' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary' => [
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors'            => [
					'{{WRAPPER}} .pp-flipbox-back .pp-flipbox-overlay' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'background_back',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pp-flipbox-back',
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'border_back',
				'label'     => esc_html__( 'Border Style', 'flip-box' ),
				'selector'  => '{{WRAPPER}} .pp-flipbox-back',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'overlay_back',
			[
				'label'     => esc_html__( 'Overlay', 'flip-box' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'overlay_back',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .pp-flipbox-back .pp-flipbox-overlay',
			]
		);

		$this->add_control(
			'image_style_heading_back',
			[
				'label'     => esc_html__( 'Image', 'flip-box' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'icon_type_back' => 'image'
				]
			]
		);

		$this->add_responsive_control(
			'image_spacing_back',
			[
				'label'     => __( 'Spacing', 'flip-box' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-icon-image-back' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type_back' => 'image'
				]
			]
		);

		$this->add_responsive_control(
			'image_size_back',
			[
				'label'     => esc_html__( 'Size (%)', 'flip-box' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => ''
				],
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-icon-image-back > img' => 'width: {{SIZE}}%;'
				],
				'condition' => [
					'icon_type_back' => 'image'
				]
			]
		);

		$this->add_control(
			'icon_style_heading_back',
			[
				'label'     => esc_html__( 'Icon', 'flip-box' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'icon_type_back' => 'icon'
				]
			]
		);

		$this->add_control(
			'icon_color_back',
			[
				'label'     => esc_html__( 'Color', 'flip-box' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-icon-image-back .fa' => 'color: {{VALUE}};',
				],
				'condition' => [
					'icon_type_back' => 'icon'
				]
			]
		);

		$this->add_control(
			'icon_size_back',
			[
				'label'     => __( 'Icon Size', 'flip-box' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-icon-image-back .fa' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type_back' => 'icon'
				]
			]
		);

		$this->add_responsive_control(
			'icon_spacing_back',
			[
				'label'     => __( 'Spacing', 'flip-box' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-icon-image-back' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type_back' => 'icon'
				]
			]
		);

		$this->add_control(
			'title_heading_back',
			[
				'label'     => esc_html__( 'Title', 'flip-box' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'title_color_back',
			[
				'label'     => esc_html__( 'Color', 'flip-box' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-back .pp-flipbox-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography_back',
				'selector' => '{{WRAPPER}} .pp-flipbox-back .pp-flipbox-heading',
			]
		);

		$this->add_control(
			'description_heading_back',
			[
				'label'     => esc_html__( 'Description', 'flip-box' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'description_color_back',
			[
				'label'     => esc_html__( 'Color', 'flip-box' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-back .pp-flipbox-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography_back',
				'selector' => '{{WRAPPER}} .pp-flipbox-back .pp-flipbox-content',
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Button
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_info_box_button_style',
			[
				'label'     => __( 'Button', 'flip-box' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_control(
			'button_size',
			[
				'label'     => __( 'Size', 'flip-box' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'md',
				'options'   => [
					'xs' => __( 'Extra Small', 'flip-box' ),
					'sm' => __( 'Small', 'flip-box' ),
					'md' => __( 'Medium', 'flip-box' ),
					'lg' => __( 'Large', 'flip-box' ),
					'xl' => __( 'Extra Large', 'flip-box' ),
				],
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_responsive_control(
			'button_spacing',
			[
				'label'     => __( 'Spacing', 'flip-box' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-button' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label'     => __( 'Normal', 'flip-box' ),
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_control(
			'button_bg_color_normal',
			[
				'label'     => __( 'Background Color', 'flip-box' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-button' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_control(
			'button_text_color_normal',
			[
				'label'     => __( 'Text Color', 'flip-box' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-button' => 'color: {{VALUE}}',
				],
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'button_border_normal',
				'label'       => __( 'Border', 'flip-box' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .pp-flipbox-button',
				'condition'   => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'flip-box' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pp-flipbox-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'button_typography',
				'label'     => __( 'Typography', 'flip-box' ),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .pp-flipbox-button',
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Padding', 'flip-box' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pp-flipbox-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'button_box_shadow',
				'selector'  => '{{WRAPPER}} .pp-flipbox-button',
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_control(
			'info_box_button_icon_heading',
			[
				'label'     => __( 'Button Icon', 'flip-box' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'link_type'    => 'button',
					'button_icon!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_icon_margin',
			[
				'label'       => __( 'Margin', 'flip-box' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => [ 'px', '%' ],
				'placeholder' => [
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				],
				'condition'   => [
					'link_type'    => 'button',
					'button_icon!' => '',
				],
				'selectors'   => [
					'{{WRAPPER}} .pp-info-box .pp-button-icon' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label'     => __( 'Hover', 'flip-box' ),
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'flip-box' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-button:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label'     => __( 'Text Color', 'flip-box' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-button:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_control(
			'button_border_color_hover',
			[
				'label'     => __( 'Border Color', 'flip-box' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pp-flipbox-button:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_control(
			'button_animation',
			[
				'label'     => __( 'Animation', 'flip-box' ),
				'type'      => Controls_Manager::HOVER_ANIMATION,
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'button_box_shadow_hover',
				'selector'  => '{{WRAPPER}} .pp-flipbox-button:hover',
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		$flipbox_if_html_tag = 'div';
		$this->add_render_attribute( 'flipbox-card', 'class', 'pp-flipbox-flip-card' );

		$this->add_render_attribute(
			'flipbox-container',
			[
				'class' => [
					'pp-flipbox-wrapper',
					'pp-animate-' . esc_attr( $settings['flip_effect'] ),
					'pp-direction-' . esc_attr( $settings['flip_direction'] )
				]
			]
		);

		?>

		<div <?php echo $this->get_render_attribute_string( 'flipbox-container' ); ?>>

			<div <?php echo $this->get_render_attribute_string( 'flipbox-card' ); ?>>

				<?php
				// Front
				$this->render_front();

				// Back
				$this->render_back();
				?>

			</div>
		</div>
		<?php
	}

	protected function render_front() {
		$settings = $this->get_settings();
		?>
		<div class="pp-flipbox-front">
			<div class="pp-flipbox-overlay">
				<div class="pp-flipbox-inner">
					<div class="pp-flipbox-icon-image">
						<?php if ( 'icon' === $settings['icon_type'] ) { ?>
							<i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i>
						<?php } elseif ( 'image' === $settings['icon_type'] ) { ?>
							<?php
							$flipbox_image     = $settings['icon_image'];
							$flipbox_image_url = Group_Control_Image_Size::get_attachment_image_src( $flipbox_image['id'], 'thumbnail', $settings );
							$flipbox_image_url = ( empty( $flipbox_image_url ) ) ? $flipbox_image['url'] : $flipbox_image_url;
							?>
							<?php if ( $flipbox_image_url ) { ?>
								<img src="<?php echo esc_url( $flipbox_image_url ); ?>" alt="">
							<?php } ?>
						<?php } ?>
					</div>

					<h3 class="pp-flipbox-heading">
						<?php echo esc_html__( $settings['title_front'], 'flip-box' ); ?>
					</h3>

					<div class="pp-flipbox-content">
						<?php echo __( $settings['description_front'], 'flip-box' ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	protected function render_back() {
		$settings = $this->get_settings();

		$pp_title_html_tag = 'h3';

		$this->add_render_attribute( 'title-container', 'class', 'pp-flipbox-heading' );

		$flipbox_image_back     = $settings['icon_image_back'];
		$flipbox_back_image_url = Group_Control_Image_Size::get_attachment_image_src( $flipbox_image_back['id'], 'thumbnail_back', $settings );
		$flipbox_back_image_url = ( empty( $flipbox_back_image_url ) ) ? $flipbox_image_back['url'] : $flipbox_back_image_url;

		if ( $settings['icon_type_back'] != 'none' ) {
			if ( 'image' == $settings['icon_type_back'] ) {
				$this->add_render_attribute(
					'icon-image-back',
					[
						'src' => $flipbox_back_image_url,
						'alt' => 'flipbox-image'
					]
				);
			} elseif ( 'icon' == $settings['icon_type_back'] ) {
				$this->add_render_attribute(
					'icon-back',
					[
						'class'       => $settings['icon_back'],
						'aria-hidden' => 'true'
					]
				);
			}
		}

		if ( $settings['link_type'] != 'none' ) {
			if ( ! empty( $settings['link']['url'] ) ) {
				if ( $settings['link_type'] == 'title' ) {
					$pp_title_html_tag = 'a';

					$this->add_render_attribute(
						'title-container',
						[
							'class' => 'pp-flipbox-linked-title',
							'href'  => $settings['link']['url']
						]
					);

					if ( $settings['link']['is_external'] ) {
						$this->add_render_attribute( 'title-container', 'target', '_blank' );
					}

					if ( $settings['link']['nofollow'] ) {
						$this->add_render_attribute( 'title-container', 'rel', 'nofollow' );
					}
				} elseif ( $settings['link_type'] == 'button' ) {
					$this->add_render_attribute(
						'button',
						[
							'class' => [
								'elementor-button',
								'pp-flipbox-button',
								'elementor-size-' . $settings['button_size'],
							],
							'href'  => $settings['link']['url']
						]
					);

					if ( $settings['link']['is_external'] ) {
						$this->add_render_attribute( 'button', 'target', '_blank' );
					}

					if ( $settings['link']['nofollow'] ) {
						$this->add_render_attribute( 'button', 'rel', 'nofollow' );
					}
				}
			}
		}
		?>
		<div class="pp-flipbox-back">
			<div class="flipbox-close">
				<a href="#"><i class="fa fa-times"></i></a>
			</div>
			<?php
			if ( $settings['link_type'] == 'box' && $settings['link']['url'] != '' ) {
				$this->add_render_attribute(
					'box-link',
					[
						'class' => 'pp-flipbox-box-link',
						'href'  => $settings['link']['url']
					]
				);

				if ( $settings['link']['is_external'] ) {
					$this->add_render_attribute( 'box-link', 'target', '_blank' );
				}

				if ( $settings['link']['nofollow'] ) {
					$this->add_render_attribute( 'box-link', 'rel', 'nofollow' );
				}
				?>
				<a <?php echo $this->get_render_attribute_string( 'box-link' ); ?>></a>
			<?php } ?>
			<div class="pp-flipbox-overlay">
				<div class="pp-flipbox-inner">
					<?php if ( 'none' != $settings['icon_type_back'] ) { ?>
						<div class="pp-flipbox-icon-image-back">
							<?php if ( 'image' == $settings['icon_type_back'] ) { ?>
								<img <?php echo $this->get_render_attribute_string( 'icon-image-back' ); ?>>
							<?php } elseif ( 'icon' == $settings['icon_type_back'] ) { ?>
								<i <?php echo $this->get_render_attribute_string( 'icon-back' ); ?>></i>
							<?php } ?>
						</div>
					<?php } ?>

					<?php if ( $settings['title_back'] ) { ?>
					<<?php echo $pp_title_html_tag, ' ', $this->get_render_attribute_string( 'title-container' ); ?>>
					<?php echo esc_html__( $settings['title_back'], 'flip-box' ); ?>
				</<?php echo $pp_title_html_tag; ?>>
				<?php } ?>

				<div class="pp-flipbox-content">
					<?php echo __( $settings['description_back'], 'flip-box' ); ?>
				</div>

				<?php if ( $settings['link_type'] == 'button' && ! empty( $settings['flipbox_button_text'] ) ) : ?>
					<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
						<?php if ( ! empty( $settings['button_icon'] ) && 'before' == $settings['button_icon_position'] ) : ?>
							<i class="<?php echo $settings['button_icon']; ?>"></i>
						<?php endif; ?>
						<?php echo esc_attr( $settings['flipbox_button_text'] ); ?>
						<?php if ( ! empty( $settings['button_icon'] ) && 'after' == $settings['button_icon_position'] ) : ?>
							<i class="<?php echo $settings['button_icon']; ?>"></i>
						<?php endif; ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
		</div>
		<?php
	}

	protected function _content_template() {

	}

}