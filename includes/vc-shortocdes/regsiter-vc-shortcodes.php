<?php

/**
 * visual composer shortcodes mapping
 * @config
 */
/**
 * list all hooks adding
 * @return hooks
 */
add_action('vc_before_init', 'sectionly_vc_our_team_shortcode');
add_action('vc_before_init', 'sectionly_vc_our_testimonial_shortcode');
add_action('vc_before_init', 'sectionly_vc_services_shortcode');
add_action('vc_before_init', 'sectionly_vc_progressbar_shortcode');
add_action('vc_before_init', 'sectionly_vc_blog_shortcode');

/**
 * adding blog shortcode
 * @return markup
 */
function sectionly_vc_blog_shortcode()
{
    $categories = get_categories(array(
        'orderby' => 'name',
    ));

    $cate_array = array(esc_html__("Select Category", "sectionly") => '');
    if (is_array($categories) && sizeof($categories) > 0) {
        foreach ($categories as $category) {
            $cate_array[$category->cat_name] = $category->slug;
        }
    }

    $attributes = array(
        "name" => esc_html__("Blog", "sectionly"),
        "base" => "sectionly_blogs",
        "class" => "",
        "category" => esc_html__("Sectionly Shortcodes", "sectionly"),
        "params" => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__("Category", "sectionly"),
                'param_name' => 'blog_cat',
                'value' => $cate_array,
                'description' => esc_html__("Select Category.", "sectionly")
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__("Content Length", "sectionly"),
                'param_name' => 'blog_excerpt',
                'value' => '20',
                'description' => esc_html__("Set number of words you want show for post content.", "sectionly")
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__("Order", "sectionly"),
                'param_name' => 'blog_order',
                'value' => array(
                    esc_html__("Descending", "sectionly") => 'DESC',
                    esc_html__("Ascending", "sectionly") => 'ASC',
                ),
                'description' => esc_html__("Choose blog list items order.", "sectionly")
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__("Orderby", "sectionly"),
                'param_name' => 'blog_orderby',
                'value' => array(
                    esc_html__("Date", "sectionly") => 'date',
                    esc_html__("Title", "sectionly") => 'title',
                ),
                'description' => esc_html__("Choose blog list items orderby.", "sectionly")
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__("Posts per Page", "sectionly"),
                'param_name' => 'blog_per_page',
                'value' => '10',
                'description' => esc_html__("Set number that how much posts you want to show per page. Leave it blank for all posts on a single page.", "sectionly")
            )
        )
    );

    if (function_exists('vc_map')) {
        vc_map($attributes);
    }
}



/**
 * Our Testimonial shortcode
 * @return
 */
function sectionly_vc_progressbar_shortcode() {

    $attributes = array(
        "name" => esc_html__("Progressbar", "sectionly"),
        "base" => "sectionly_progressbar",
        "category" => esc_html__("Sectionly Shortcodes", "sectionly"),
        "params" => array(
            array
                (
                'group' => __('Progress Bars', 'adforest'),
                'type' => 'param_group',
                'heading' => __('Progress Bars', 'adforest'),
                'param_name' => 'progressbar_items',
                'value' => '',
                'params' => array
                    (
                    array(
                        "type" => "textfield",
                        "heading" => __("Progressbar Title", "sectionly"),
                        "param_name" => 'progressbar_title',
                        'value' => '',
                        "admin_label" => true,
                        "description" => ''
                    ),
                    
                    array(
                        "type" => "textfield",
                        "heading" => __("Progressbar Percentage", "sectionly"),
                        "param_name" => 'progressbar_perc',
                        'value' => '',
                        "description" => __("should be integer value", "sectionly"),
                    ),
                )
            ),
        ),
    );

    if (function_exists('vc_map')) {
        vc_map($attributes);
    }
}



/**
 * Our Testimonial shortcode
 * @return
 */
