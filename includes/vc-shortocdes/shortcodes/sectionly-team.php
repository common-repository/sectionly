<?php
/**
 * Our Team Shortcode
 * @return html
 */
add_shortcode('sectionly_our_team', 'sectionly_our_team_shortcode');

function sectionly_our_team_shortcode($atts, $content = '') {
    global $team_style;

    $team_html = '';

    extract(shortcode_atts(array(
        'team_items' => '',
                    ), $atts));

    $elementor_flag = FALSE;
    if (isset($atts['elementor']) && $atts['elementor']) {
        $elementor_flag = TRUE;
    }
    
    $wp_sec_widget = FALSE;
    
    if ($elementor_flag) {
        $member_list = isset($atts['team_items']) && $atts['team_items'] != '' ? $atts['team_items'] : array();
    } else {
        
        $post = get_post();
        if ($post && preg_match('/vc_row/', $post->post_content)) {

             $member_list = vc_param_group_parse_atts($team_items);
        } else {
            $wp_sec_widget = TRUE;
            $member_list = sectionly_convert_widget_into_arr_data('team_items',$content);
        }
        
    }
    
    if (isset($member_list) && is_array($member_list) && count($member_list) > 0) {
        $team_html .= '<section class="sl-main">';
        foreach ($member_list as $member_item) {
            if (isset($member_item['team_title']) && $member_item['team_title'] != '') {

                $team_title = isset($member_item['team_title']) && $member_item['team_title'] != '' ? $member_item['team_title'] : '';
                
                if ($elementor_flag) {
                    $team_img = isset($member_item['team_img']['id']) && $member_item['team_img']['id'] != '' ? wp_get_attachment_image_src($member_item['team_img']['id'], 'full')[0] : '';
                } else {
                    
                    if($wp_sec_widget){
                        $team_img = isset($member_item['team_img']) && $member_item['team_img'] != '' ? $member_item['team_img'] : '';
                    }else{
                      $team_img = isset($member_item['team_img']) && $member_item['team_img'] != '' ? wp_get_attachment_image_src($member_item['team_img'], 'full')[0] : '';  
                    }
                    
                    
                }
                
                $team_position = isset($member_item['team_pos']) && $member_item['team_pos'] != '' ? $member_item['team_pos'] : '';
                $team_experience = isset($member_item['team_experience']) && $member_item['team_experience'] != '' ? $member_item['team_experience'] : '';
                $team_biography = isset($member_item['team_biography']) && $member_item['team_biography'] != '' ? $member_item['team_biography'] : '';
                $team_fb = isset($member_item['team_fb']) && $member_item['team_fb'] != '' ? $member_item['team_fb'] : '';
                $team_instagram = isset($member_item['team_instagram']) && $member_item['team_instagram'] != '' ? $member_item['team_instagram'] : '';
                $team_twitter = isset($member_item['team_twitter']) && $member_item['team_twitter'] != '' ? $member_item['team_twitter'] : '';
                $team_linkedin = isset($member_item['team_linkedin']) && $member_item['team_linkedin'] != '' ? $member_item['team_linkedin'] : '';

                $team_html .= '<div class="sl-content">
                                <div class="sl-content-area">
                                    <figure>
                                        <img src="' . esc_url($team_img) . '" alt="' . __('team member avatar', 'sectionly') . '">
                                    </figure>
                                    <div class="sl-name">
                                        <h2>' . esc_html($team_title) . '</h2>
                                        <h6>' . esc_html($team_experience) . '</h6>
                                        <h4>' . esc_html($team_position) . '</h4>
                                    </div>
                                    <p>' . esc_html($team_biography) . '</p>
                                    <div class="sl-social-icon">
                                        <a href="' . esc_html($team_fb) . '"><img src="' . SECTIONLY_PLUGIN_URL . '/public/images/facebook.png" alt="' . __('facebook social image', 'sectionly') . '"></a>
                                        <a href="' . esc_html($team_twitter) . '"><img src="' . SECTIONLY_PLUGIN_URL . '/public/images/twitter.png" alt="' . __('twitter social image', 'sectionly') . '"></a>
                                        <a href="' . esc_html($team_instagram) . '"><img src="' . SECTIONLY_PLUGIN_URL . '/public/images/instagram.png" alt="' . __('instagram social image', 'sectionly') . '"></a>
                                        <a href="' . esc_html($team_linkedin) . '"><img src="' . SECTIONLY_PLUGIN_URL . '/public/images/linkedin.png" alt="' . __('linkedin social image', 'sectionly') . '"></a>
                                    </div>
                                </div>
                            </div>';
            }
        }
        $team_html .= '</section>';
    }

    return $team_html;
}