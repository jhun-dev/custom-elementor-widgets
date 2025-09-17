<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Lnp_Elementor_Testimonial_Widget extends \Elementor\Widget_Base { 

    public function get_name() {
	    return 'lnp-testimonial';
    }

    /**
     * Get widget title.
     * 
     * Retrieve LNP Testimonial widget title.
     * 
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */

    public function get_title() {
        return esc_html__( 'LNP Testimonial', 'lnp-elementor-widget' );
    }

    	/**
	 * Get widget icon.
	 *
	 * Retrieve LNP Testimonial widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
    public function get_icon() {
        return 'eicon-product-rating';
    }


    /**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
    public function get_custom_help_url() {
        return 'https://elementor.com';
    }


    /**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Testimonial widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
    public function get_categories() {
	    return [ 'general' ];
    }

    /**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the Testimonial widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
    public function get_keywords() {
        return [ 'Testimonial', 'lnp' ];
    }


    /**
	 * Register Testimonial widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	protected function register_controls() {

        //Start of Tab Content Controls

        $this->start_controls_section(
			'testimonial_items',
			[
				'label' => __( 'Testimonial Items', 'lnp-elementor-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'testimonial_layout',
			[
				'label'   => __( 'Testimonial Layout', 'lnp-elementor-widget' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'grid' => __( 'Grid', 'lnp-elementor-widget' ),
					'slider' => __( 'Slider', 'lnp-elementor-widget' ),
					'list' => __( 'List', 'lnp-elementor-widget' ),
				],
				'default' => 'grid',
			]
		);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'avatar',
            [
                'label'       => __( 'Avatar', 'lnp-elementor-widget' ),
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'dynamic'     => [ 'active' => true ],
                'label_block' => true,
                'default'     => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'    => 'avatar',   // MUST match the MEDIA control key
                'default' => 'full',
            ]
        );


        $repeater->add_control(
            'rating',
            [
                'label'   => __( 'Rating', 'lnp-elementor-widget' ),
                'type'    => \Elementor\Controls_Manager::SLIDER,
                'range'   => [
                    'px' => [ 'min' => 0, 'max' => 5, 'step' => 1 ],
                ],
                'default' => [
                    'size' => 5, // no translation here
                    'unit' => 'px',
                ],
                'label_block' => true,
                'dynamic'     => [ 'active' => true ],
            ]
        );

        $repeater->add_control(
			'author',
			[
				'label'       => __( 'Author', 'lnp-elementor-widget' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'John Doe', 'lnp-elementor-widget' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

        $repeater->add_control(
			'position',
			[
				'label'       => __( 'Position', 'lnp-elementor-widget' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'CEO at Company', 'lnp-elementor-widget' ),
				'dynamic'     => [ 'active' => true ],
			]
		);


        $repeater->add_control(
			'testimony',
			[
				'label'       => __( 'Testimony', 'lnp-elementor-widget' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'rows'        => 5,
				'default'     => __( 'Lorem ipsum dolor sit amet, consectetur adip elit. Donec posuere dolor massa, pellentesque aliquam nislon', 'lnp-elementor-widget' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

        $repeater->add_control(
			'date',
			[
				'label'       => __( 'Date', 'lnp-elementor-widget' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'April 1, 2023', 'lnp-elementor-widget' ),
				'dynamic'     => [ 'active' => true ],
			]
		);


        $this->add_control(
			'items',
			[
				'label'       => __( 'Item', 'lnp-elementor-widget' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'rating' => __( 5, 'lnp-elementor-widget' ),
                        'author' => __( 'John Doe', 'lnp-elementor-widget' ),
                        'position' => __( 'CEO at Company', 'lnp-elementor-widget' ),
                        'testimony' => __( 'Lorem ipsum dolor sit amet, consectetur adip elit. Donec posuere dolor massa, pellentesque aliquam nislon', 'lnp-elementor-widget' ),
                        'date' => __( 'April 1, 2023', 'lnp-elementor-widget' ),
					],
					[
						'rating' => __( 5, 'lnp-elementor-widget' ),
                        'author' => __( 'John Doe', 'lnp-elementor-widget' ),
                        'position' => __( 'CEO at Company', 'lnp-elementor-widget' ),
                        'testimony' => __( 'Lorem ipsum dolor sit amet, consectetur adip elit. Donec posuere dolor massa, pellentesque aliquam nislon', 'lnp-elementor-widget' ),
                        'date' => __( 'April 1, 2023', 'lnp-elementor-widget' ),
					],
					[
						'rating' => __( 5, 'lnp-elementor-widget' ),
                        'author' => __( 'John Doe', 'lnp-elementor-widget' ),
                        'position' => __( 'CEO at Company', 'lnp-elementor-widget' ),
                        'testimony' => __( 'Lorem ipsum dolor sit amet, consectetur adip elit. Donec posuere dolor massa, pellentesque aliquam nislon', 'lnp-elementor-widget' ),
                        'date' => __( 'April 1, 2023', 'lnp-elementor-widget' ),
					],
				],
				'title_field' => '{{{ author || "Item"}}}',
			]
		);

        $this->end_controls_section();

		//SLider Settings
        $this->start_controls_section(
			'slider_settings',
			[
				'label' => __( 'Slider Settings', 'lnp-elementor-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [ 'testimonial_layout' => 'slider' ],
			]
		);

		$this->add_responsive_control(
			'slide_to_show',
			[
				'label' => __( 'Slide To Show', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'default' => ['size' => 3],
				'range' => [
					'px' => [ 'min' => 1, 'max' => 12 ],
				]
			]
		);

		$this->add_responsive_control(
			'slide_to_scroll',
			[
				'label' => __( 'Slide To Scroll', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'default' => ['size' => 1],
				'range' => [
					'px' => [ 'min' => 1, 'max' => 12 ],
				]
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label'        => __( 'Show Pagination', 'lnp-elementor-widget' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'lnp-elementor-widget' ),
				'label_off'    => __( 'No', 'lnp-elementor-widget' ),
				'return_value' => 'yes',   // when ON → 'yes', when OFF → ''
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'pagination_type',
			[
				'label'   => __( 'Pagination Type', 'lnp-elementor-widget' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'condition' => [ 'show_pagination' => 'yes' ],
				'options' => [
					'bullets' => __( 'Dots', 'lnp-elementor-widget' ),
					'fraction' => __( 'Fraction', 'lnp-elementor-widget' ),
					'progressbar' => __( 'Progress Bar', 'lnp-elementor-widget' ),
				],
				'default' => 'bullets',
			]
		);

		$this->add_control(
			'show_navigation',
			[
				'label'        => __( 'Show Navigation', 'lnp-elementor-widget' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'lnp-elementor-widget' ),
				'label_off'    => __( 'No', 'lnp-elementor-widget' ),
				'return_value' => 'yes',   // when ON → 'yes', when OFF → ''
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'navigation_icon_prev',
			[
				'label'            => __( 'Prev Icon', 'lnp-elementor-widget' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'condition'        => ['show_navigation'=> 'yes'],
				'fa4compatibility' => 'icon_old', // fallback for FA4 sites
				'default'          => [
					'value'    => 'eicon-angle-left',
					'library'  => 'eicons',
				],
			]
		);

		$this->add_control(
			'navigation_icon_next',
			[
				'label'            => __( 'Next Icon', 'lnp-elementor-widget' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'condition'        => ['show_navigation'=> 'yes'],
				'fa4compatibility' => 'icon_old', // fallback for FA4 sites
				'default'          => [
					'value'    => 'eicon-angle-right',
					'library'  => 'eicons',
				],
			]
		);



		$this->add_control(
            'other_slide_settings',
            [
                'label' => esc_html__( 'Other Settings', 'lnp-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'autoplay',
			[
				'label'        => __( 'Autoplay', 'lnp-elementor-widget' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'lnp-elementor-widget' ),
				'label_off'    => __( 'No', 'lnp-elementor-widget' ),
				'return_value' => 'yes',   // when ON → 'yes', when OFF → ''
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'        => __( 'Pause on Hover', 'lnp-elementor-widget' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'condition' => [ 'autoplay' => 'yes' ],
				'label_on'     => __( 'Yes', 'lnp-elementor-widget' ),
				'label_off'    => __( 'No', 'lnp-elementor-widget' ),
				'return_value' => 'yes',   // when ON → 'yes', when OFF → ''
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'pause_on_interaction',
			[
				'label'        => __( 'Pause on Interaction', 'lnp-elementor-widget' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'condition' => [ 'autoplay' => 'yes' ],
				'label_on'     => __( 'Yes', 'lnp-elementor-widget' ),
				'label_off'    => __( 'No', 'lnp-elementor-widget' ),
				'return_value' => 'yes',   // when ON → 'yes', when OFF → ''
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'       => __( 'Autoplay Speed', 'lnp-elementor-widget' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'condition' => [ 'autoplay' => 'yes' ],
				'min'         => 1,
				'step'        => 1,
				'default'     => 5000,
				'label_block' => false,
			]
		);

		$this->add_control(
			'animation_speed',
			[
				'label'       => __( 'Animation Speed', 'lnp-elementor-widget' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'min'         => 1,
				'step'        => 1,
				'default'     => 500,
				'label_block' => false,
			]
		);

		$this->add_control(
			'infinite_loop',
			[
				'label'        => __( 'Infinite Loop', 'lnp-elementor-widget' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'lnp-elementor-widget' ),
				'label_off'    => __( 'No', 'lnp-elementor-widget' ),
				'return_value' => 'yes',   // when ON → 'yes', when OFF → ''
				'default'      => 'yes',
			]
		);



        $this->end_controls_section();

        //End of Tab Content Controls

        //Start of Tab Style Controls

        //Grid Style
        $this->start_controls_section(
			'grid_style',
			[
				'label' => __( 'Grid Style', 'lnp-elementor-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'testimonial_layout' => 'grid' ],
			]
		);

        $this->add_responsive_control(
			'grid_column',
			[
				'label' => __( 'Grid Column', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'fr' => [ 'min' => 3, 'max' => 12 ],
				],
				'selectors' => [
					'{{WRAPPER}} .lnp-testimonial.grid'     => 'grid-template-columns: repeat({{SIZE}},1fr);',
				],
			]
		);

        $this->add_responsive_control(
			'grid_gap',
			[
				'label' => __( 'Gap', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem','%' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 60 ],
				],
				'selectors' => [
					'{{WRAPPER}} .lnp-testimonial.grid' => 'gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->end_controls_section();

		//Slider Style
        $this->start_controls_section(
			'testimonial_slider_style',
			[
				'label' => __( 'Slider Style', 'lnp-elementor-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [ 'testimonial_layout' => 'slider' ],
			]
		);

		
		$this->end_controls_section();


		//Card Style
        $this->start_controls_section(
			'testimonial_card_style',
			[
				'label' => __( 'Card Style', 'lnp-elementor-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'testimonial_card_spacing',
			[
				'label' => __( 'Spacing', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 60 ],
				],
				'selectors' => [
					'{{WRAPPER}} .lt-item' => 'gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'testimonial_card_border',
				'selector' => '{{WRAPPER}} .lt-item',
			]
		);

		$this->add_responsive_control(
			'testimonial_card_radius',
			[
				'label' => __( 'Border Radius', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .lt-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'testimonial_card_shadow',
				'selector' => '{{WRAPPER}} .lt-item',
			]
		);

		$this->add_responsive_control(
			'testimonial_card_padding',
			[
				'label' => __( 'Padding', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .lt-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Image Style
        $this->start_controls_section(
			'testimonial_image_style',
			[
				'label' => __( 'Image Style', 'lnp-elementor-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'testimonial_image_size',
			[
				'label' => __( 'Size', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem','%' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 60 ],
				],
				'selectors' => [
					'{{WRAPPER}} .lt-meta-avatar' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'testimonial_img_radius',
			[
				'label' => __( 'Border Radius', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .lt-meta-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


        //Typography Style
        $this->start_controls_section(
			'testimonial_typography',
			[
				'label' => __( 'Typography', 'lnp-elementor-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'author_style',
            [
                'label' => esc_html__( 'Author', 'lnp-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'author_color',
			[
				'label' => __( 'Color', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .lnp-testimonial .lt-author'  => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'selector' => '{{WRAPPER}} .lnp-testimonial .lt-author',
            ]
        );


        $this->add_control(
            'position_style',
            [
                'label' => esc_html__( 'Position', 'lnp-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'position_color',
			[
				'label' => __( 'Color', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .lnp-testimonial .lt-position'  => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'position_typography',
                'selector' => '{{WRAPPER}} .lnp-testimonial .lt-position',
            ]
        );

        $this->add_control(
            'testimony_style',
            [
                'label' => esc_html__( 'Testimony', 'lnp-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'testimony_color',
			[
				'label' => __( 'Color', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .lnp-testimonial .lt-testimony'  => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'testimony_typography',
                'selector' => '{{WRAPPER}} .lnp-testimonial .lt-testimony',
            ]
        );

         $this->add_control(
            'date_style',
            [
                'label' => esc_html__( 'Date', 'lnp-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'date_color',
			[
				'label' => __( 'Color', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .lnp-testimonial .lt-date'  => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'selector' => '{{WRAPPER}} .lnp-testimonial .lt-date',
            ]
        );

        $this->end_controls_section();

        //Icon Style
        $this->start_controls_section(
			'rating_style',
			[
				'label' => __( 'Rating Style', 'lnp-elementor-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem','%' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 60 ],
				],
				'selectors' => [
					'{{WRAPPER}} .lnp-testimonial .lt-rating-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);


        $this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'lnp-elementor-widget' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .lnp-testimonial .lt-rating-icon i'  => 'color: {{VALUE}};',
				],
			]
		);


        $this->end_controls_section();
        //End of Tab Style Controls
    }

    /**
	 * Render Testimonial widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
    protected function render() {

        $settings = $this->get_settings_for_display();
        
        // get the individual values of the input
		$widget_id = $this->get_id();

        $items = $settings['items'] ?? [];
		$layout = $settings['testimonial_layout'] ?? 'grid';
		$slide_to_show = $settings['slide_to_show']['size'] ?? [];
		$slide_to_scroll = $settings['slide_to_scroll']['size'] ?? [];
		$show_pagination = $settings['show_pagination'] ?? 'yes';
		$show_navigation = $settings['show_navigation'] ?? 'yes';
		$pagination_type = $settings['pagination_type'] ?? 'bullets';
		$autoplay = $settings['autoplay'] ?? 'yes';
		$pause_on_hover = $settings['pause_on_hover'] ?? 'yes';
		$pause_on_interaction = $settings['pause_on_interaction'] ?? 'yes';
		$infinite_loop = $settings['infinite_loop'] ?? 'yes';
		$autoplay_speed = $settings['autoplay_speed'] ?? 500;
		$animation_speed = $settings['animation_speed'] ?? 500;
		
		$sliderAttrArr = [
			'data-layout'               => $layout,
			'data-slide-to-show'        => (int) $slide_to_show,                   
			'data-slide-to-scroll'      => (int) $slide_to_scroll,                 
			'data-pagination-type'      => $pagination_type,                        
			'data-autoplay'             => $autoplay ,
			'data-pause-on-hover'       => $pause_on_hover ,
			'data-pause-on-interaction' => $pause_on_interaction ,
			'data-infinite-loop'        => $infinite_loop,
			'data-autoplay-speed'        => (int) $autoplay_speed,
			'data-animation-speed'        => (int) $animation_speed,
		];

		$this->add_render_attribute(
			'lnp-testimonial',
			array_merge(
				[
					'class' => [
						'lnp-testimonial',
						$layout,
						($layout === 'slider') ? 'swiper' : '',
					],
					'id'    => 'lnp-timeline-' . $widget_id,
				],
				($layout === 'slider') ? $sliderAttrArr : []
			)
		);




        ?>

            <div <?php echo $this->get_render_attribute_string( 'lnp-testimonial');?>>
				<?php if($layout === 'slider'): ?>
					<div class="swiper-wrapper">
				<?php endif; ?>
                <?php foreach($items as $index => $item): ?>
                    <div class="lt-item <?php echo $layout === 'slider' ? 'swiper-slide' :'';?>">
                        <?php if(! empty( $item['rating']['size'] )):?>
                            <div class="lt-rating">
                                <?php
                                    for ( $i = 1; $i <= 5; $i++ ) :
                                        $filled = ( $i <= $item['rating']['size'] );
                                        $icon   = $filled
                                            ? [ 'value' => 'eicon-star', 'library' => 'eicons' ]   // filled
                                            : [ 'value' => 'eicon-star-o', 'library' => 'eicons' ]; // outline
                                        ?>
                                        <span class="lt-rating-icon" aria-hidden="true">
                                            <?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
                                        </span>
                                    <?php endfor; ?>
                            </div>
                        <?php endif;?>
                        <?php if(! empty( $item['testimony'] )):?>
                            <div class="lt-testimony"><?php echo $item['testimony']; ?></div>
                        <?php endif;?>
                        <?php if(! empty( $item['author'] ) || ! empty( $item['avatar']['url'] ) || ! empty( $item['position'] ) || ! empty( $item['date'] )):?>
                            <div class="lt-meta">
                                <div class="lt-meta-author-info">
                                    <img src="<?php echo esc_url($item['avatar']['url']) ?>" alt="Author avatar" class="lt-meta-avatar">
                                    <div class="lt-author-wrapper">
                                        <?php if(! empty( $item['author'] )): ?>
                                            <h3 class="lt-author"><?php echo $item['author']; ?></h3>
                                        <?php endif; ?>
                                        <?php if(! empty( $item['position'] )): ?>
                                            <p class="lt-position"><?php echo $item['position']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="lt-meta-date">
                                    <?php if (! empty( $item['date'] )): ?>
                                        <p class="lt-date"><?php echo $item['date'];?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif;?>
                    </div>
                <?php endforeach;?>
				<?php if($layout === 'slider'): ?>
					</div>
				<?php endif; ?>
				<?php if($show_navigation === 'yes' && $layout === 'slider') : ?>
					<div class="slider-button-prev slider-arrow">
						<?php \Elementor\Icons_Manager::render_icon( $settings['navigation_icon_prev'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
					<div class="slider-button-next slider-arrow">
						<?php \Elementor\Icons_Manager::render_icon( $settings['navigation_icon_next'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
				<?php endif; ?>
				<?php if($show_pagination === 'yes' && $layout === 'slider') : ?>
					<div class="swiper-pagination"></div>
				<?php endif; ?>
            </div>


        <?php

    }

	/**
	 * Get Script JS.
	 *
	 * Add JS Dependencies to lnp Timeline.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_script_depends() {
    	return [ 'lnp-testimonial-js' ];
	}

    /**
	 * Get Style CSS.
	 *
	 * Add CSS Dependencies to lnp Testimonial.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_style_depends() {
    	return [ 'lnp-testimonial-css','swiper' ];
	}


 }