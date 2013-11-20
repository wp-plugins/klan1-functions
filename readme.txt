=== Klan1 Common WP Functions ===
Contributors: k1-j0hnd03
Donate link: http://klan1.com/
Tags: developer, basic functions, klan1
Requires at least: 2.7
Tested up to: 3.7.1
Stable tag: init
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Basic functions needed by our others plugins and templates.

== Description ==

This functions are for those needs to resize images on their templates or plugins all the time.

`<?php echo k1_get_post_thumb_url($post_id = null); ?>`

Get the URL for the FEATURED IMAGE (full sized) defined in a POST/PAGE. If not defined returns the FIRST image if there is at leat one. Returns NULL if no images (jpg,png,gif) attachments.

* **`$post_id`** If is empty, we will try to get the POST ID from the global $post var

`<?php echo k1_get_post_timthumb_img_url($post_id = null, $width = 80, $height = 50, $crop = 1, $align = "t"); ?>`

Returns the full URL using timthumb script to resize the post featured image

* **`$post_id`** If is empty, we will try to get the POST ID from the global $post var
* **`$width`** See TIMTHUMB documentation: http://www.binarymoon.co.uk/2012/02/complete-timthumb-parameters-guide/
* **`$height`** See TIMTHUMB documentation: http://www.binarymoon.co.uk/2012/02/complete-timthumb-parameters-guide/
* **`$crop`** See TIMTHUMB documentation: http://www.binarymoon.co.uk/2011/03/timthumb-proportional-scaling-security-improvements/
* **`$align`** See TIMTHUMB documentation: http://www.binarymoon.co.uk/2010/08/timthumb-part-4-moving-crop-location/

*NOTE*: If jut one height or width is defined as zero (0) will conserve image proportion, if is not defined it will be default value.

`<?php echo k1_get_post_thumb_img_html($post_id = null, $resize = false, $width = 80, $height = 50, $crop = 1, $align = "t"); ?>`

return the FULL IMG HTML tag for the post featured image using TIMTHUMB or not as desired

* **`$post_id`** If is empty, we will try to get the POST ID from the global $post var
* **`$resize`** If false, just returns the IMG URL
* **`$width`** See TIMTHUMB documentation: http://www.binarymoon.co.uk/2012/02/complete-timthumb-parameters-guide/
* **`$height`** See TIMTHUMB documentation: http://www.binarymoon.co.uk/2012/02/complete-timthumb-parameters-guide/
* **`$crop`** See TIMTHUMB documentation: http://www.binarymoon.co.uk/2011/03/timthumb-proportional-scaling-security-improvements/
* **`$align`** See TIMTHUMB documentation: http://www.binarymoon.co.uk/2010/08/timthumb-part-4-moving-crop-location/

*NOTE*: If jut one height or width is defined as zero (0) will conserve image proportion, if is not defined it will be default value.

*TODO*: Get the attachment metadata to make the longdesc="" and alt="" IMG properties.

== Installation ==

1. Upload `k1-functions` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. All ready

== Frequently Asked Questions ==

= Have some configuration file? =

No, are just functions for developers and coders, see k1-functions.php to get more info.

For TIMTHUMB see: http://www.binarymoon.co.uk/2012/03/timthumb-configs/. But, it supposed to work as is now.

= images are not displayed ! =

Left click on the img, COPY the URL and see the error on the browser, probably you will know what to do. 

The FOLDER "cache" must have write access any way.

== Screenshots ==
not needed.

== Changelog ==
= 0.2 =
* Various code fixes.
* Better coding and comments.

= 0.1.1 =
Better coding and comments.

= 0.1 =
First relase "as is".
