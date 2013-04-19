<?php
	// Set MySQL variables host , username , password
	$mysql_host = 'localhost';
	$mysql_user = 'USER';
	$mysql_password = 'PASSWORD';
	$mysql_database = "MAPS";
	
	// Directory where the uploaded images are going to be placed, relative to the upload processing page
	// Remember to chmod this folder to allow write access, if necessary
	$path_to_originals_directory = 'assets/original/'; // location of original image
	$path_to_fullsized_directory = 'assets/800/'; // image
	$path_to_midsized_directory = 'assets/320/'; // image
	$path_to_thumbs_directory = 'assets/thumbs/'; // image
	$path_to_maps = 'assets/maps/'; //maps

	$small_thumb_width = 100; /* this is the max width of the small thumbnail, or width and height for square thumbnails */
	$midsized_thumb_width = 260; /* this is the max width of the mid-sized thumbnail */
	$fullsized_thumb_width = 800; /* this is the max width of the full-sized thumbnail */

	$midsized_thumb_quality = 80; /* this is the quality of the mid-sized thumbnail */
	$fullsized_thumb_quality = 100; /* this is the quality of the full-sized thumbnail */
	
	// Salt for password encryption
	$salt = 'r1A';

	//error_reporting(E_ALL);  All errors and warnings, as supported, except of level E_STRICT in PHP < 6. 
//	error_reporting(E_DEPRECATED); // Run-time notices. Enable this to receive warnings about code that will not work in future versions.
?>