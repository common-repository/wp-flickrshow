<?php
/* Last updated with phpFlickr 1.3.2
 *
 * This example file shows you how to call the 100 most recent public
 * photos.  It parses through them and prints out a link to each of them
 * along with the owner's name.
 *
 * Most of the processing time in this file comes from the 100 calls to
 * flickr.people.getInfo.  Enabling caching will help a whole lot with
 * this as there are many people who post multiple photos at once.
 *
 * Obviously, you'll want to replace the "<api key>" with one provided 
 * by Flickr: http://www.flickr.com/services/api/key.gne
 */

require_once("phpFlickr.php");
$f = new phpFlickr("37cf1f2fa11982618d2f061f3cc06543");
$f->enableCache("fs", "cache"); 
$recent = $f->people_findByUsername("nuvuscripts");
 $nsid = $recent["id"];
$photos = $f->people_getPublicPhotos($nsid, NULL, NULL, 21);
foreach ($photos['photos']['photo'] as $photo) {

  echo "<img src='" . $f->buildPhotoURL($photo, 'Square') .  "' width='75' height='75' alt='" .$photo[title]. "' />";


}
?>
