<?php
function createThumbnail($filename, $tmpfile, $width=100, $path_to_output_directory=assets, $quality=90, $square=false) {
	// $filename = the original file's name
	// $tmpfile = the path and name of the uploaded php tmp file (or an image file)
	// $width = the max width of the small thumbnail if rectangular, or width and height for square thumbnails
	// $path_to_output_directory = self explanatory
	// $quality = image quality
	// $square = true/false, should the thumbnail be square?
	
	// Save the desination (path + filename) for the thumbnail to a variable
	$destination = $path_to_output_directory . $filename;
	
	// Find out what kind of image this and accomodate
	$extension = strtolower(strrchr($filename, '.'));
	if ($extension == ".jpg") {
		$img = imagecreatefromjpeg($tmpfile);
	} else if ($extension == ".gif") {
		$img = imagecreatefromgif($tmpfile);
	} else if ($extension == ".png") {
		$img = imagecreatefrompng($tmpfile);
	}
	if (!$img) {
		echo "ERROR: Could not create image handle " . $tmpfile;
		exit(0);
	}
	
	$ox = imagesx($img);
	$oy = imagesy($img);
	$xpos = 0;
	$ypos = 0;
	
	$nx = $width;
	
	if ($square && $ox != $oy) {
		// If this is to be a square thumbnail, and it's not already square
		$ny = $width;
		// Check for orientation (horizontal or vertical)
		if ($ox > $oy) {
			// If horizontal
			$xpos = ceil(($ox - $oy) / 2);
			$ypos = 0;
			$ox = $oy;
		}else{
			// If vertical
			$ypos = ceil(($oy - $ox) / 2);
			$xpos = 0;
			$oy = $ox;
		}
	}else{
		$ny = floor($oy * ($width / $ox));
	}
	
	$nm = imagecreatetruecolor($nx, $ny);
	
	imagecopyresampled($nm, $img, 0, 0, $xpos, $ypos, $nx, $ny, $ox, $oy);
	
	if(!file_exists($path_to_output_directory)) {
	  if(!mkdir($path_to_output_directory)) {
           die("There was a problem. Please try again!");
	  } 
    }
	   
	// Output the image
	imagejpeg($nm, $destination, $quality);
	
	// Free up memory
	imagedestroy($nm);
	
//	$tn = '<img src="' . $destination . '" alt="image" />';
//	$tn .= '<br />Congratulations. Your file has been successfully uploaded, and a thumbnail has been created.';
//	echo $tn;

	// Return the path to the image, including the filename
	return $destination;
	
	// Return the data
//	return $nm;
}

function process_upload($file) {
	require ('includes/config.php'); 

	// Extract the extension and save it as a variable
	$extension = strtolower(strrchr($file["name"], '.'));
	
	// Get the size of the image
	$size = getimagesize($file["tmp_name"]);
	
	// Create a new name for the file from a random string
	$name_on_server = substr(uniqid(md5(rand())), 0, 10) . $extension;
	
	// Generate a small thumbnail
	createThumbnail($name_on_server, $file["tmp_name"], $small_thumb_width, $path_to_thumbs_directory, $midsized_thumb_quality, $square=true);
	
	// Generate a mid-sized thumbnail, resizing it down if it is larger than midsized_thumb_width
	if ($size[0] > $midsized_thumb_width) {
		createThumbnail($name_on_server, $file["tmp_name"], $midsized_thumb_width, $path_to_midsized_directory, $midsized_thumb_quality);
	} else {
		createThumbnail($name_on_server, $file["tmp_name"], $size[0], $path_to_midsized_directory, $midsized_thumb_quality);
	}
	
	// Generate a large thumbnail, resizing it down if it is larger than fullsized_thumb_width
	if ($size[0] > $fullsized_thumb_width) {
		createThumbnail($name_on_server, $file["tmp_name"], $fullsized_thumb_width, $path_to_fullsized_directory, $fullsized_thumb_quality);
	} else {
		createThumbnail($name_on_server, $file["tmp_name"], $size[0], $path_to_fullsized_directory, $fullsized_thumb_quality);
	}
	
	// Move the uploaded file to the original files folder
	move_uploaded_file($file["tmp_name"], $path_to_originals_directory . $name_on_server);
	
	// Return the uploaded file's name
	return $name_on_server;
}

function process_screen($filename) {
	require ('includes/config.php'); 

	// Extract the extension and save it as a variable
	$extension = strtolower(strrchr($filename, '.'));
	
	// Get the size of the image
	$size = getimagesize($filename);
	
	// Create a new name for the file from a random string
	$name_on_server = substr(uniqid(md5(rand())), 0, 10) . $extension;
	
	// Generate a small thumbnail
	createThumbnail($name_on_server, $filename, $small_thumb_width, $path_to_thumbs_directory, $midsized_thumb_quality, $square=true);
	
	// Generate a mid-sized thumbnail, resizing it down if it is larger than midsized_thumb_width
	if ($size[0] > $midsized_thumb_width) {
		createThumbnail($name_on_server, $filename, $midsized_thumb_width, $path_to_midsized_directory, $midsized_thumb_quality);
	} else {
		createThumbnail($name_on_server, $filename, $size[0], $path_to_midsized_directory, $midsized_thumb_quality);
	}
	
	// Generate a large thumbnail, resizing it down if it is larger than fullsized_thumb_width
	if ($size[0] > $fullsized_thumb_width) {
		createThumbnail($name_on_server, $filename, $fullsized_thumb_width, $path_to_fullsized_directory, $fullsized_thumb_quality);
	} else {
		createThumbnail($name_on_server, $filename, $size[0], $path_to_fullsized_directory, $fullsized_thumb_quality);
	}
	
	// Move the uploaded file to the original files folder
	rename($filename, $path_to_originals_directory . $name_on_server);
	
	// Return the uploaded file's name
	return $name_on_server;
}

function process_map($map) {
	require ('includes/config.php');
	
	$extension = strtolower(strrchr($map, '.'));
	$name_on_server = substr(uniqid(md5(rand())), 0, 10) . $extension;
	$maploc = $path_to_maps . $name_on_server;
	$map = rename($map, $maploc);
	return $name_on_server;
}
?>