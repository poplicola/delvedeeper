<!DOCTYPE html>

<html>

<head>
<meta charset="UTF-8">
<title>Delve Deeper by Lunar Giant Studios - A New Action/Strategy Video Game for PC and XBOX</title>
<meta name="description" content="Delve Deeper is a Adventure/Strategy game which pits you against monsters as you and up to three rival teams build an ever-changing dungeon map and compete to pilfer its loot as quickly as possible.">
</head>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/shadowbox.css">
<link rel="icon" href="favicon.ico" type="image/x-icon" />

<script src="js/modernizr-1.5.min.js"></script>
<script src="js/jquery-1.4.2.min.js"></script>
<script src="js/jquery.carousel.min.js"></script>
<script src="js/shadowbox.js"></script>
<script src="js/jquery.validate.min.js"></script>

<script type="text/javascript">
    $(function(){
        $("section.acclaim").carousel({ autoSlide:true, autoSlideInterval:4000, effect:"fade" });
    });
</script>

<script type="text/javascript">
	Shadowbox.init({ displayNav:true });
</script>

<script>
	$(document).ready(function(){
		$("#mapsuploader").validate({
			rules: {
				map: {
					required: true,
					accept: "map"
				},
				screenshot: {
					required: true,
					accept: "png|jpe?g|gif"
				}
			}
		});
	});
</script>

<body>
	<section class="mapshare">
		<div class="main">
			<center><strong>NEW!!</strong> <a href="maps.php">DELVE DEEPER MAP SHARING</a> <strong>>></strong></center>
		</div>
	</section>
	<div id="content">
		<div class="main">