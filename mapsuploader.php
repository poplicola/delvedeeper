<?php include('header.php'); ?>

<div style="margin-top:-100px;"></div>

<div id="mapsheader">
	<center>
		<h1>Submit your map</h1>
	</center>
</div>

	<form enctype="multipart/form-data" id="mapsuploader" action="process.php" method="post"> 
	    <table>
			<tr>
				<td class="label">Map Name:</td>
				<td><input type="text" name="mapname" class="required" /></td>
			</tr>
			<tr>
				<td class="label">Author:</td>
				<td><input type="text" name="author" class="required" /></td>
			</tr>
			<tr>
				<td class="label">Map:</td>
				<td><input type="file" name="map" class="required" /></td>
			</tr>
			<tr>
				<td class="label">Screenshot:</td>
				<td><input type="file" name="screenshot" class="required" /></td>
			</tr>
			<tr>
				<td class="label">Map Description:</td>
				<td><textarea name="description" class="required"></textarea></td>
			</tr>
			<tr>
				<td colspan="2" class="label"><input type="submit" value="Submit Map" /></td>
			</tr>
		</table>
	</form>

<?php include('footer.php'); ?>