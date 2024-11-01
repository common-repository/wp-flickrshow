<?php
 //error_reporting(E_ALL);
/*
Plugin Name: Flickr Show
Plugin URI: http://flickrshow.nrcstudios.info
Description: Shortcode for showing Flickr images
Version: 1.5
Author: Nolan Campbell
Author URI: http://nrcstudios.info
*/

//start the admin plugin options  code






//start the flickrshow code
function flickrshow_add_jquery(){
  $pluginfljs =  plugins_url( 'flickrjs.js', __FILE__ );


  echo "<script type='text/javascript' src='" . $pluginfljs . "'></script> " ;

};

function flickrshow_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );
};
add_action('wp_enqueue_scripts', 'flickrshow_scripts_method');

function flickrshow_add_css(){


   $pluginns =  plugins_url( 'jquery.nuvuscroll.js', __FILE__ );
     echo "<script type='text/javascript' src='" . $pluginns . "'></script> " ;
  $plugindircss =  plugins_url( 'flickrshow.css', __FILE__ ); ;
echo "<link type='text/css' rel='stylesheet' href='" . $plugindircss . " '/>  " ;
} ;






//options script
add_action('admin_menu', 'fshow_plugin_admin_add_page');
function fshow_plugin_admin_add_page() {
add_options_page('FlickrShow Settings Page', 'FlickrShow Settings', 'manage_options', 'fsplugin', 'flickrshow_plugin_options_page');
}
//admin options page
function flickrshow_plugin_options_page() {
?>
<div style='background: #fff; /* Old browsers */

 border-radius:20px; padding:10px;  border:1px solid rgba(1,1,1,0.3); width:900px; margin-top:20px; margin-left:50px;'>
<img src="<?php echo (str_replace( 'wp-admin/options-general.php', '', $_SERVER['PHP_SELF']))?>wp-content/plugins/wp-flickrshow/adminlogo.png" style="width:715px; height:245px; border:none;" />

 <span id="donate" style="width:200px; height:110px; padding:10px; position:relative; top:30px; left:20px;  margin:10px; z-index:999999;"><p style="text-align:left;">If you use our free plugins please think about a donation to let us know thanks. - Nolan</p><form style="margin-top:-5px;" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="HBJRLKQZ6KA2N">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form></span>


<form action="options.php" method="post" style='background:#ffffff; padding:20px;border-radius:0px 0px 20px 20px;margin-top:10px;'>
<?php settings_fields('fsplugin_options'); ?>

<?php do_settings_sections('fsplugin'); ?>

<input name="fsSubmit" type="submit" style='background:#9ACB48;text-align:right; border:1px solid #111; cursor:pointer;' value="<?php esc_attr_e('Save Changes'); ?>" /><br />
<br />


</form></div>  <?php }
//add intitial register settings


//register and add settings
function flickrshow_plugin_admin_init(){
register_setting( 'fsplugin_options', 'fplugin_options' );
add_settings_section('plugin_main', 'Main Settings', 'flickrshow_plugin_section_text', 'fsplugin');
add_settings_field('plugin_text_string', 'Plugin Settings', 'flickrshow_plugin_setting_string', 'fsplugin', 'plugin_main');
}
add_action('admin_init', 'flickrshow_plugin_admin_init');
//setting discription text here
function flickrshow_plugin_section_text() {
echo "<hr style='opacity:0.3'/> <p>More Info: <a href='http://flickrshow.nrcstudios.info'>http://flickrshow.nrcstudios.info</a>
<p>Don't have an API Key? - <a href='http://www.flickr.com/services/apps/create/apply'>Get a Flickr API Key here.</a></p>
<p>Get the Unlimited Version - <a href='http://nrcstudios.info/index.php/flickrshow-wordpress-plugin'>Download Now.</a></p>
<hr style='opacity:0.3'/>  ";

}

//set input array here
function flickrshow_plugin_setting_string() { ?><?php

$fsoptions = get_option('fplugin_options');

?>


<span>Flickr API Key: <input style='background:#eee;' id='fs_api' name='fplugin_options[fs_api]' size='100' maxlength="100" type='text' value='<?php echo $fsoptions['fs_api']?>' /> -  Enter Flickr API Key</span><br/><br/>


<?php      }


