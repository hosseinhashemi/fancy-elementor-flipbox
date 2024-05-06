<?php
namespace FancyElementorFlipbox\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Fancy Flipbox
 *
 * Elementor widget for Elementor Fancy Flipbox.
 *
 * @since 1.0.0
 */
class Fancy_Elementor_Flipbox extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'fancy-elementor-flipbox';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Fancy Elementor Flipbox', 'fancy-elementor-flipbox' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-flip-box';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	// public function get_categories() {
	// 	return [ 'general-elements' ];
	// }

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'fancy-elementor-flipbox' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {


		$this->start_controls_section(
			'section_type',
			[
				'label' => esc_html__( 'FlipBox Type', 'fancy-elementor-flipbox' ),
			]
		);

		$this->add_control(
            'tp_flipbox_style',
            [
                'label' => esc_html__('Style', 'fancy-elementor-flipbox'),
                'type' => Controls_Manager::SELECT,
                'default' => 'flip-box-style',
                'options' => [
                    'flip-box-style'      => esc_html__('Flip Box',          'fancy-elementor-flipbox'),
                    'rotate-box-style'    => esc_html__('Rotate Style',      'fancy-elementor-flipbox'),
                    'zoomin-box-style'    => esc_html__('Zoom In Style',     'fancy-elementor-flipbox'),
                    'zoomout-box-style'   => esc_html__('Zoom Out Style',    'fancy-elementor-flipbox'),
                    'side-right-style'    => esc_html__('Right Side Style',  'fancy-elementor-flipbox'),
                    'side-left-style'     => esc_html__('Left Side Style',   'fancy-elementor-flipbox'),
                    'to-top-style'        => esc_html__('To Top Style',      'fancy-elementor-flipbox'),
                    'to-bottom-style'     => esc_html__('To Bottom Style',   'fancy-elementor-flipbox'),
                    'fade-style'          => esc_html__('Fade Out Style',    'fancy-elementor-flipbox'),
								],
						]
		);


		$this->add_control(
    		'tp_flipbox_type',
		    [
		        'label' => esc_html__( 'Filp Box Type', 'fancy-elementor-flipbox' ),
		        'type' => Controls_Manager::CHOOSE,
						'default'     => esc_html__( 'vertical', 'fancy-elementor-flipbox' ),
		        'options' => [
		            'horizontal'    => [
		                'title' => esc_html__( 'Horizontal', 'fancy-elementor-flipbox' ),
		                'icon' => 'eicon-spacer',
		            ],
		            'vertical' => [
		                'title' => esc_html__( 'Vertical', 'fancy-elementor-flipbox' ),
		                'icon' => 'eicon-v-align-stretch',
		            ]
		        ],
				'condition' => [
					'tp_flipbox_style' => 'flip-box-style',
				],
		    ]
		);

		$this->add_control(
			'tp_flipbox_type-min-height',
			[
				'label' => esc_html__( 'Min Height', 'fancy-elementor-flipbox' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => 'Unit in px',
				'selectors' => [
					'{{WRAPPER}} .tp-flipbox__holder ' => 'height: {{VALUE}}px;',
				],
			]
		);

		$this->add_control(
			'padding',
			[
				'label' => esc_html__( 'Padding', 'fancy-elementor-flipbox' ),
				'type' => 'dimensions',
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tp-flipbox__front' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tp-flipbox__back' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			'box-shadow',
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .tp-flipbox__back, {{WRAPPER}} .tp-flipbox__front',
			]
		);

		$this->add_control(
			'tp_flipbox_border_color',
			[
				'label' => esc_html__( 'Color', 'fancy-elementor-flipbox' ),
				'type' => 'color',
				'selectors' => [
					'{{WRAPPER}}  .tp-flipbox__front' => 'border-color: {{VALUE}};',
					'{{WRAPPER}}  .tp-flipbox__back' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			'border',
			[
				'name' => 'border',
				'placeholder' => '1px',
				'exclude' => [ 'color' ],
				'fields_options' => [
					'width' => [
						'label' => esc_html__( 'Border Width', 'fancy-elementor-flipbox' ),
					],
				],
				'selector' => '{{WRAPPER}} .tp-flipbox__back, {{WRAPPER}} .tp-flipbox__front',
			]
		);

		$this->add_control(
			'tp_flipbox_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'fancy-elementor-flipbox' ),
				'type' => 'dimensions',
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .tp-flipbox__front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tp-flipbox__back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();






		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Background & Colors', 'fancy-elementor-flipbox' ),
			]
		);




		$this->add_control(
			'tp_flipbox_f_icon',
			[
				 'label' => esc_html__( 'Front Side Image Icon', 'fancy-elementor-flipbox' ),
				 'type' => Controls_Manager::MEDIA
			]
		);

		$this->add_control(
			'tp_flipbox_f_bg_img',
			[
				 'label' => esc_html__( 'Front Side Image background', 'fancy-elementor-flipbox' ),
				 'type' => Controls_Manager::MEDIA,
				 'dynamic' => [
						'active' => true,
				 ],
				 'selectors' => [
 					'{{WRAPPER}} .tp-flipbox__front' => 'background-image: url({{URL}});',
 				]
			]
		);

		$this->add_control(
			'tp_flipbox_f_bg_color',
			[
				'label' => esc_html__( 'Front Side Background Color', 'fancy-elementor-flipbox' ),
				'default' => '#52ffaf',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-flipbox__front' => 'background-color: {{VALUE}};',
				]
			]

		);













		$this->add_control(
		  'tp_flipbox_b_icon',
		  [
		     'label' => esc_html__( 'Back Side Image Icon', 'fancy-elementor-flipbox' ),
		     'type' => Controls_Manager::MEDIA
		  ]
		);

		$this->add_control(
		  'tp_flipbox_b_bg_img',
		  [
		     'label' => esc_html__( 'Back Side Image background', 'fancy-elementor-flipbox' ),
			 'type' => Controls_Manager::MEDIA,
			 'dynamic' => [
				'active' => true,
		 		],
				 'selectors' => [
 					'{{WRAPPER}} .tp-flipbox__back' => 'background-image:url({{URL}});',
 				]
		  ]
		);

		$this->add_control(
		  'tp_flipbox_b_bg_color',
		  [
		    'label' => esc_html__( 'Back Side Background Color', 'fancy-elementor-flipbox' ),
				'default' => '#ee8cff',
		    'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-flipbox__back' => 'background-color: {{VALUE}};',
				]
		  ]
		);




		$this->end_controls_section();


		/*
		Title & Contents
		----------------------------------------------------------------------------
		*/
				$this->start_controls_section(
					'section_texts',
					[
						'label' => esc_html__( 'Title & Contents', 'fancy-elementor-flipbox' ),
					]
				);


				$this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'Title HTML Tag', 'fancy-elementor-flipbox' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1'   => esc_html__( 'H1',   'fancy-elementor-flipbox' ),
                    'h2'   => esc_html__( 'H2',   'fancy-elementor-flipbox' ),
                    'h3'   => esc_html__( 'H3',   'fancy-elementor-flipbox' ),
                    'h4'   => esc_html__( 'H4',   'fancy-elementor-flipbox' ),
                    'h5'   => esc_html__( 'H5',   'fancy-elementor-flipbox' ),
                    'h6'   => esc_html__( 'H6',   'fancy-elementor-flipbox' ),
                    'div'  => esc_html__( 'div',  'fancy-elementor-flipbox' ),
                    'span' => esc_html__( 'Span', 'fancy-elementor-flipbox' ),
                ],
                'default' => 'div',
            ]
        );


				$this->add_control(
            'content_tag',
            [
                'label' => esc_html__( 'Description HTML Tag', 'fancy-elementor-flipbox' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'div'  => esc_html__( 'div',  'fancy-elementor-flipbox' ),
                    'span' => esc_html__( 'Span', 'fancy-elementor-flipbox' ),
                    'p'    => esc_html__( 'P',    'fancy-elementor-flipbox' ),
                ],
                'default' => 'div',
            ]
        );


				$this->add_control(
					'tp_flipbox_f_title',
					[
						'label' => esc_html__( 'Front Side Title', 'fancy-elementor-flipbox' ),
						'type' => Controls_Manager::TEXT,
						'dynamic' => [
							'active' => true,
					 	],
						'default'     => esc_html__( 'We Are So Glad You Are Here', 'fancy-elementor-flipbox' ),
				 'placeholder' => esc_html__( 'Please enter the flipbox front title', 'fancy-elementor-flipbox' ),
					]
				);

				$this->add_control(
					'tp_flipbox_f_desc',
					[
						'label' => esc_html__( 'Front Side Description', 'fancy-elementor-flipbox' ),
						'type' => Controls_Manager::TEXTAREA,
						'default'     => esc_html__( 'Hover Me Please, to check the back side', 'fancy-elementor-flipbox' ),
						'dynamic' => [
							'active' => true,
					 	],
						'placeholder' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ultricies sem lorem, non ullamcorper neque tincidunt id.', 'fancy-elementor-flipbox' ),
					]
				);

				$this->add_control(
				  'tp_flipbox_b_title',
				  [
				    'label' => esc_html__( 'Back Side Title', 'fancy-elementor-flipbox' ),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					 ],
				    'default'     => esc_html__( 'Contact Us', 'fancy-elementor-flipbox' ),
				 'placeholder' => esc_html__( 'Please enter the flipbox front title', 'fancy-elementor-flipbox' ),
				  ]
				);

				$this->add_control(
				  'tp_flipbox_b_desc',
				  [
				    'label' => esc_html__( 'Back Side Description', 'fancy-elementor-flipbox' ),
					'type' => Controls_Manager::TEXTAREA,
					'dynamic' => [
						'active' => true,
					 ],
				    'default'     => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ultricies sem lorem, non ullamcorper neque tincidunt id.', 'fancy-elementor-flipbox' ),
				    'placeholder' => esc_html__( 'Please enter the flipbox back description', 'fancy-elementor-flipbox' ),
				  ]
				);


