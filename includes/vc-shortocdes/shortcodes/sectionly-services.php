<?php
/**
 * Our Testimonial Shortcode
 * @return html
 */
add_shortcode('sectionly_services', 'sectionly_our_services_shortcode');

function sectionly_our_services_shortcode($atts, $content = '') {

    $service_html = '';

    extract(shortcode_atts(array(
        'services_items' => '',
                    ), $atts));

    $elementor_flag = FALSE;
    if (isset($atts['elementor']) && $atts['elementor']) {
        $elementor_flag = TRUE;
    }
    
    $service_list = array();
    
    $wp_sec_widget = FALSE;
    
    if ($elementor_flag) {
        $service_list = isset($atts['services_items']) && $atts['services_items'] != '' ? $atts['services_items'] : array();
    } else {
      
        $post = get_post();
        if ($post && preg_match('/vc_row/', $post->post_content)) {

             $service_list = vc_param_group_parse_atts($services_items);
        } else {
            $wp_sec_widget = TRUE;
            $service_list = sectionly_convert_widget_into_arr_data('services_items',$content);
        }
       
    }
    
    
    if (isset($service_list) && is_array($service_list) && count($service_list) > 0) {
      
        $service_html .= '<section class="sl-main">';
        foreach ($service_list as $service_item) {
              
            if (isset($service_item['services_title']) && $service_item['services_title'] != '') {
                
                $services_title = isset($service_item['services_title']) && $service_item['services_title'] != '' ? $service_item['services_title'] : '';
                
                
                if ($elementor_flag) {
                    $services_img = isset($service_item['services_img']['id']) && $service_item['services_img']['id'] != '' ? wp_get_attachment_image_src($service_item['services_img']['id'], 'full')[0] : '';
                } else {
                    
                    if($wp_sec_widget){
                        $services_img = isset($service_item['services_img']) && $service_item['services_img'] != '' ? $service_item['services_img'] : '';
                    }else{
                        $services_img = isset($service_item['services_img']) && $service_item['services_img'] != '' ? wp_get_attachment_image_src($service_item['services_img'], 'full')[0] : '';
                    }
                    
                    
                }
                
                
                $services_description = isset($service_item['services_description']) && $service_item['services_description'] != '' ? $service_item['services_description'] : '';
                $services_readmore = isset($service_item['services_readmore']) && $service_item['services_readmore'] != '' ? $service_item['services_readmore'] : '';
                
                $service_html .='<div class="sl-content">
                                    <div class="ls-iconbox">
                                        <div class="ls-icon-content">
                                            <figure>
                                                <img src="' . esc_url($services_img) . '" alt="">
                                            </figure>
                                        </div>
                                        <div class="ls-icon-content">
                                            <h2>' . esc_html($services_title) . '</h2>
                                            <p>' . esc_html($services_description) . '</p>
                                            <a href="'.esc_url($services_readmore).'">'.__('Read More','sectionly').'</a>
                                        </div>
                                    </div>
                                </div>';
                
            }
        }
        
        $service_html .= '</section>';
    }

    return $service_html;
}