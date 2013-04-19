<?php
	include('header.php');
	require ('includes/config.php');
	require ('includes/dbconnect.php');
	require ('includes/functions.php');
	
	if(get_magic_quotes_gpc()) {
	    if($_POST['mapname']) { $mapname = stripslashes(htmlspecialchars($_POST['mapname'], ENT_QUOTES)); }
	    if($_POST['author']) { $author = stripslashes(htmlspecialchars($_POST['author'], ENT_QUOTES)); }
	    if($_POST['description']) { $description = stripslashes(htmlspecialchars($_POST['description'], ENT_QUOTES)); }
	} else {
	    if($_POST['mapname']) { $mapname = htmlspecialchars($_POST['mapname'], ENT_QUOTES); }
	    if($_POST['author']) { $author = htmlspecialchars($_POST['author'], ENT_QUOTES); }
	    if($_POST['description']) { $description = htmlspecialchars($_POST['description'], ENT_QUOTES); }
	}
	
	$screenshot = process_upload($_FILES['screenshot']);

	if (isset($_FILES['map'])) {
		$map = $_FILES['map']['name'];
		$extension = strtolower(strrchr($map, '.'));
		$name_on_server = substr(uniqid(md5(rand())), 0, 10) . $extension;
		$maploc = $path_to_maps . $name_on_server;
		$map = move_uploaded_file($_FILES['map']['tmp_name'], $maploc);
	}
	
	$query = sprintf("INSERT INTO map (username, image, map, caption, body) VALUES ('%s', '%s', '%s', '%s', '%s')",
	mysql_real_escape_string($author, $link),
	mysql_real_escape_string($screenshot, $link),
	mysql_real_escape_string($name_on_server, $link),
	mysql_real_escape_string($mapname, $link),
	mysql_real_escape_string($description, $link));

	// Send it to the database
	$result = mysql_query($query, $link) or die(mysql_error());
?>


<div style="margin-top:-100px;"></div>

<div id="mapsheader">
	<center>
		<h1>Map successfully submitted.</h1>
		<h2>Feel free to <a href="maps.php">head on back over</a> to the Delve Deeper Maps site.</h2>
	</center>
</div>

<?php include('footer.php'); ?>