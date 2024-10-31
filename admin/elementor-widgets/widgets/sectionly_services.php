<?php
/*
 * @services widgets
 */
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Widget_sectionly_services extends Widget_Base {

    public function get_name() {
        return 'sectionly_services';
    }

    public function get_title() {
        return __('Services', 'sectionly');
    }

    public function get_icon() {
        return 'eicon-icon-box';
    }

    public function get_categories() {
        return ['sectionly_elementor'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'basic_services', [
            'label' => esc_html__('Services List', 'sectionly'),
                ]
        );

        $service_repeater = new \Elementor\Repeater();

        $service_repeater->add_control(
                'services_title', [
            'label' => __('Services Title', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('Enter the services title.', 'sectionly'),
                ]
        );
        
        $service_repeater->add_control(
                'services_img', [
            'label' => __('Services Image', 'sectionly'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
                ]
        );
        
        $service_repeater->add_control(
                'services_description', [
            'label' => __('Services Description', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 10,
            'default' => '',
            'placeholder' => __('add service wording here', 'sectionly'),
                ]
        );
        
        
        $service_repeater->add_control(
                'services_readmore', [
            'label' => __('Read More Link', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('Enter the readmore link.', 'sectionly'),
                ]
        );


        $this->add_control(
                'services_items', [
            'label' => __('Services List', 'sectionly'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $service_repeater->get_controls(),
            'title_field' => '{{{ services_title }}}',
                ]
        );


        $this->end_controls_section();
    }

    protected function render() {

        $sectionly_settings = $this->get_settings_for_display(); // get settings fields        

        $sectionly_settings['elementor'] = true;
        echo sectionly_our_services_shortcode($sectionly_settings);
        
        
    }

}