<?php
/*
 * @elementor widgets structure
 * 
 */

if (!defined('ABSPATH'))
    exit;

class Sectionly_Elementor {

    private static $instance = null;

    public static function get_instance() {

        define('SECTIONLY_ELEMENTOR_DIR', plugin_dir_url(__DIR__));
        define('SECTIONLY_ELEMENTOR_URL', plugin_dir_url(__FILE__));

        if (!self::$instance)
            self::$instance = new self;
        return self::$instance;
    }

    public function init() {
        
        add_action('elementor/init', array($this, 'sectionly_widgets_registered'));        
        add_action('elementor/elements/categories_registered', array($this, 'sectionly_elementor_register_widgets_sections'));
        
    }

    public function sectionly_widgets_registered() {

        if (defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')) {

            if (class_exists('Elementor\Plugin') && class_exists('Elementor\Widget_Base')) {
                if (is_callable('Elementor\Plugin', 'instance')) {
                    $elementor = Elementor\Plugin::instance();
                    if (isset($elementor->widgets_manager)) {
                        if (method_exists($elementor->widgets_manager, 'register_widget_type')) {
                            $widgets_file_paths = plugin_dir_path(__FILE__) . "widgets/";
                            $sectionly_elementor_widgets = array_diff(scandir($widgets_file_paths), array('.', '..'));
                            foreach ($sectionly_elementor_widgets as $widget_filename) {
                                $widget_file = "widgets/{$widget_filename}";
                                $template_file = locate_template($widget_file);
                                if (!$template_file || !is_readable($template_file)) {
                                    $template_file = plugin_dir_path(__FILE__) . 'widgets/' . $widget_filename;
                                }
                                if ($template_file && is_readable($template_file)) {
                                    require_once $template_file;
                                }
                                $reg_class_name = str_replace('.php', '', $widget_filename);
                                $reg_file_name = "Elementor\Widget_{$reg_class_name}";
                                Elementor\Plugin::instance()->widgets_manager->register_widget_type(new $reg_file_name);
                            }
                        }
                    }
                }
            }
        }
    }

    public function sectionly_elementor_register_widgets_sections($category_manager) {
        $category_manager->add_category(
                'sectionly_elementor', [
            'title' => __('Sectionly Widgets', 'sectionly'),
            'icon' => 'fa fa-home',
                ]
        );
    }

}

Sectionly_Elementor::get_instance()->init();