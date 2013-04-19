#!/usr/bin/php -q
<?php
$fd = fopen("php://stdin", "r");
$email = "";
while (!feof($fd)) {
    $email .= fread($fd, 1024);
}
fclose($fd);

require ('includes/config.php');
require ('includes/dbconnect.php');
require ('includes/functions.php');
include ('Mail/mimeDecode.php');

//setting all standard mimeDecode parameters to true, allowing it to look through entire email
$params['include_bodies'] = true;
$params['decode_bodies'] = true;
$params['decode_headers'] = true;
$params['input'] = $email;

//applying mimeDecode functions to email (params, headers, etc)
$decoder = new Mail_mimeDecode($email);
$structure = $decoder->decode($params);

//loops through attachments to pull filename and save attachment down to server

foreach ($structure->parts as $part){
    if (isset($part->disposition) && ($part->disposition=='attachment')) {
        $fp = fopen($part->d_parameters['filename'], 'w');
        fwrite($fp, $part->body);
        fclose($fp);
	}
	if ($part->ctype_primary=='image') {
		$attachment = $part->ctype_parameters['name'];
	}
	if ($part->ctype_primary=='application') {
		$map = $part->ctype_parameters['name'];
	}
	if(count($part->parts)>0) {  
		foreach($part->parts as $sp) {  
			if(strpos($sp->headers['content-type'],'text/plain')!==false)  
				$plain = $sp->body;  
			if(strpos($sp->headers['content-type'],'text/html')!==false)  
				$html = $sp->body;  
		}  
	} else {  
		if(strpos($part->headers['content-type'],'text/plain')!==false)  
			$plain = $part->body;  
		if(strpos($part->headers['content-type'],'text/html')!==false)  
			$html = $part->body;  
	}
}

$caption = $structure->headers['subject'];
$from = $structure->headers['from'];
		
// Generate a unique filename for the image and create the thumbnails
if (isset($attachment)) {
	$filename = process_screen($attachment);
}
if (isset($map)) {
	$processedmap = process_map($map);
}

// Escape special characters in a string for use in a SQL statement
$query = sprintf("INSERT INTO map (username, image, map, caption, body) VALUES ('%s', '%s', '%s', '%s', '%s')",
mysql_real_escape_string($from, $link),
mysql_real_escape_string($filename, $link),
mysql_real_escape_string($processedmap, $link),
mysql_real_escape_string($caption, $link),
mysql_real_escape_string($plain, $link));

// Send it to the database
$result = mysql_query($query, $link) or die(mysql_error());

$thumbnail = $path_to_midsized_directory . $filename;
list($width, $height, $type, $attr) = getimagesize($thumbnail);

mail($from, 'Success! Your map is now on the Delve Deeper Map Sharer.', 'Thank you for posting to our website.');
?>