<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.bracesol.com
 * @since      1.0.0
 *
 * @package    Sectionly
 * @subpackage Sectionly/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sectionly
 * @subpackage Sectionly/public
 * @author     BraceSol <bracesol.wp@gmail.com>
 */
class Sectionly_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Sectionly_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Sectionly_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_register_style('swiper', plugin_dir_url(__FILE__) . 'css/swiper.css', array(), $this->version, 'all');
        wp_enqueue_style('sectionly-public', plugin_dir_url(__FILE__) . 'css/sectionly-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Sectionly_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Sectionly_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        
        wp_register_script('swiper', plugin_dir_url(__FILE__) . 'js/swiper.js', array(), $this->version, false);
        wp_register_script('jprogress', plugin_dir_url(__FILE__) . 'js/jprogress.js', array(), $this->version, false);        
        wp_enqueue_script('sectionly-public', plugin_dir_url(__FILE__) . 'js/sectionly-public.js', array('jquery','swiper','jprogress'), $this->version, true);
    }

}
