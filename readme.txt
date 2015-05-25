=== Klan1 Common WP Functions ===
Contributors: k1-j0hnd03
Donate link: http://klan1.com/
Tags: developer, basic functions, klan1
Requires at least: 2.7
Tested up to: 4.2.2
Stable tag: init
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Basic functions needed by our others plugins and templates.

== Description ==

This functions are for those needs to resize images on their templates or plugins all the time.

**FUNCTION: k1_get_post_thumb_url**

**DESCRIPTION**

`string k1_get_post_thumb_url(int $post_id)`

This function return the URL for the FEATURED IMAGE (full sized) defined in a POST/PAGE. If is not defined returns the FIRST image if there is at least one. 

Returns NULL if no jpg,png or gif images as attachments.

**USAGE EXAMPLE**

`<?php echo k1_get_post_thumb_url($post_id); ?>`

**PARAMETERS**

* **`$post_id`** If is empty, we will try to get the POST ID from the global $post var

**FUNCTION: k1_get_post_timthumb_img_url**

**DESCRIPTION**

`string k1_get_post_timthumb_img_url(int $post_id, int $width, int $height, int $crop, char $align)`

Returns the IMAGE full URL using timthumb script to resize the post featured image. Use this when you only need the URL not the IMG html tag.

**USAGE EXAMPLE**

`<?php echo k1_get_post_timthumb_img_url(null, 80, 50, 1, "t"); ?>`

**PARAMETERS**

* **`$post_id`** If is empty, we will try to get the POST ID from the global $post var
* **`$width`** This is numeric in pixels, if you use 0 width will be proportional to height. See: http://www.binarymoon.co.uk/demo/timthumb-basic/
* **`$height`** This is numeric in pixels, if you use 0 height will be proportional to height. See: http://www.binarymoon.co.uk/demo/timthumb-basic/
* **`$crop`** Use: **0** Resize to Fit specified dimensions (no cropping), **1** Crop and resize to best fit the dimensions (default), **2** Resize proportionally to fit entire image into specified dimensions, and add borders if required, **3** Resize proportionally adjusting size of scaled image so there are no borders gaps, see: http://www.binarymoon.co.uk/demo/timthumb-zoom-crop/
* **`$align`** **c** : position in the center (this is the default), **t** : align top, **tr** : align top right, **tl** : align top left, **b** : align bottom, **br** : align bottom right, **bl** : align bottom left, **l** : align left, **r** : align rightSee: http://www.binarymoon.co.uk/2010/08/timthumb-part-4-moving-crop-location/

*NOTE*: If you just define one height or width as zero (0) the other one will conserve image proportion, if is not defined it will be default value.

**FUNCTION: k1_get_post_thumb_img_html**

**DESCRIPTION**

`string k1_get_post_thumb_img_html(int $post_id, boolean $resize, int $width, int $height, int $crop, char $align)`

This function returns the FULL IMG HTML tag for the post featured image using TIMTHUMB or not as desired

**USAGE EXAMPLE**

`<?php echo k1_get_post_thumb_img_html(null, true, 80, 50, 1, "t"); ?>`

**PARAMETERS**

* **`$post_id`** If is empty, we will try to get the POST ID from the global $post var
* **`$resize`** TRUE to use timthumb script to resize the image, FALSE to return the image without any dimension change.
* **`$width`** This is numeric in pixels, if you use 0 width will be proportional to height. See: http://www.binarymoon.co.uk/demo/timthumb-basic/
* **`$height`** This is numeric in pixels, if you use 0 height will be proportional to height. See: http://www.binarymoon.co.uk/demo/timthumb-basic/
* **`$crop`** Use: **0** Resize to Fit specified dimensions (no cropping), **1** Crop and resize to best fit the dimensions (default), **2** Resize proportionally to fit entire image into specified dimensions, and add borders if required, **3** Resize proportionally adjusting size of scaled image so there are no borders gaps, see: http://www.binarymoon.co.uk/demo/timthumb-zoom-crop/
* **`$align`** **c** : position in the center (this is the default), **t** : align top, **tr** : align top right, **tl** : align top left, **b** : align bottom, **br** : align bottom right, **bl** : align bottom left, **l** : align left, **r** : align rightSee: http://www.binarymoon.co.uk/2010/08/timthumb-part-4-moving-crop-location/

*NOTE*: If you just define one height or width as zero (0) the other one will conserve image proportion, if is not defined it will be default value.

*TODO*: 

* Get the attachment metadata to make the longdesc="" and alt="" IMG properties.
* Use the parameters as array to implement more options

== Installation ==

1. Upload `k1-functions` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. All ready

== Frequently Asked Questions ==

= Have some configuration file? =

No, are just functions for developers and coders, see k1-functions.php to get more info.

For TIMTHUMB see: http://www.binarymoon.co.uk/2012/03/timthumb-configs/. But, it supposed to work as is now.

= images are not displayed ! =

Normally is permission problems. Please try 766 permissions on {wordpress plugins path}/k1-functions/tools/timthumb/cache. There will be the "small" copy of every img resized by this function.
If not, Left click on the img, COPY the URL and see the error on the browser, probably you will know what to do. 

The FOLDER "cache" must have write access any way.

== Screenshots ==
not needed.

== Changelog ==

= 0.4 =
* 100% quality on thumb generation, was 60% before.
* Readme.txt changed for better use understanding 

= 0.3.9 =
* Various code fixes.
* removed url encoded get parameters

= 0.3.7 =
* Various code fixes.
* url encoded get parameters

= 0.3 =
* Various code fixes.
* TimThumb allow external images

= 0.2 =
* Various code fixes.
* Better coding and comments.

= 0.1.1 =
Better coding and comments.

= 0.1 =
First relase "as is".
