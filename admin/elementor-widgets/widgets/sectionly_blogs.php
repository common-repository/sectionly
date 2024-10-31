<?php
/*
 * @elementor blogs
 */

namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Widget_sectionly_blogs extends Widget_Base {

    public function get_name() {
        return 'sectionly_blogs';
    }

    public function get_title() {
        return __('Blogs', 'sectionly');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return ['sectionly_elementor'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
                'basic_services', [
            'label' => esc_html__('Blogs Data', 'sectionly'),
                ]
        );

        $this->add_control(
                'blog_cat', array(
            'label' => __('Category', 'sectionly'),
            'type' => Controls_Manager::SELECT,
            'options' => sectionly_blog_categories(),
            'default' => 'desc',
                )
        );
        
        
        $this->add_control(
                'blog_excerpt', [
            'label' => __('Content Length', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('Set number of words you want show for post content.', 'sectionly'),
                ]
        );
        
        $this->add_control(
                'blog_order', array(
            'label' => __('Order', 'sectionly'),
            'type' => Controls_Manager::SELECT,
            'options' => array(
                'DESC' => __('Descending', 'sectionly'),
                'ASC' => __('Ascending', 'sectionly'),
            ),
            'default' => 'DESC',
                )
        );
        
        $this->add_control(
                'blog_orderby', array(
            'label' => __('Order', 'sectionly'),
            'type' => Controls_Manager::SELECT,
            'options' => array(
                'date' => __('Date', 'sectionly'),
                'title' => __('Title', 'sectionly'),
            ),
            'default' => 'date',
                )
        );
        
        $this->add_control(
                'blog_per_page', [
            'label' => __('Posts per Page', 'sectionly'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => __('should be integer value.', 'sectionly'),
                ]
        );



        $this->end_controls_section();
    }

    protected function render() {

        $sectionly_settings = $this->get_settings_for_display(); // get settings fields        

        $sectionly_settings['elementor'] = true;
        echo sectionly_blog_shortcode($sectionly_settings);
    }

}

function sectionly_blog_categories() {
    
    $categories = get_categories(array(
        'orderby' => 'name',
    ));
    
    $cate_array = array('' => esc_html__("Select Category", "sectionly"));
    if (is_array($categories) && sizeof($categories) > 0) {
        foreach ($categories as $category) {
            $cate_array[$category->slug] = $category->cat_name;
        }
    }
    return $cate_array;
}