$this->end_controls_section();



/*
Typography tab
================================================================================
*/
		$this->start_controls_section(
			'section_typo',
			[
				'label' => esc_html__( 'Typography', 'fancy-elementor-flipbox' ),
			]
		);

		$this->add_group_control(			//Add group control to perform typography for button2.

			Group_Control_Typography::get_type(),
			[
				'name' => 'tp_flipbox_f_title_typo',
				'label' => esc_html__( 'Front Side Title Typography', 'fancy-elementor-flipbox' ),
				'selector' => '{{WRAPPER}} .tp-flipbox__title-front',
			]
		);



		$this->add_group_control(			//Add group control to perform typography for button2.

			Group_Control_Typography::get_type(),
			[
				'name' => 'tp_flipbox_f_desc_typo',
				'label' => esc_html__( 'Front Side Description Typography', 'fancy-elementor-flipbox' ),
				'selector' => '{{WRAPPER}} .tp-flipbox__desc-front',
			]
		);

		$this->add_group_control(			//Add group control to perform typography for button2.

			Group_Control_Typography::get_type(),
			[
				'name' => 'tp_flipbox_b_title_typo',
				'label' => esc_html__( 'Back Side Title Typography', 'fancy-elementor-flipbox' ),
				'selector' => '{{WRAPPER}} .tp-flipbox__title-back',
			]
		);


		$this->add_group_control(			//Add group control to perform typography for button2.

			Group_Control_Typography::get_type(),
			[
				'name' => 'tp_flipbox_b_desc_typo',
				'label' => esc_html__( 'Back Side Description Typography', 'fancy-elementor-flipbox' ),
				'selector' => '{{WRAPPER}} .tp-flipbox__desc-back',
			]
		);


