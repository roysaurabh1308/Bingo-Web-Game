<head>
<title>Winn page</title>
<style>
input[type=submit] {
    width: 10em;  height: 10em;
}
</style>
</head>
<br>
<?php
if(isset($_POST["start"]) && !empty($_POST["start"]))
{
	$myfile = fopen("access.txt", "w") or die("Unable to open file!");
	fwrite($myfile,"000.000.000.000;111.111.111.111");
	fclose($myfile);
	header("location: http://".$_SERVER['SERVER_ADDR']);
    exit();
}
$afile = fopen("access.txt", "r") or die("Unable to open file!");
$rd=fread($afile,filesize("access.txt"));
fclose($afile);
$deny = explode(";",$rd);
$afile = fopen("turn.txt", "r") or die("Unable to open file!");
$ts=fread($afile,filesize("turn.txt"));
$tw=explode(";",$ts);
fclose($afile);
for($x=1;$x<sizeof($tw);$x++){
echo "<h1>Winner is: ".$tw[$x]."<br>";
}
if(sizeof($deny)!=2)
{
for($x=1;$x<sizeof($tw);$x++){
if($_SERVER['REMOTE_ADDR']==$deny[$tw[$x]+2])
{
	echo "<h1><font color='green'>Congrats You win....</font></h1>";
}
else
{
	echo "<h1><font color='red'>Better luck next time....</font></h1>";
}
}
}

?>
<form action="?" method="POST" enctype="multipart/form-data">
<p align="center"><input type="submit" width="200" name="start" value="Play again.."/></p>
</form>