<?php
/*
 * @ teams Widgets
 */
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Widget_sectionly_teams extends Widget_Base {

    public function get_name() {
        return 'sectionly_teams';
    }

    public function get_title() {
        return __('Our Team', 'sectionly');
    }

    public function get_icon() {
        return 'eicon-user-circle-o';
    }

    public function get_categories() {
        return ['sectionly_elementor'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'basic_services', [
            'label' => esc_html__('Team Members', 'sectionly'),
                ]
        );

        $team_repeater = new \Elementor\Repeater();

        $team_repeater->add_control(
                'team_img', [
            'label' => __('Member Image', 'sectionly'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $team_repeater->add_control(
                'team_title', [
            'label' => __('Member Title', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('Enter the member title.', 'sectionly'),
                ]
        );

        $team_repeater->add_control(
                'team_pos', [
            'label' => __('Member Position', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('Enter the testimonial position.', 'sectionly'),
                ]
        );

        $team_repeater->add_control(
                'team_experience', [
            'label' => __('Member Experience', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('Enter the member experience.', 'sectionly'),
                ]
        );

        $team_repeater->add_control(
                'team_biography', [
            'label' => __('Member Biography', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 10,
            'default' => '',
            'placeholder' => __('add testimonial wording here', 'sectionly'),
                ]
        );

        $team_repeater->add_control(
                'team_fb', [
            'label' => __('Member Facebook', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('Enter the member facebook link.', 'sectionly'),
                ]
        );

        $team_repeater->add_control(
                'team_instagram', [
            'label' => __('Member Instagram', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('Enter the member instagram link.', 'sectionly'),
                ]
        );

        $team_repeater->add_control(
                'team_twitter', [
            'label' => __('Member Twitter', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('Enter the member twitter link.', 'sectionly'),
                ]
        );

        $team_repeater->add_control(
                'team_linkedin', [
            'label' => __('Member Linkedin', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('Enter the member linkedin link.', 'sectionly'),
                ]
        );

        $this->add_control(
                'team_items', [
            'label' => __('Member List', 'sectionly'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $team_repeater->get_controls(),
            'title_field' => '{{{ team_title }}}',
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $sectionly_settings = $this->get_settings_for_display(); // get settings fields        
        $sectionly_settings['elementor'] = true;
        echo sectionly_our_team_shortcode($sectionly_settings);
        
    }

}