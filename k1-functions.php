<?php

/*
  Plugin Name: Klan1 Common WP Functions
  Plugin URI: http://www.klan1.com
  Description: Basic functions needed by our others plugins and templates.
  Version: 0.3.1
  Author: Alejandro Trujillo J. - J0hnD03
  Author URI: http://www.facebook.com/j0hnd03
  Note: This pluging includes TimThumb by Ben Gillbanks and Mark Maunder
  Based on work done by Tim McDaniels and Darren Hoyt http://code.google.com/p/timthumb/

 */

/*
  Klan1 Common WP Functions (Wordpress Plugin)
  Copyright (C) 2011-2013 Alejandro Trujillo J.
  Contact me at http://www.klan1.com

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
if (!defined("K1_FUNCTIONS")) {

    define("K1_FUNCTIONS", TRUE);
    define("K1_FUNCTIONS_VER", 0.3);
    define("K1_FUNCTIONS_URL", plugin_dir_url(__FILE__));
    define("K1_FUNCTIONS_PATH", plugin_dir_path(__FILE__));
    define("K1_FUNCTIONS_TIMTHUMB_FILE", K1_FUNCTIONS_URL . "tools/timthumb/timthumb.php");

    if (!function_exists("k1_get_post_thumb_url")) {

        /**
         * Get the URL for the FEATURED IMAGE (full sized) defined in a POST/PAGE. If not defined returns the FIRST image if there is at leat one. Returns NULL if no images (jpg,png,gif) attachments.
         * @global WP_Post $post
         * @param Integer $post_id If is empty, we will try to get the POST ID from the global $post var
         * @return String The FEATURED IMAGE URL
         */
        function k1_get_post_thumb_url($post_id = null) {
            if (empty($post_id)) {
                global $post;
                if (!empty($post->ID)) {
                    $post_id = $post->ID;
                } else {
                    return new WP_Error('no $post_id', __("\$post_id is unknow on " . __FUNCTION__ . "()"));
                }
            }
            $thumb_args = array(
                'post_type' => 'attachment',
                'post_mime_type' => 'image/jpeg,image/png,image/gif',
                'post_status' => 'any',
                'post_parent' => $post_id,
                'include' => get_post_thumbnail_id($post_id)
            );

            $wp_thumb_url = get_posts($thumb_args);

            if (!empty($wp_thumb_url[0])) {
                return $wp_thumb_url[0]->guid;
            } else {
                return null;
            }
        }

        // Compatibility with our old function names 
        if (!function_exists("k1_get_wp_thumb_url")) {

            function k1_get_wp_thumb_url($post_id = null) {
                return k1_get_post_thumb_url($post_id = null);
            }

        }
    }

    if (!function_exists("k1_get_timthumb_img_url")) {

        /**
         * Returns the full URL using timthumb script resizing the post thumb img
         * @global WP_Post $post
         * @param Integer $post_id If is empty, we will try to get the POST ID from the global $post var
         * @param Integer $width See TIMTHUMB documentation: http://www.binarymoon.co.uk/2012/02/complete-timthumb-parameters-guide/
         * @param Integer $height See TIMTHUMB documentation: http://www.binarymoon.co.uk/2012/02/complete-timthumb-parameters-guide/
         * @param Integer $crop See TIMTHUMB documentation: http://www.binarymoon.co.uk/2011/03/timthumb-proportional-scaling-security-improvements/
         * @param String $align See TIMTHUMB documentation: http://www.binarymoon.co.uk/2010/08/timthumb-part-4-moving-crop-location/
         * @return \WP_Error|null
         */
        //OLD: k1_get_thumb_img_url
        function k1_get_post_timthumb_img_url($post_id = null, $width = 0, $height = 0, $crop = 1, $align = "t") {
            if (empty($post_id)) {
                global $post;
                if (!empty($post->ID)) {
                    $post_id = $post->ID;
                } else {
                    return new WP_Error('no $post_id', __("\$post_id is unknow on k1_get_timthumb_img_url()"));
                }
            }
            $wp_thumb_url = k1_get_post_thumb_url($post_id);
            if (!empty($wp_thumb_url)) {
                $img_code = K1_FUNCTIONS_TIMTHUMB_FILE . "?src=" . $wp_thumb_url . "&w=$width&h=$height&zc=$crop&q=100&a=$align";
                return $img_code;
            } else {
                return null;
            }
        }

        // Compatibility with our old function names 
        if (!function_exists("k1_get_thumb_img_url")) {

            function k1_get_thumb_img_url($post_id = null, $width = 0, $height = 0, $crop = 1, $align = "t") {
                return k1_get_post_timthumb_img_url($post_id = null, $width = 0, $height = 0, $crop = 1, $align = "t");
            }

        }
    }
    if (!function_exists("k1_get_thumb_img_html")) {

        /**
         * return the FULL IMG HTML tag for the post featured image using TIMTHUMB or not
         * @global WP_Post $post
         * @param Integer $post_id If is empty, we will try to get the POST ID from the global $post var
         * @param Boolean $resize If false, just returns the IMG URL
         * @param Integer $width See TIMTHUMB documentation: http://www.binarymoon.co.uk/2012/02/complete-timthumb-parameters-guide/
         * @param Integer $height See TIMTHUMB documentation: http://www.binarymoon.co.uk/2012/02/complete-timthumb-parameters-guide/
         * @param Integer $crop See TIMTHUMB documentation: http://www.binarymoon.co.uk/2011/03/timthumb-proportional-scaling-security-improvements/
         * @param String $align See TIMTHUMB documentation: http://www.binarymoon.co.uk/2010/08/timthumb-part-4-moving-crop-location/
         * @return string|boolean|\WP_Error
         * 
         * TODO: Get the attachment metadata to make the longdesc="" and alt="" IMG properties.
         */
        // OLD: k1_get_thumb_img
        function k1_get_post_thumb_img_html($post_id = null, $resize = false, $width = 0, $height = 0, $crop = 1, $align = "t") {
            if (empty($post_id)) {
                global $post;
                if (!empty($post->ID)) {
                    $post_id = $post->ID;
                } else {
                    return new WP_Error('no $post_id', __("\$post_id is unknow on " . __FUNCTION__ . "()"));
                }
            }
            $wp_thumb_url = k1_get_post_thumb_url($post_id);
            $timthumb_url = k1_get_post_timthumb_img_url($post_id, $width, $height, $crop, $align);
            if (!empty($wp_thumb_url) && !empty($timthumb_url)) {
                if ($resize) {
                    $img_code = "<img src='{$timthumb_url}' width='$width' height='$height' />";
                } else {
                    $img_code = "<img src='{$wp_thumb_url}' />";
                }
                return $img_code;
            } else {
                return false;
            }
        }

        // Compatibility with our old function names 
        if (!function_exists("k1_get_thumb_img")) {

            function k1_get_thumb_img($post_id = null, $resize = false, $width = 0, $height = 0, $crop = 1, $align = "t") {
                return k1_get_post_thumb_img_html($post_id = null, $resize = false, $width = 0, $height = 0, $crop = 1, $align = "t");
            }

        }
    }
    if (!function_exists("k1_get_plain_post_content")) {

        /**
         * Function taken from somewhere on the internet
         * @param Integer $post_id If is empty, we will try to get the POST ID from the global $post var
         * @return string
         */
        function k1_get_plain_post_content($post_id = null) { // Fakes an excerpt if needed
            if (empty($post_id)) {
                global $post;
                if (!empty($post->ID)) {
                    $post_id = $post->ID;
                } else {
                    return new WP_Error('no $post_id', __("\$post_id is unknow on " . __FUNCTION__ . "()"));
                }
            }

            //if (!empty($post->ID)) {

            $text = $post->post_content;
            $text = strip_shortcodes($text);
            $text = apply_filters('the_content', $text);
            $text = str_replace(']]>', ']]&gt;', $text);
            $text = strip_tags($text);
            $excerpt_length = apply_filters('excerpt_length', 80);
            $words = explode(' ', $text, $excerpt_length + 1);
            if (count($words) > $excerpt_length) {
                array_pop($words);
                array_push($words, '...');
                $text = implode(' ', $words);
            }
            //}
            return $text;
        }

    }
    if (!function_exists("stripAccents")) {

        /**
         * Function taken from somewhere on the internet
         * @param string $stripAccents
         * @return string
         */
        function stripAccents($stripAccents) {
            return strtr($stripAccents, 'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
        }

    }
}
?>