function sectionly_vc_services_shortcode() {

    $attributes = array(
        "name" => esc_html__("Services", "sectionly"),
        "base" => "sectionly_services",
        "category" => esc_html__("Sectionly Shortcodes", "sectionly"),
        "params" => array(
            array
                (
                'group' => __('Services', 'adforest'),
                'type' => 'param_group',
                'heading' => __('Services', 'adforest'),
                'param_name' => 'services_items',
                'value' => '',
                'params' => array
                    (
                    array(
                        "type" => "textfield",
                        "heading" => __("Services Title", "sectionly"),
                        "param_name" => 'services_title',
                        'value' => '',
                        "admin_label" => true,
                        "description" => ''
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Services Image", "sectionly"),
                        "param_name" => "services_img",
                        'value' => '',
                        "description" => ''
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => __("Services Description", "sectionly"),
                        "param_name" => "services_description",
                        'value' => '',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Read More Link", "sectionly"),
                        "param_name" => 'services_readmore',
                        'value' => '',
                        "description" => ''
                    ),
                )
            ),
        ),
    );

    if (function_exists('vc_map')) {
        vc_map($attributes);
    }
}

/**
 * Our Testimonial shortcode
 * @return
 */
function sectionly_vc_our_testimonial_shortcode() {

    $attributes = array(
        "name" => esc_html__("Testimonials", "sectionly"),
        "base" => "sectionly_our_testimonials",
        "category" => esc_html__("Sectionly Shortcodes", "sectionly"),
        "params" => array(
            array
                (
                'group' => __('Testimonials', 'adforest'),
                'type' => 'param_group',
                'heading' => __('Testimonials', 'adforest'),
                'param_name' => 'testimonial_items',
                'value' => '',
                'params' => array
                    (
                    array(
                        "type" => "textfield",
                        "heading" => __("Testimonial Title", "sectionly"),
                        "param_name" => 'testimonial_title',
                        'value' => '',
                        "admin_label" => true,
                        "description" => ''
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Testimonial Position", "sectionly"),
                        "param_name" => "testimonial_pos",
                        'value' => '',
                        "description" => ''
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Testimonial Image", "sectionly"),
                        "param_name" => "testimonial_img",
                        'value' => '',
                        "description" => ''
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => __("Testimonial wording", "sectionly"),
                        "param_name" => "testimonial_wording",
                        'value' => '',
                    )
                )
            ),
        ),
    );

    if (function_exists('vc_map')) {
        vc_map($attributes);
    }
}

/**
 * Our Team shortcode
 * @return
 */
function sectionly_vc_our_team_shortcode() {

    $attributes = array(
        "name" => esc_html__("Our Team", "sectionly"),
        "base" => "sectionly_our_team",
        "category" => esc_html__("Sectionly Shortcodes", "sectionly"),
        "params" => array(
            array
                (
                'group' => __('Team', 'adforest'),
                'type' => 'param_group',
                'heading' => __('Teams & Members', 'adforest'),
                'param_name' => 'team_items',
                'value' => '',
                'params' => array
                    (
                    array(
                        "type" => "attach_image",
                        "heading" => __("Member Image", "sectionly"),
                        "param_name" => "team_img",
                        'value' => '',
                        "description" => ''
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Member Title", "sectionly"),
                        "param_name" => 'team_title',
                        'value' => '',
                        "admin_label" => true,
                        "description" => ''
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Member Position", "sectionly"),
                        "param_name" => "team_pos",
                        'value' => '',
                        "description" => ''
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Member Experience", "sectionly"),
                        "param_name" => "team_experience",
                        'value' => '',
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => __("Member Biography", "sectionly"),
                        "param_name" => "team_biography",
                        'value' => '',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Member Facebook", "sectionly"),
                        "param_name" => "team_fb",
                        'value' => '',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Member Instagram", "sectionly"),
                        "param_name" => "team_instagram",
                        'value' => '',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Member Twitter", "sectionly"),
                        "param_name" => "team_twitter",
                        'value' => '',
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Member LinkedIn", "sectionly"),
                        "param_name" => "team_linkedin",
                        'value' => '',
                    ),
                )
            ),
        ),
    );

    if (function_exists('vc_map')) {
        vc_map($attributes);
    }
}