<?php
/*
 * Sectionly commonly used functions
 */

function sectionly_convert_widget_into_arr_data($seperation, $content) {

    $arr_list = array();

    $remove[] = "'";
    $remove[] = '"';
    $remove[] = "[";
    $remove[] = "]";
    $content = str_replace($remove, "", $content);

    $shortcode_string = (array_filter(explode($seperation, $content)));

    if (isset($shortcode_string) && !empty($shortcode_string) && is_array($shortcode_string)) {

        foreach ($shortcode_string as $key => $each_row) {

            $arr_list[] = array_column(array_map(function($s) {
                        return explode("=", $s);
                    }, explode(" ", $each_row)), 1, 0);
        }
    }
    return $arr_list;
}