$this->end_controls_section();

/*
color tab
================================================================================
*/
		$this->start_controls_section(
			'section_color',
			[
				'label' => esc_html__( 'Texts Colors', 'fancy-elementor-flipbox' ),
			]
		);

		$this->add_control(
			'tp_flipbox_f_title_color',
			[
				'label' => esc_html__( 'Front Side Title color', 'fancy-elementor-flipbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-flipbox__title-front ' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'tp_flipbox_f_desc_color',
			[
				'label' => esc_html__( 'Front Side Description color', 'fancy-elementor-flipbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-flipbox__desc-front ' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'tp_flipbox_b_title_color',
			[
				'label' => esc_html__( 'Back Side Title color', 'fancy-elementor-flipbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-flipbox__title-back ' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'tp_flipbox_b_desc_color',
			[
				'label' => esc_html__( 'Back Side Description color', 'fancy-elementor-flipbox' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-flipbox__desc-back ' => 'color: {{VALUE}};',
				]
			]
		);


			$this->end_controls_section();

			/*
			Button settings tab
			================================================================================
			*/

			$this->start_controls_section(
				'section_button',
				[
					'label' => esc_html__( 'Button Settings', 'fancy-elementor-flipbox' ),
				]
			);


			$this->add_control(
						'tp_flipbox_show_btn',
						[
							'label' => esc_html__( 'Show Button?', 'fancy-elementor-flipbox' ),
							'type' => Controls_Manager::SWITCHER,
							'label_on' => esc_html__( 'Show', 'fancy-elementor-flipbox' ),
							'label_off' => esc_html__( 'Hide', 'fancy-elementor-flipbox' ),
							'return_value' => 'yes',
							'default' => 'yes',
						]
					);


					$this->add_control(
					  'tp_flipbox_b_btn_text',
					  [
					    'label' => esc_html__( 'Button Text', 'fancy-elementor-flipbox' ),
					    'type' => Controls_Manager::TEXT,
					    'default'     => esc_html__( 'View All', 'fancy-elementor-flipbox' ),
					 'placeholder' => esc_html__( 'Please enter the flipbox button text', 'fancy-elementor-flipbox' ),
					 'condition' => [
	 					'tp_flipbox_show_btn' => 'yes',
	 				],
					  ]
					);

					$this->add_control(
			  'tp_flipbox_b_btn_url',
			  [
			     'label' => esc_html__( 'Button URL', 'fancy-elementor-flipbox' ),
			     'type' => Controls_Manager::URL,
			     'default' => [
			        'url' => 'http://',
			        'is_external' => '',
			     ],
			     'show_external' => true,
					 'condition' => [
	 					'tp_flipbox_show_btn' => 'yes',
	 				],
			  ]
			);


			$this->add_control(
				'tp_flipbox_b_btn_bg_color',
				[
					'label' => esc_html__( 'Button Background Color', 'fancy-elementor-flipbox' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#f96161',
					'condition' => [
					 'tp_flipbox_show_btn' => 'yes',
				 ],
					'selectors' => [
						'{{WRAPPER}} .tp-flipbox__action a' => 'background-color: {{VALUE}};',
					]
				]
			);


			$this->add_control(
				'tp_flipbox_b_btn_text_color',
				[
					'label' => esc_html__( 'Button Text Color', 'fancy-elementor-flipbox' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ffffff',
					'condition' => [
					 'tp_flipbox_show_btn' => 'yes',
				 ],
					'selectors' => [
						'{{WRAPPER}} .tp-flipbox__action a' => 'color: {{VALUE}};',
					]
				]
			);


			$this->add_control(
				'tp_flipbox_b_btn_bg_color_hover',
				[
					'label' => esc_html__( 'Button Background Color On Hover', 'fancy-elementor-flipbox' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fcb935',
					'condition' => [
					 'tp_flipbox_show_btn' => 'yes',
				 ],
					'selectors' => [
						'{{WRAPPER}} .tp-flipbox__action a:hover' => 'background-color: {{VALUE}} !important;',
					]
				]
			);


			$this->add_control(
				'tp_flipbox_b_btn_text_color_hover',
				[
					'label' => esc_html__( 'Button Text Color On Hover', 'fancy-elementor-flipbox' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#f7f7f7',
					'condition' => [
					 'tp_flipbox_show_btn' => 'yes',
				 ],
					'selectors' => [
						'{{WRAPPER}} .tp-flipbox__action a:hover' => 'color: {{VALUE}};',
					]
				]
			);


$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$tp_bg_img_front =       sanitize_url($settings['tp_flipbox_f_bg_img']['url']);
		$tp_bg_img_back =        sanitize_url($settings['tp_flipbox_b_bg_img']['url']);
		$tp_icon_front =         $settings['tp_flipbox_f_icon'];

		$tp_icon_back =          $settings['tp_flipbox_b_icon'];
		$tp_flipbox_show_btn =   $settings['tp_flipbox_show_btn'];
		$tp_flipbox_f_bg_color = sanitize_hex_color($settings['tp_flipbox_f_bg_color']);

		$tp_icon_front_id =    $tp_icon_front["id"];
		$tp_icon_front_alt =   sanitize_text_field(get_post_meta($tp_icon_front_id, '_wp_attachment_image_alt', TRUE));
		$tp_icon_front_title = sanitize_text_field(get_the_title($tp_icon_front_id));

		$tp_icon_back_id =     $tp_icon_back["id"];
		$tp_icon_back_alt =    sanitize_text_field(get_post_meta($tp_icon_back_id, '_wp_attachment_image_alt', TRUE));
		$tp_icon_back_title =  sanitize_text_field(get_the_title($tp_icon_back_id));


	  echo '<div id="flip-demo-0" class="tp-flipbox '.esc_attr($settings['tp_flipbox_style']).' tp-flipbox--'.esc_attr($settings['tp_flipbox_type']).'" onclick="">';
	  echo '    <div class="tp-flipbox__holder" >';
	  echo '        <div class="tp-flipbox__front" style=" background-color:'.esc_attr($tp_flipbox_f_bg_color).';background-image: url('.esc_url($tp_bg_img_front).');">';

	  echo '            <div class="tp-flipbox__content">';
	  echo '                <div class="tp-flipbox__icon-front">';

	  echo '                    <img alt="'.esc_attr($tp_icon_front_alt).'" title="'. esc_attr($tp_icon_front_title) .'" src="'.esc_url($tp_icon_front['url']).'"/>';

	  echo '                </div>';
	  echo '                <' . esc_html($settings['title_tag']) . ' class="tp-flipbox__title-front">'. esc_html($settings['tp_flipbox_f_title']).'</' . esc_html($settings['title_tag']) . '>';
	  echo '                <' . esc_html($settings['content_tag']) . ' class="tp-flipbox__desc-front">'. sanitize_textarea_field($settings['tp_flipbox_f_desc']).'</' . esc_html($settings['content_tag']) . '>';
	  echo '            </div>';
	  echo '        </div>';
	  echo '        <div class="tp-flipbox__back" style="background-image: url('. esc_url($tp_bg_img_back).');" >';

	  echo '            <div class="tp-flipbox__content">';
		echo '                <div class="tp-flipbox__icon-back">';

	  echo '                    <img alt="'.esc_attr($tp_icon_back_alt).'" title="'. esc_attr($tp_icon_back_title) .'"  src="'.esc_url($tp_icon_back["url"]).'"/>';


	  echo '                </div>';
	  echo '                <' . esc_html($settings['title_tag']) . ' class="tp-flipbox__title-back">'. esc_html($settings['tp_flipbox_b_title']) .'</' . esc_html($settings['title_tag']) . '>';
		echo '                <' . esc_html($settings['content_tag']) . ' class="tp-flipbox__desc-back">'. sanitize_textarea_field($settings['tp_flipbox_b_desc']) .'</' . esc_html($settings['content_tag']) . '>';
		if($tp_flipbox_show_btn == "yes"){
	  echo '               <div class="tp-flipbox__action">';
		$btn_external = "";
		$btn_nofollow = "";
		if( $settings['tp_flipbox_b_btn_url']['is_external'] ) {
			$btn_external = ' target="_blank" ';
		}

		if( $settings['tp_flipbox_b_btn_url']['nofollow'] ) {
			$btn_nofollow = ' rel="nofollow" ';
		}

	  echo '                    <a ' . esc_html($btn_external) . ' ' . esc_html($btn_nofollow) . ' href="'.sanitize_url($settings['tp_flipbox_b_btn_url']['url']).'" class="tp-flipbox__btn">'.esc_html($settings['tp_flipbox_b_btn_text']).'</a>';
	  echo '                   </div>';
	}
	  echo '                </div>';
	  echo '            </div>';

	  echo '        </div>';
	  echo '    </div>';
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
<div class="title">
    {{{ settings.title }}}
</div>


<div id="flip-demo-0" class="tp-flipbox tp-flipbox--{{settings.tp_flipbox_type}} {{settings.tp_flipbox_style}}"
    onclick="">
    <div class="tp-flipbox__holder">
        <div class="tp-flipbox__front">

            <div class="tp-flipbox__content">
                <div class="tp-flipbox__icon-front">

                    <img src="{{settings.tp_flipbox_f_icon.url}}" />


                </div>
                <{{{ settings.title_tag }}} class="tp-flipbox__title-front">{{{ settings.tp_flipbox_f_title }}}
                </{{{ settings.title_tag }}}>
                <{{{ settings.content_tag }}} class="tp-flipbox__desc-front">{{{ settings.tp_flipbox_f_desc }}}
                </{{{ settings.content_tag }}}>
            </div>
        </div>
        <div class="tp-flipbox__back">

            <div class="tp-flipbox__content">
                <div class="tp-flipbox__icon-back">
                    <img src="{{settings.tp_flipbox_b_icon.url}}" />
                </div>
                <{{{ settings.title_tag }}} class="tp-flipbox__title-back">{{{ settings.tp_flipbox_b_title }}}
                </{{{ settings.title_tag }}}>
                <{{{ settings.content_tag }}} class="tp-flipbox__desc-back">{{{ settings.tp_flipbox_b_desc }}}
                </{{{ settings.content_tag }}}>
                <# if ( settings.tp_flipbox_show_btn=='yes' ) { #>
                    <div class="tp-flipbox__action">
                        <a href="{{ settings.tp_flipbox_b_btn_url.url}}"
                            class="tp-flipbox__btn">{{{ settings.tp_flipbox_b_btn_text }}}</a>
                    </div>
                    <# } #>
            </div>
        </div>
    </div>
    <?php
	}
}