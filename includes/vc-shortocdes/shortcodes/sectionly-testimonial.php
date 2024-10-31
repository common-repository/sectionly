<?php
/**
 * Our Testimonial Shortcode
 * @return html
 */
add_shortcode('sectionly_our_testimonials', 'sectionly_our_testimonials_shortcode');

function sectionly_our_testimonials_shortcode($atts, $content = '') {

    $testimonial_html = '';

    extract(shortcode_atts(array(
        'testimonial_items' => '',
                    ), $atts));


    $elementor_flag = FALSE;
    if (isset($atts['elementor']) && $atts['elementor']) {
        $elementor_flag = TRUE;
    }

    $wp_sec_widget = FALSE;
    
    if ($elementor_flag) {
        $testimonial_list = isset($atts['testimonial_list']) && $atts['testimonial_list'] != '' ? $atts['testimonial_list'] : array();
    } else {
        
        $post = get_post();
        if ($post && preg_match('/vc_row/', $post->post_content)) {

              $testimonial_list = vc_param_group_parse_atts($testimonial_items);
        } else {
            $wp_sec_widget = TRUE;
            $testimonial_list = sectionly_convert_widget_into_arr_data('testimonial_items',$content);
        }
        
    }

    $slider_content = '';
    $slider_thumb = '';

    if (isset($testimonial_list) && !empty($testimonial_list) && is_array($testimonial_list) && count($testimonial_list) > 0) {

        wp_enqueue_script('swiper');
        wp_enqueue_style('swiper');

        foreach ($testimonial_list as $testimonial_item) {

            if (isset($testimonial_item['testimonial_title']) && $testimonial_item['testimonial_title'] != '') {

                $testimonial_title = isset($testimonial_item['testimonial_title']) && $testimonial_item['testimonial_title'] != '' ? $testimonial_item['testimonial_title'] : '';

                if ($elementor_flag) {
                    $testimonial_img = isset($testimonial_item['testimonial_img']['id']) && $testimonial_item['testimonial_img']['id'] != '' ? wp_get_attachment_image_src($testimonial_item['testimonial_img']['id'], 'full')[0] : '';
                } else {
                    $testimonial_img = isset($testimonial_item['testimonial_img']) && $testimonial_item['testimonial_img'] != '' ? wp_get_attachment_image_src($testimonial_item['testimonial_img'], 'full')[0] : '';
                }

                $testimonial_pos = isset($testimonial_item['testimonial_pos']) && $testimonial_item['testimonial_pos'] != '' ? $testimonial_item['testimonial_pos'] : '';
                $testimonial_wording = isset($testimonial_item['testimonial_wording']) && $testimonial_item['testimonial_wording'] != '' ? $testimonial_item['testimonial_wording'] : '';

                $slider_content .= '<div class="swiper-slide">
                                    <div class="ls-slide-content">
                                        <h3>' . esc_html($testimonial_title) . '</h3>
                                        <h4>' . esc_html($testimonial_pos) . '</h4>
                                        <p>' . esc_html($testimonial_wording) . '</p>
                                    </div>
                                </div>';

                $slider_thumb .= '<div class="swiper-slide swiper-slide-thumbs">
                    <img src="' . esc_url($testimonial_img) . '" alt="' . __('Slider Image', 'sectionly') . '">
                </div>';
            }
        }

        $testimonial_html = '<div class="swiper swiper-container-main">
                                <div class="swiper-wrapper">
                                    ' . $slider_content . '
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            <div class="swiper gallery-thumbs">
                                <div class="swiper-wrapper">
                                    ' . $slider_thumb . '
                                </div>
                            </div>';
    }

    return $testimonial_html;
}