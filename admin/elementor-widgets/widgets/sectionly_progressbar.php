<?php
/*
 * @ testimonial elementor widget
 */
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Widget_sectionly_progressbar extends Widget_Base {

    public function get_name() {
        return 'sectionly_progressbar';
    }

    public function get_title() {
        return __('Progressbar', 'sectionly');
    }

    public function get_icon() {
        return 'eicon-progress-tracker';
    }

    public function get_categories() {
        return ['sectionly_elementor'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'basic_services', [
            'label' => esc_html__('Progress Bars', 'sectionly'),
                ]
        );

        $progressbar_repeater = new \Elementor\Repeater();

        $progressbar_repeater->add_control(
                'progressbar_title', [
            'label' => __('Progressbar Title', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('Enter the progressbar title.', 'sectionly'),
                ]
        );

        $progressbar_repeater->add_control(
                'progressbar_perc', [
            'label' => __('Progressbar Percentage', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('should be integer value.', 'sectionly'),
                ]
        );

        $this->add_control(
                'progressbar_items', [
            'label' => __('Progressbar List', 'sectionly'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $progressbar_repeater->get_controls(),
            'title_field' => '{{{ progressbar_title }}}',
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $sectionly_settings = $this->get_settings_for_display(); // get settings fields        

        $sectionly_settings['elementor'] = true;
        echo sectionly_our_progressbars_shortcode($sectionly_settings);
    }

}