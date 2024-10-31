<?php

/**
 * Our Testimonial Shortcode
 * @return html
 */
add_shortcode('sectionly_progressbar', 'sectionly_our_progressbars_shortcode', 10, 2);

function sectionly_our_progressbars_shortcode($atts, $content = '') {

    $progressbar_html = '';

    extract(shortcode_atts(array(
        'progressbar_items' => '',
                    ), $atts));


    $elementor_flag = FALSE;
    if (isset($atts['elementor']) && $atts['elementor']) {
        $elementor_flag = TRUE;
    }


    $progressbar_list = array();


    if ($elementor_flag) {
        $progressbar_list = isset($atts['progressbar_items']) && $atts['progressbar_items'] != '' ? $atts['progressbar_items'] : array();
    } else {

        $post = get_post();
        if ($post && preg_match('/vc_row/', $post->post_content)) {

            $progressbar_list = vc_param_group_parse_atts($progressbar_items);
        } else {

            $progressbar_list = sectionly_convert_widget_into_arr_data('progressbar_items',$content);
        }
    }


    if (isset($progressbar_list) && is_array($progressbar_list) && count($progressbar_list) > 0) {

        wp_enqueue_script('jprogress');

        $progressbar_html .= '<section class="sl-progress-main">';
        foreach ($progressbar_list as $progressbar_item) {

            if (isset($progressbar_item['progressbar_title']) && $progressbar_item['progressbar_title'] != '') {

                $progressbar_title = isset($progressbar_item['progressbar_title']) && $progressbar_item['progressbar_title'] != '' ? $progressbar_item['progressbar_title'] : '';
                $progressbar_perc = isset($progressbar_item['progressbar_perc']) && $progressbar_item['progressbar_perc'] != '' ? $progressbar_item['progressbar_perc'] : 0;

                $progressbar_html .= '<div class="sl-progress">
                                        <p>' .$progressbar_title. '</p>
                                        <div class="progressbars" progress="' . intval($progressbar_perc) . '%"></div>
                                    </div>';
            }
        }

        $progressbar_html .= '</section>';
    }

    return $progressbar_html;
}