function flickr_func($atts, $content){
  $fsoptions = get_option('fplugin_options');
   $atts = shortcode_atts(
    array(
      'flickrname' => '',
      'search' => '',
     'apikey' => $fsoptions['fs_api'],
      'width' => '75',
      'height' => '75',
      'flickr_reset_time' => 1,
      'num_images' => 100,
      'thumb_size' => 'Thumbnail',
      'image_size' => 'Large',
      'set_number' => '',
      'show_info' => 'false',
      'show_titles' => 'false',
      'preload_img' => 'false',
      'div_height' => ''
    ), $atts
 );

//extract all values of $atts array and assign them to an object
   extract($atts);
  if($num_images >= 10){
 $num_images = 10;
 }
   $fs_api = $apikey;
   require_once("phpFlickr-3.1/phpFlickr.php");
      $f = new phpFlickr("$apikey");
      $f->enableCache("fs", "cache", 3600 );

   switch ($thumb_size) {
       case 'thumbnail' :
       $width = '100';
       $height = '66';
        break;
      case 'square':
       $width = '75';
       $height = '75';
        break;
     case 'small' :
       $width = '240';
       $height = '157';
        break;
        case 'medium 500' :
       $width = '500';
       $height = '327';
        break;
         case 'medium 640':
       $width = '640';
       $height = '418';
        break;
         case 'large':
           $width = '800';
       $height = '550';
        break;
        };
 $recent = $f->people_findByUsername($flickrname);
 $nsid = $recent["id"];



  //echo '<pre>',print_r($tags),'</pre>';


   if($search){
      $tags = $f->photos_search(array('tags'=>$search, 'sort'=>'interestingness-desc','privacy_filter'=>'1','tag_mode'=>'any', 'per_page'=> $num_images));
       $sform = "<div class='flickrshowwrap'  preload='" . $preload_img . "' style='height:". $div_height ."'>";
    foreach ($tags['photo'] as $photo) {
       $sform .= "<div class='flickr-image' >";
       $photourl = $f->buildPhotoURL($photo, $image_size);

       $photoid = $f->photos_getInfo($photo['id']);
        $photosizes = $f->photos_getSizes($photo['id']);
        $photomed = $photosizes['4'];
        $photowidth =  $photomed['width'];
        $photoheight =  $photomed['height'];
       $photoarr = $photoid['photo'];
       $phototitle = $photoarr['title'];
       $photoviews = $photoarr['views'];
       $photoowner = $photoarr['owner'];
        $photousername = $photoowner['username'];
        $pid = $photoowner['nsid'];


       // echo "<pre>"; print_r($photoarr); echo "</pre>";
         $sform .= "<a href='".$photourl ."' title='" . $phototitle . "' user='" . $photousername . "' views='" . $photoviews . "' showinfo='" .$show_info .  "' purl='http://www.flickr.com/photos/". $pid  ."' fswidth='" . $photowidth ."' fsheight='" . $photowidth . "'>";


          $sform .= "<img class='fimg " . $thumb_size . "' src='" . $f->buildPhotoURL($photo, $thumb_size) .  "' width='".$width ."' height='" . $height . "' alt='" .$photo['title']. "' />";
        $sform .= "</a>";
        $sform .= "</div>";


       }; $sform .= "</div>";
        $output = $sform ;
   return $output;
       };













 // start flickrname show
 if($flickrname)
{
$photos = $f->people_getPublicPhotos($nsid, NULL, NULL, $num_images);
   if($preload_img == "true"){
     $fnform = "<div class='flickrshowwrap'  preload='" . $preload_img . "' style='height:". $div_height ."'>"; }else{
       $fnform = "<div class='flickrshowwrap'  style='height:". $div_height ."'>";

     };

  if($recent){
      if($show_titles == "true"){
     $setid = $f->people_getInfo($nsid);

      $fnform .= "<span><h3>". $setid['username']." - PhotoStream</h3></span>";
      //print_r($setid);

      };
    foreach ($photos['photos']['photo'] as $photo) {
        $fnform .= "<div class='flickr-image' >";
       $photourl = $f->buildPhotoURL($photo, $image_size);

       $photoid = $f->photos_getInfo($photo['id']);
        $photosizes = $f->photos_getSizes($photo['id']);
        $photomed = $photosizes['4'];
        $photowidth =  $photomed['width'];
        $photoheight =  $photomed['height'];

       $photoarr = $photoid['photo'];
       $phototitle = $photoarr['title'];
       $photoviews = $photoarr['views'];
       $photoowner = $photoarr['owner'];
        $photousername = $photoowner['username'];
        $pid = $photoowner['nsid'];


       // echo "<pre>"; print_r($photoarr); echo "</pre>";
        $fnform .= "<a href='".$photourl ."' title='" . $phototitle . "' user='" . $photousername . "' views='" . $photoviews . "' showinfo='" .$show_info .  "' purl='http://www.flickr.com/photos/". $pid  ."' fswidth='" . $photowidth ."' fsheight='" . $photowidth . "'>";


         $fnform .= "<img class='fimg " . $thumb_size . "' src='" . $f->buildPhotoURL($photo, $thumb_size) .  "' width='".$width ."' height='" . $height . "' alt='" .$photo['title']. "' />";
        $fnform .="</a>";
       $fnform .= "</div>";


       };

     }else {
          $fnform .= "<p>Cannot find flickr photo's.</p>";    }

         $fnform .= "</div>";
         $output = $fnform;
   return $output;

         };

//start set_number show
if($set_number){
 $photoset_id = $set_number;

 if($preload_img == "true"){
     $setform = "<div class='flickrshowwrap'  preload='" . $preload_img . "' style='height:". $div_height ."'>"; }else{
       $setform =  " <div class='flickrshowwrap' style='height:". $div_height ."' >";
     };


  if($photoset_id){
  $photosets = $f->photosets_getPhotos($photoset_id,NULL, NULL, $num_images);
    if($show_titles == "true"){
     $setid = $f->photosets_getInfo($photoset_id);
     $owner = $setid['owner'];
     $ownerid = $f->people_getInfo($owner);
      $setform .= "<span><h3>". $ownerid['username']." - " . $setid['title']. "</h3></span>";
      //print_r($ownerid['realname']);
      };

    foreach ($photosets['photoset']['photo'] as $sphoto) {
       $setform .= "<div class='flickr-image' >";
       $sphotourl = $f->buildPhotoURL($sphoto, $image_size);
          $photoid = $f->photos_getInfo($sphoto['id']);
           $photosizes = $f->photos_getSizes($sphoto['id']);
        $photomed = $photosizes['4'];
        $photowidth =  $photomed['width'];
        $photoheight =  $photomed['height'];
       $photoarr = $photoid['photo'];
       $phototitle = $photoarr['title'];
       $photoviews = $photoarr['views'];
       $photoowner = $photoarr['owner'];
        $photousername = $photoowner['username'];
          $pid = $photoowner['nsid'];

         $setform .= "<a href='".$sphotourl ."' title='" . $phototitle . "' user='" . $photousername . "' views='" . $photoviews . "' showinfo='" .$show_info . "' purl='http://www.flickr.com/photos/". $pid  . "' fswidth='" . $photowidth ."' fsheight='" . $photowidth . "'>";


         $setform .= "<img class='fimg " . $thumb_size . "' src='" . $f->buildPhotoURL($sphoto, $thumb_size) .  "' width='".$width ."' height='" . $height . "' alt='" .$sphoto['title']."'  />";
         $setform .= "</a>";
       $setform .= "</div>";


       };
     }else
          $setform .= "<p>Cannot find flickr photo's.";

   $setform .= "</div>";
   $output = $setform;
   return $output;
};



          };


