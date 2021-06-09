<?php
namespace Elementor;

class MY_Elementor_Slider extends Widget_Base {

    public function get_name() {
        return  'my_slider';
    }

    public function get_title() {
        return esc_html__( 'MMI Slider', 'majharul_islam' );
    }

    public function get_script_depends() {
        return [
            'myew-script'
        ];
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_categories() {
        return [ 'my_catagory' ];
    }


    public function _register_controls() {

        // Slider content
        $this->start_controls_section(
            'slider_content_section',
            [
                'label' => __( 'Slider Content', 'MMI Addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'slider_title', [
                'label' => __( 'Slider Title', 'majharul_islam' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Title#1' , 'majharul_islam' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slider_content', [
                'label' => __( 'Slider Content', 'majharul_islam' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Slider Content Here' , 'majharul_islam' ),
                'show_label' => true,
            ]
        );

        $repeater->add_control(
            'slider_btn', [
                'label' => __( 'Slider Button Text', 'majharul_islam' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Learn More' , 'majharul_islam' ),
                'show_label' => true,
            ]
        );

        $repeater->add_control(
            'slider_btn_link',
            [
                'label' => __( 'Button Link', 'majharul_islam' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'majharul_islam' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'slider_img',
            [
                'label' => __( 'Choose Image', 'majharul_islam' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'slider_list',
            [
                'label' => __( 'Slider List', 'majharul_islam' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slider_title' => __( 'Title #1', 'majharul_islam' ),
                    ],
                    [
                        'slider_title' => __( 'Title #2', 'majharul_islam' ),
                    ],
                ],
                'title_field' => '{{{ slider_title }}}',
            ]
        );

        $this->end_controls_section();


        // Slider Settings
        $this->start_controls_section(
            'slider_setting_section',
            [
                'label' => __( 'Slider Option', 'MMI Addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Slide item show
        $this->add_control(
            'view_slide_items',
            [
                'label' => __( 'Slide Item', 'majharul_islam' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '1', 'majharul_islam' ),
            ]
        );

        // Show loop
        $this->add_control(
            'slider_loop',
            [
                'label' => __( 'Loop', 'majharul_islam' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'MMI Addons' ),
                'label_off' => __( 'Hide', 'MMI Addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // show Dots
        $this->add_control(
            'slider_dots',
            [
                'label' => __( 'Dots', 'majharul_islam' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'MMI Addons' ), 
                'label_off' => __( 'Hide', 'MMI Addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // Slide Autoplay
        $this->add_control(
            'slide_autoplay',
            [
                'label' => __( 'Autoplay?', 'majharul_islam' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'MMI Addons' ),
                'label_off' => __( 'No', 'MMI Addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // Slide mouse hover pause
        $this->add_control(
            'slider_pause',
            [
                'label' => __( 'Slide Hover Pause', 'majharul_islam' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'MMI Addons' ),
                'label_off' => __( 'No', 'MMI Addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'slide_autoplay' => 'yes',
                ]
            ]
        );

        // Slide Autoplay Speed
        $this->add_control(
            'slider_speed',
            [
                'label' => __( 'Auto Play Time', 'majharul_islam' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '5000', 'majharul_islam' ),
                'condition' => [
                    'slide_autoplay' => 'yes',
                ]
            ]
        );

        // slider setting style option
        $this->add_responsive_control(
            'slider_dot_width',
            [
                'label' => __( 'Slider Dot width', 'majharul_islam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero_slider_area .owl-dots button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_dot_height',
            [
                'label' => __( 'Slider Dot height', 'majharul_islam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero_slider_area .owl-dots button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slide_dot_color',
            [
                'label' => __( 'Dot Color', 'majharul_islam' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_slider_area .owl-dots button' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'slide_dot_active_color',
            [
                'label' => __( 'Dot Active Color', 'majharul_islam' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero_slider_area .owl-dots button.active' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'slide_dot_margin',
            [
                'label' => __( 'Dot Margin', 'majharul_islam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .hero_slider_area .owl-dots button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slide_dot_border_radius',
            [
                'label' => __( 'Dot Border Radius', 'majharul_islam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .hero_slider_area .owl-dots button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Style Tab
        $this->style_tab();
    }

    private function style_tab() {

        // Slider bg section
        $this->start_controls_section(
            'slider_bg',
            [
                'label' => __( 'Slider Background', 'MMI Addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'slide_background',
                'label' => __( 'Background', 'majharul_islam' ),
                'description' => '#253138',
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .hero_slider_area',
            ]
        );

        $this->end_controls_section();

        // Slider Title style Section
        $this->start_controls_section(
            'slider_title_sec',
            [
                'label' => __( 'Title', 'MMI Addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

       $this->add_control(
            'slide_title_color',
            [
                'label' => __( 'Title Color', 'majharul_islam' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single_hero_slider h2' => 'color: {{VALUE}}',
                ],
            ]
        );

       $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'slider_title_typography',
                'label' => __( 'Typography', 'majharul_islam' ),
                'selector' => '{{WRAPPER}} .single_hero_slider h2',
            ]
        );

       $this->add_control(
            'slider_text_align',
            [
                'label' => __( 'Alignment', 'majharul_islam' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'plugin-domain' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'plugin-domain' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'plugin-domain' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
            ]
        );

       $this->add_responsive_control(
            'slide_title_margin',
            [
                'label' => __( 'Margin', 'majharul_islam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .single_hero_slider h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Slider desc style section
        $this->start_controls_section(
            'slider_desc_sec',
            [
                'label' => __( 'Description', 'MMI Addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

       $this->add_control(
            'slide_desc_color',
            [
                'label' => __( 'Description Color', 'majharul_islam' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single_hero_slider p' => 'color: {{VALUE}}',
                ],
            ]
        );

       $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'slider_desc_typography',
                'label' => __( 'Typography', 'majharul_islam' ),
                'selector' => '{{WRAPPER}} .single_hero_slider p',
            ]
        );

       $this->add_control(
            'slider_desc_align',
            [
                'label' => __( 'Alignment', 'majharul_islam' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'plugin-domain' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'plugin-domain' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'plugin-domain' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
            ]
        );

       $this->add_responsive_control(
            'slide_desc_margin',
            [
                'label' => __( 'Margin', 'majharul_islam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .single_hero_slider p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Slider button style section
        $this->start_controls_section(
            'slider_btn_sec',
            [
                'label' => __( 'Button', 'MMI Addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

       $this->add_control(
            'slide_btn_color',
            [
                'label' => __( 'Button Color', 'majharul_islam' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide_content a' => 'color: {{VALUE}}',
                ],
            ]
        );

       $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'slider_btn_typography',
                'label' => __( 'Typography', 'majharul_islam' ),
                'selector' => '{{WRAPPER}} .slide_content a',
            ]
        );

       $this->add_responsive_control(
            'slide_btn_padding',
            [
                'label' => __( 'Padding', 'majharul_islam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .slide_content a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

       $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'slide_btn_border',
                'label' => __( 'Border', 'majharul_islam' ),
                'selector' => '{{WRAPPER}} .slide_content a',
            ]
        );

       $this->add_control(
            'slide_btn_border_radius',
            [
                'label' => __( 'Border Radius', 'majharul_islam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .slide_content a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Slider Image style section
        $this->start_controls_section(
            'slider_img_sec',
            [
                'label' => __( 'Slider Image', 'MMI Addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'slider_img_width',
            [
                'label' => __( 'Width', 'majharul_islam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slide_img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_img_height',
            [
                'label' => __( 'Height', 'majharul_islam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 400,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slide_img img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

    }


    protected function render() {
        $settings = $this->get_settings_for_display();

        if($settings['slider_list']){
            $dynamic_id = rand(78676, 967698);
            if(count($settings['slider_list']) > 1){
                if ($settings['slider_loop'] == 'yes') { 
                    $loop = 'true';
                }
                else{
                    $loop = 'false';
                }
                if ($settings['slider_dots'] == 'yes') { 
                    $slider_dots = 'true';
                }
                else{
                    $slider_dots = 'false';
                }
                if ($settings['slide_autoplay'] == 'yes') { 
                    $slide_autoplay = 'true';
                }
                else{
                    $slide_autoplay = 'false';
                }
                if ($settings['slider_pause'] == 'yes') { 
                    $slider_pause = 'true';
                }
                else{
                    $slider_pause = 'false';
                }
            }
        }

        // Carosel script
        echo '<script>
            jQuery(document).ready(function($) {
              $(".owl-carousel#slider-'.$dynamic_id.'").owlCarousel({
                items:'.$settings['view_slide_items'].',
                loop:'.$loop.',
                nav:false,
                dots:'.$slider_dots.',
                autoplayHoverPause: '.$slider_pause.',
                autoplay:'.$slide_autoplay.',';
                if($slide_autoplay == 'true') {
                    echo 'autoplayTimeout: '.$settings['slider_speed'].'';
                }  

                echo '
              });
            });
        </script>';

    ?>


      <section class="owl-carousel hero_slider_area" id="slider-<?php echo $dynamic_id;?>">

        <?php foreach( $settings[ 'slider_list' ] as $slide_item ) : 
            $slide_btn_target = $slide_item['slider_btn_link']['is_external'] ? ' target="_blank"' : '';
            $slide_btn_nofollow = $slide_item['slider_btn_link']['nofollow'] ? ' rel="nofollow"' : '';
        ?>

        <div class="single_hero_slider">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-md-6 col-sm-6">
                <div class="slide_content">
                  <h2 style="text-align:<?php echo $settings['slider_text_align'];?>"><?php echo $slide_item['slider_title']; ?></h2>
                  <p style="text-align:<?php echo $settings['slider_desc_align'];?>"><?php echo $slide_item['slider_content']; ?></p>
                  <a href="<?php echo $slide_item['slider_btn_link']['url'];?>" <?php echo $slide_btn_target;?> <?php echo $slide_btn_nofollow;?>> <?php echo $slide_item['slider_btn']; ?> <i class="fas fa-angle-right"></i></a>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="slide_img">
                  <img src="<?php echo $slide_item['slider_img']['url']; ?>" alt="slide image">
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php endforeach; ?>
      </section>

        <?php
    }


}
Plugin::instance()->widgets_manager->register_widget_type( new MY_Elementor_Slider() );