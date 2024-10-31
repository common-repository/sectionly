<?php
/*
 * @elementor testimonials
 */
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Widget_sectionly_testimonial extends Widget_Base {

    public function get_name() {
        return 'sectionly_testimonial';
    }

    public function get_title() {
        return __('Testimonial', 'sectionly');
    }

    public function get_icon() {
        return 'eicon-blockquote';
    }

    public function get_categories() {
        return ['sectionly_elementor'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'basic_services', [
            'label' => esc_html__('Testimonials', 'sectionly'),
                ]
        );

        $testimonial_repeater = new \Elementor\Repeater();

        $testimonial_repeater->add_control(
                'testimonial_title', [
            'label' => __('Testimonial Title', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('Enter the testimonial title.', 'sectionly'),
                ]
        );
        
        $testimonial_repeater->add_control(
                'testimonial_pos', [
            'label' => __('Testimonial Position', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('Enter the testimonial position.', 'sectionly'),
                ]
        );

        $testimonial_repeater->add_control(
                'testimonial_img', [
            'label' => __('Testimonial Image', 'sectionly'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $testimonial_repeater->add_control(
                'testimonial_wording', [
            'label' => __('Testimonial words', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 10,
            'default' => '',
            'placeholder' => __('add testimonial wording here', 'sectionly'),
                ]
        );

        $this->add_control(
                'testimonial_list', [
            'label' => __('Testimonial List', 'sectionly'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $testimonial_repeater->get_controls(),
            'title_field' => '{{{ testimonial_title }}}',
                ]
        );


        $this->end_controls_section();
    }

    protected function render() {

        $sectionly_settings = $this->get_settings_for_display(); // get settings fields        
        $sectionly_settings['elementor'] = true;
        echo sectionly_our_testimonials_shortcode($sectionly_settings);
        
    }

}