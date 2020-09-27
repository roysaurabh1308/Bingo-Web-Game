<?php
if(isset($_POST["start"]) && !empty($_POST["start"]))
{
	echo $_POST["start"];
}
?>

<form action="?" method="POST" enctype="multipart/form-data">
<p><input type="submit" name="start" value="Upload"/></p>
</form>
<meta http-equiv="refresh" content="4"/>