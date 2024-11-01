=== Plugin Name ===
Contributors: Nolan Campbell
Donate link: http://www.nrcstudios.info/
Tags: flickr, image, slideshow, gallery, photo, photostream, gallery, photography, thumbnails
Requires at least: 3
Tested up to: 3.3.1
Stable tag: "trunk"

FlickrShow WordPress Plugin.

== Description ==

View all our premium WordPress Plugins and Themes: **http://nuvuthemes.com**

*Update 3-5-2012: jQuery script loading changed to fix conflict issues with other plugins.*

**Create a Flickr slideshow in Wordpress** -
Use the Flickr.com API to load flickr photostreams, photo sets and search tags into wordpress photo galleries. Simply insert shortcode into your page or load a widget into your sidebar.
Requires WordPress 3.0+ and PHP 5.

    *Create PhotoStream, Photo Sets and Search Galleries*
    *Lightbox styled slideshow with thumbnail bar.*
    *Add Unlimited FlickrShow Galleries.*
    *Choose how many images to display.*
    *Show photo information such as image title, number of views and flickr username*
    *Toggle fullscreen.*
    *Set Thumbnail sizes and quality*
    *Background effects on slideshow close*


View Demo: **http://flickrshow.nrcstudios.info/?page_id=10**

*Free Version is limited to 10 photos per gallery.*
*Get the Unlimted images version with support here:* **http://nrcstudios.info/index.php/flickrshow-wordpress-plugin**
*NEW - Get the Non-Branded(No Flickrshow logos), Unlimited version with support here:* **http://nrcstudios.info/index.php/flickrshow-wordpress-plugin-nonbranded**
*If you use the free version please donate anything - keep my work free.*

2-17-2012 Update: Fixed some styling issues in IE.
*Check out the new Ghost Tags - wordpress animating tag cloud - **http://ghostcloud.nrcstudios.info/**










== Installation ==

**Installing and working with the plugin.**
e.g.


1. Step 1: Upload the wp-flickrshow folder to the /wp-content/plugins/ folder.

2. Step 2: Add a folder to your wordpress root directory called “cache” and set the cache folders read/write permissions to full(chmod to 777). I use FileZilla to upload and set file permissions.


3. Step 3: Activate the “flickrshow” plugin under the admin menu->plugins menu.

4. Step 4: Under admin menu->Settings->FlickrShow Settings enter your Flickr Api Key.

5. Step 5: Add the shortcode to your page or add the Flickrshow widget to your sidebar.


For more complete instructions with screenshots: **http://flickrshow.nrcstudios.info/?page_id=6**




== Frequently Asked Questions ==

= Why am I getting "flickr photo unavailable" errors? =

This is a common error message recieved due to the image_size option not set correctly. To verify the largest available image size for the images being fetched from flickr open an image on flickr.com by clicking the image. The image will load into the flickr.com fullscreen image veiwer. In the upper right hand corner of the window there is a button labeled "view all sizes". Click this button to verify that the image has the "Large" size available. If the Large size is not listed then find the largest size listed in the "view all sizes" list and add the image_size="largest size available" into your shortcode. example for an image that has the largest available size of medium 500: [flickrshow set_number="2178671637816" image_size="Medium 500" ]

= How do I get a Flickr API Key? =

You can easily obtain a flickr api key by going to the following link: **http://www.flickr.com/services/apps/create/apply**

== Screenshots ==

1. /trunk/screenshots/screenshot-1.png
2. /trunk/screenshots/screenshot-2.png
3. /trunk/screenshots/screenshot-3.png
4. /trunk/screenshots/screenshot-4.png
5. /trunk/screenshots/screenshot-5.png
6. /trunk/screenshots/screenshot-6.png

== Changelog ==

= 1.0 =
1.5 -  jQuery script loading changed to fix conflict issues with other plugins.

1.3 - Styling issues with IE fixed.
Version 1.3 - returns each gallery so you can insert between page elements. Use the div_height option to clear containers.

= 0.5 =

== Upgrade Notice ==

= 1.0 =


= 0.5 = 

== Arbitrary section ==
== The Shortcode ==

**Adding the shortcode to your page.**
e.g.

