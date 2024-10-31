<?php
/**
 * Blog Shortcode
 * @return html
 */
add_shortcode('sectionly_blogs', 'sectionly_blog_shortcode');

function sectionly_blog_shortcode($atts) {
    global $blog_per_page;
    extract(shortcode_atts(array(
        'blog_cat' => '',
        'blog_excerpt' => '20',
        'blog_order' => 'DESC',
        'blog_orderby' => 'date',
        'blog_per_page' => '9',
                    ), $atts));

    $blog_html = '';

    $blog_per_page = $blog_per_page == '' ? -1 : absint($blog_per_page);

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $blog_per_page,
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'order' => $blog_order,
        'orderby' => $blog_orderby,
    );


    if ($blog_cat && $blog_cat != '' && $blog_cat != '0') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => is_array($blog_cat) ? $blog_cat : explode(',',$blog_cat),
            ),
        );
    }

    $blog_query = new WP_Query($args);
    $total_posts = $blog_query->found_posts;
    ob_start();
    $row_class = "";
    if ($blog_query->have_posts()) {
        global $post;

        $blog_html .= '<section class="sl-main">';

        while ($blog_query->have_posts()) : $blog_query->the_post();

            $post_id = $post->ID;

            $post_thumbnail_id = get_post_thumbnail_id($post_id);
            $post_thumbnail_image = wp_get_attachment_image_src($post_thumbnail_id, 'medium');
            $post_thumbnail_src = isset($post_thumbnail_image[0]) && esc_url($post_thumbnail_image[0]) != '' ? $post_thumbnail_image[0] : '';
            $categories = get_the_category();

            $blog_html .= '<div class="sl-blog-main">
                        <div class="cl-blog-content">
                            <figure><a href="' . esc_url(get_permalink($post_id)) . '"><img src="' . esc_url($post_thumbnail_src) . '" alt=""></a></figure>
                            <div class="sl-blog-content">
                            <small> ' . get_the_date(get_option('date_format', $post_id)) . ' </small>
                            <div>
                                <h2>' . wp_trim_words(get_the_title($post_id), 8, '...') . '</h2>
                                <p>' . wp_trim_words(get_the_content($post_id), $blog_excerpt, '...') . '</p>
                            </div>
                        </div>
                        </div>
                    </div>';

        endwhile;


        $blog_html .= '</section>';
        wp_reset_postdata();
    } else {
        esc_html_e("No post found.", "sectionly");
    }

    return $blog_html;
}