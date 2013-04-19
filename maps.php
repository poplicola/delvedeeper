<?php include('header.php'); ?>

<div style="margin-top:-100px;"></div>

<div id="mapsheader">
	<center>
		<h1>Want to submit a map?</h1>
		<h2>Check out our <a href="http://www.lunargiantstudios.com/blog/delve-deeper-map-editor-guide-introduction">Editing Guide</a>. Create a map using our editing tools, then upload it <a href="mapsuploader.php">here</a>.</h2>
	</center>
</div>

<?php
	require ('includes/config.php');
	require ('includes/dbconnect.php');
	require ('includes/functions.php');
	$query = sprintf("SELECT * FROM map");
	// Send it to the database
	$result = mysql_query($query, $link) or die(mysql_error());
	
	while($row = mysql_fetch_array($result)) {
		$username = $row['username'];
		$image = $row['image'];
		$map = $row['map'];
		$mappath = $path_to_maps . $map;
		$caption = stripslashes($row['caption']);
		$body = stripslashes($row['body']);
		$username = preg_replace('/<(.*)/', '', $username);
		$imagepath = $path_to_midsized_directory;
		$append='...';
		if(strlen($body) > 140) {
	    	$body = substr($body, 0, 140);
	        $body .= $append;
	     }

		list($width, $height, $type, $attr) = getimagesize($imagepath . $image);
		$imagetag = '<img src="' . $imagepath . $image . '"' . $attr . ' alt="' . $caption . '" />';
		echo "<div class=\"mapthumbnail\">";
		echo "<h2>" . $caption . "</h2>";
		echo "<div class=\"imgwrapper\"><a href=\"" . $path_to_fullsized_directory . $image . "\">" . $imagetag . "</a></div>";
		echo "<div class=\"detail\">" . $body;
		echo "<div style=\"clear:both;margin-top:10px;\"><span style=\"color:#3d3d3d;\">map by</span> " . $username . "</div></div>";
		echo "<div class=\"dl\" onclick=\"location.href='" . $mappath . "'\"><a href=\"" . $mappath . "\">Download</a></div>";
		echo "</div>";
	}
?>

<?php include('footer.php'); ?>