Add the Flickrshow shortcode to anywhere on your page to display the gallery.

*flickrname:*

[ flickrshow flickrname="someones flickr name"  num_images="12" ]

*set_number:*

[ flickrshow set_number="72157626881052206"  num_images="12" ]

*search:*

[ flickrshow search="paint"    num_images="12" ]

*show_titles:*

[ flickrshow flickrname="someones flickrname" show_titles="true"  num_images="12" ]

*title options(“true” or “false” – default is set to “false”).

*show_info:*

[ flickrshow  flickrname="someones flickrname"  show_info="true"  num_images="22" ]

*This option will show the pictures owner username, total views and title in the lightbox header. options are(“true” or “false” – default is set to “true”).

*thumb_size:*

[ flickrshow search="paint" thumb_size="square" num_images="32" ]

*This option will set the size of the thumbnail images.

options are(

    “square” -(75px 75px)
    “thumbnail” -(100px, 66px)
    “small” -(240px, 157px)
    “medium 500? -(500px, 327px)
    “medium 640? -(640px, 418px)
    “large” -(original size)

- default is set to “square”).

*image_size: optional*

[ flickrshow search="paint" thumb_size="square" image_size="large" num_images="32" ]

*This option will set the size of the main image loaded. The actual displayed image size is set through the flickrshow.css file but you may set this option to tweak the image quality. By default this option is set to large. This means that the original size is loaded but the css sets the display to a set size. If you know the size of the images you may want to set this to the closest size that matches the actual image to scale back on image sizes thus dropping the loading times required to load the images. If you want your images to be a medium 500 size then set the image_size option to be “medium 500? and then set the .limage{width:900px; height: 500px; } in flickrshow.css line 2 to match the width and height of medium 500(500px 327px).
If you do not feel comfortable editing the css then simply leave this option as default and your pictures will use the default settings.

options are(

    “square” -(75px 75px)
    “thumbnail” -(100px, 66px)
    “small” -(240px, 157px)
    “medium 500? -(500px, 327px)
    “medium 640? -(640px, 418px)
    “large” -(original size)

- default is set to “square”).

*Putting it all together:*

example one – flickrname photostream showing title and photo info for 100 images and setting the thumbnail size to thumbnail(100px x 66px):
[ flickrshow flickrname="someones flickrname" show_info="true" show_titles="true" thumb_size="thumbnail" num_images="100" ]

example two – showing a set with title and photo info, setting the thumbnail size to small and showing 50 images:
[ flickrshow flickrname="someones flickrname" show_info="true" show_titles="true" thumb_size="small" num_images="50" ]
Option defaults:

    flickrname = ‘null’
    search = ‘null’
    num_images = ’100'
    thumb_size = ‘Thumbnail’
    image_size = ‘Large’
    set_number = ‘null’
    show_info = ‘false’
    show_titles = ‘false’
    preload_img = ‘false’

*div_height*
*This option will set the height of each gallery div. Setting this height option when inserting into a page with other content ensures that the other content will be cleared by the gallery div container.*

example:[ flickrshow flickrname="someones flickrname" show_info="true" show_titles="true" thumb_size="thumbnail" num_images="100" div_height="300px"]

== Loading jQuery before plugins ==

The correct way to load jQuery into your theme is to load it prior to all plugins being loaded. Having said this know that the plugin loads jQuery seperately in case your theme is not set to load jQuery. To load jQuery from the theme instead of the plugin do the following changes to your theme and plugin files.

Step One: Open your themes functions.php file and add the following code anywhere on the page:
**if( !is_admin()){
wp_deregister_script('jquery');
wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false, '1.3.2');
wp_enqueue_script('jquery');
}**

Step Two: Open the flickrshow.php file and comment out or delete the echo script line on line 28 by adding two backslashes before it ("//"))

  // echo "&lt;script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'>&lt;/script> " ;

*Step Three: Upload the saved files to your server.

This will load jQuery into your theme before any plugins get loaded on the page thus eliminating the need for each plugin to load jQuery.
When each plugin loads different versions of jQuery on the page this creates compatability issues and will cause your plugins to not work correctly. I seriously suggest the users of FlickrShow to use this method of including jQuery on the page.