//end flickr_func
//add the shortcode to the page
add_shortcode( 'flickrshow', 'flickr_func' );
add_action('wp_footer', 'flickrshow_add_jquery');
 add_action('wp_head', 'flickrshow_add_css');


//widget code

//add class that extends wp_widget class
class widget_flickrshow extends WP_Widget{
  //construct - will imediatly run when referencing class -
  function __construct()
  {
    //params for the widget info(name, description
     $params = array(
       'description' => 'Display FlickrShow as a Widget',
       'name' => 'FlickrShow'
     );
     //construct the widget to be dragged
     parent::__construct('widget_flickrshow', '', $params);
  }
 //the form data shown in the admin sidebar window
  public function form($instance)
  {
     extract($instance);
     ?>

      <p>
      <label for="<?php echo $this->get_field_id('fs_title');?>">Title: </label>
      <input
         class="widefat"
         id="<?php echo $this->get_field_id('fs_title');?>"
         name="<?php echo $this->get_field_name('fs_title');?>"
         value="<?php echo !empty($fs_title) ? $fs_title : 'FlickrShow Gallery';?>" />

     </p>
      <p>
      <label for="<?php echo $this->get_field_id('fs_apikey');?>">Flickr Api Key: </label>
      <input
         class="widefat"
         id="<?php echo $this->get_field_id('fs_apikey');?>"
         name="<?php echo $this->get_field_name('fs_apikey');?>"
         value="<?php if( isset($fs_apikey) ) echo esc_attr($fs_apikey);?>" />

     </p>
     <div class="fs-choose" style=" background:#eee;padding:5px;border:1px solid #999;border-radius:10px;margin-bottom:10px;" >
     <h4>Choose One:</h4>
     <p>
      <label for="<?php echo $this->get_field_id('fs_flickrname');?>">Flickrname: </label>
      <input
         class="widefat"
         style="width:100px;"
         id="<?php echo $this->get_field_id('fs_flickrname');?>"
         name="<?php echo $this->get_field_name('fs_flickrname');?>"
         value="<?php if( isset($fs_flickrname) ) echo esc_attr($fs_flickrname);?>" />

     </p>
      <p>
      <label for="<?php echo $this->get_field_id('fs_set_number');?>">Set Number: </label>
      <input
         class="widefat"
          style="width:100px;"
         id="<?php echo $this->get_field_id('fs_set_number');?>"
         name="<?php echo $this->get_field_name('fs_set_number');?>"
         value="<?php if( isset($fs_set_number) ) echo esc_attr($fs_set_number);?>" />

     </p>
      <p>
      <label for="<?php echo $this->get_field_id('fs_search');?>">Search: </label>
      <input
         class="widefat"
          style="width:100px;"
         id="<?php echo $this->get_field_id('fs_search');?>"
         name="<?php echo $this->get_field_name('fs_search');?>"
         value="<?php if( isset($fs_search) ) echo esc_attr($fs_search);?>" />

     </p>
     </div>

      <p>
      <label for="<?php echo $this->get_field_id('fs_showtitle');?>">Show Titles: </label>
      <input
         class="widefat"
         style="width:100px;"
         id="<?php echo $this->get_field_id('fs_showtitle');?>"
         name="<?php echo $this->get_field_name('fs_showtitle');?>"
         value="<?php echo !empty($fs_showtitle) ? $fs_showtitle : 'true';?>" />

     </p>
      <p>
      <label for="<?php echo $this->get_field_id('fs_showinfo');?>">Show Info: </label>
      <input
         class="widefat"
         style="width:100px;"
         id="<?php echo $this->get_field_id('fs_showinfo');?>"
         name="<?php echo $this->get_field_name('fs_showinfo');?>"
         value="<?php echo !empty($fs_showinfo) ? $fs_showinfo : 'true'; ?>" />

     </p>
      <p>
      <label for="<?php echo $this->get_field_id('fs_num_images');?>">Number of images: </label>
      <input
         type="number"
         class="widefat"
         style="width:40px;"
         id="<?php echo $this->get_field_id('fs_num_images');?>"
         name="<?php echo $this->get_field_name('fs_num_images');?>"
         min="1"
         value="<?php echo !empty($fs_num_images) ? $fs_num_images : 10;?>" />

     </p>
     <p>
      <label for="<?php echo $this->get_field_id('fs_thumb_size');?>">Thumbnail Size: </label>
      <input
         class="widefat"
         id="<?php echo $this->get_field_id('fs_thumb_size');?>"
         name="<?php echo $this->get_field_name('fs_thumb_size');?>"
         value="<?php echo !empty($fs_thumb_size) ? $fs_thumb_size : "square";?>" />

     </p>
      <p>
      <label for="<?php echo $this->get_field_id('fs_thumbs_width');?>">Thumbnail Width: </label>
      <input
         type="number"
         class="widefat"
         style="width:40px;"
         id="<?php echo $this->get_field_id('fs_thumbs_width');?>"
         name="<?php echo $this->get_field_name('fs_thumbs_width');?>"
         min="1"
         value="<?php echo !empty($fs_thumbs_width) ? $fs_thumbs_width : 45;?>" />

     </p>
      <p>
      <label for="<?php echo $this->get_field_id('fs_thumbs_height');?>">Thumbnail Height: </label>
      <input
         type="number"
         class="widefat"
         style="width:40px;"
         id="<?php echo $this->get_field_id('fs_thumbs_height');?>"
         name="<?php echo $this->get_field_name('fs_thumbs_height');?>"
         min="1"
         value="<?php echo !empty($fs_thumbs_height) ? $fs_thumbs_height : 45;?>" />

     </p>
     <?php
  }

  public function widget($args, $instance)
  {   //extract built in arguments
      extract($args);
      //extract paramaters set in the form function
      extract($instance);
      //wrap in div tage
      echo $before_widget;
      echo $before_title . $fs_title . $after_title;


   

      $width = '75';
      $height = '75';
      $flickr_reset_time = 1;


      $image_size = 'Large';

      $preload_img = 'false';
       require_once("phpFlickr-3.1/phpFlickr.php");
      $f = new phpFlickr("$fs_apikey");
      $f->enableCache("fs", "cache");


 $recent = $f->people_findByUsername($fs_flickrname);
 $nsid = $recent["id"];



  //echo '<pre>',print_r($tags),'</pre>';
 if($fs_num_images >= 10){
 $fs_num_images = 10;
 }

   if($fs_search){
      $tags = $f->photos_search(array('tags'=>$fs_search, 'sort'=>'interestingness-desc','privacy_filter'=>'1','tag_mode'=>'any', 'per_page'=> $fs_num_images));
       echo "<div class='flickrshowwrap'  preload='" . $preload_img . "'>";
    foreach ($tags['photo'] as $photo) {
        echo "<div class='flickr-image' >";
       $photourl = $f->buildPhotoURL($photo, $image_size);

       $photoid = $f->photos_getInfo($photo['id']);
        $photosizes = $f->photos_getSizes($photo['id']);
        $photomed = $photosizes['4'];
        $photowidth =  $photomed['width'];
        $photoheight =  $photomed['height'];
       $photoarr = $photoid['photo'];
       $phototitle = $photoarr['title'];
       $photoviews = $photoarr['views'];
       $photoowner = $photoarr['owner'];
        $photousername = $photoowner['username'];
        $pid = $photoowner['nsid'];


       // echo "<pre>"; print_r($photoarr); echo "</pre>";
         echo "<a href='".$photourl ."' title='" . $phototitle . "' user='" . $photousername . "' views='" . $photoviews . "' showinfo='" .$fs_showinfo .  "' purl='http://www.flickr.com/photos/". $pid  ."' fswidth='" . $photowidth ."' fsheight='" . $photowidth . "'>";


          echo "<img class='fimg " . $fs_thumb_size . "' src='" . $f->buildPhotoURL($photo, $fs_thumb_size) .  "' width='".$fs_thumbs_width ."' height='" . $fs_thumbs_height . "' alt='" .$photo['title']. "' />";
         echo "</a>";
        echo "</div>";


       }; echo "</div>";

       };













 // start flickrname show
 if($fs_flickrname)
{
$photos = $f->people_getPublicPhotos($nsid, NULL, NULL, $fs_num_images);
   if($preload_img == "true"){
     echo "<div class='flickrshowwrap'  preload='" . $preload_img . "'>"; }else{
       echo "<div class='flickrshowwrap'  >";
     };

  if($recent){
      if($fs_showtitle == "true"){
     $setid = $f->people_getInfo($nsid);

      echo "<span><h3>". $setid['username']." - PhotoStream</h3></span>";
      //print_r($setid);
      };
    foreach ($photos['photos']['photo'] as $photo) {
        echo "<div class='flickr-image' >";
       $photourl = $f->buildPhotoURL($photo, $image_size);

       $photoid = $f->photos_getInfo($photo['id']);
        $photosizes = $f->photos_getSizes($photo['id']);
        $photomed = $photosizes['4'];
        $photowidth =  $photomed['width'];
        $photoheight =  $photomed['height'];

       $photoarr = $photoid['photo'];
       $phototitle = $photoarr['title'];
       $photoviews = $photoarr['views'];
       $photoowner = $photoarr['owner'];
        $photousername = $photoowner['username'];
        $pid = $photoowner['nsid'];


       // echo "<pre>"; print_r($photoarr); echo "</pre>";
         echo "<a href='".$photourl ."' title='" . $phototitle . "' user='" . $photousername . "' views='" . $photoviews . "' showinfo='" .$fs_showinfo .  "' purl='http://www.flickr.com/photos/". $pid  ."' fswidth='" . $photowidth ."' fsheight='" . $photowidth . "'>";


          echo "<img class='fimg " . $fs_thumb_size . "' src='" . $f->buildPhotoURL($photo, $fs_thumb_size) .  "' width='".$fs_thumbs_width ."' height='" . $fs_thumbs_height  . "' alt='" .$photo['title']. "' />";
         echo "</a>";
        echo "</div>";


       };
     }else
          echo "<p>Cannot find flickr photo's.";

         echo "</div>";
         };

//start set_number show
if($fs_set_number){
 $photoset_id = $fs_set_number;

 if($preload_img == "true"){
     echo "<div class='flickrshowwrap'  preload='" . $preload_img . "'>"; }else{
       echo "<div class='flickrshowwrap'  >";
     };


  if($photoset_id){
  $photosets = $f->photosets_getPhotos($photoset_id,NULL, NULL, $fs_num_images);
    if($fs_showtitle == "true"){
     $setid = $f->photosets_getInfo($photoset_id);
     $owner = $setid['owner'];
     $ownerid = $f->people_getInfo($owner);
      echo "<span><h3>". $ownerid['username']." - " . $setid['title']. "</h3></span>";
      //print_r($ownerid['realname']);
      };

    foreach ($photosets['photoset']['photo'] as $sphoto) {
        echo "<div class='flickr-image' >";
       $sphotourl = $f->buildPhotoURL($sphoto, $image_size);
          $photoid = $f->photos_getInfo($sphoto['id']);
           $photosizes = $f->photos_getSizes($sphoto['id']);
        $photomed = $photosizes['4'];
        $photowidth =  $photomed['width'];
        $photoheight =  $photomed['height'];
       $photoarr = $photoid['photo'];
       $phototitle = $photoarr['title'];
       $photoviews = $photoarr['views'];
       $photoowner = $photoarr['owner'];
        $photousername = $photoowner['username'];
          $pid = $photoowner['nsid'];

         echo "<a href='".$sphotourl ."' title='" . $phototitle . "' user='" . $photousername . "' views='" . $photoviews . "' showinfo='" .$fs_showinfo . "' purl='http://www.flickr.com/photos/". $pid  . "' fswidth='" . $photowidth ."' fsheight='" . $photowidth . "'>";


          echo "<img class='fimg " . $fs_thumb_size . "' src='" . $f->buildPhotoURL($sphoto, $fs_thumb_size) .  "' width='".$fs_thumbs_width ."' height='" . $fs_thumbs_height  . "' alt='" .$sphoto['title']."'  />";
         echo "</a>";
        echo "</div>";


       };
     }else
          echo "<p>Cannot find flickr photo's.";

   echo "</div>";
};
      //echo "[flickrshow  flickrname='" . $fs_flickrname . "' set_number='" . $fs_set_number . "' search='" . $fs_search . "'  show_titles='" . $fs_showtitle . "' show_info='" . $fs_showinfo . "' thumb_size='" . $fs_thumb_size . "' num_images='" . $fs_num_images . "' ]";
      //end div tag wrap
      echo $after_widget;
  }


}
//add_action - regsiter the widget to the widget_init
add_action('widgets_init', 'register_fshow_widget');
function register_fshow_widget()
{
  //regsiter the class to be loaded
  register_widget('widget_flickrshow');
}
?>