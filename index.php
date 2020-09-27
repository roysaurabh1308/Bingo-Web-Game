<?php
	$myfile = fopen("access.txt", "r") or die("Unable to open file!");
	$rd=fread($myfile,filesize("access.txt"));
	fclose($myfile);
    $deny = explode(";",$rd);
	echo "Nunber of players yet: ".(sizeof($deny)-2)."<br>";
	if(sizeof($deny)==7){
    if (!in_array ($_SERVER['REMOTE_ADDR'], $deny)) {
       header("location: http://".$_SERVER['SERVER_ADDR']."/denied.html");
       exit();
    }
	else
	{
		$main=array();
		for($j=0;$j<5;$j++)
		{
			$name=$j.".txt";
			$sfile = fopen($name, "w") or die("Unable to open file!");
			for($i=1;$i<26;$i++)
			{
				$main[]=$i;
			}
			
			for($i=0;$i<25;$i++)
			{
				$r=array_rand($main);
				$temp=$main[$r]."-r;";
				fwrite($sfile, $temp);
				$main=array_diff($main,array($main[$r]));
			}
			fclose($sfile);
		}
		$mefile = fopen("turn.txt", "w") or die("Unable to open file!");
		fwrite($mefile,"0;9");
		fclose($mefile);
		header("location: http://".$_SERVER['SERVER_ADDR']."/Test.php");
		exit();
	}
	}
	else if (!in_array ($_SERVER['REMOTE_ADDR'], $deny))
	{
		$mfile = fopen("access.txt", "a") or die("Unable to open file!");
		$txt=";".$_SERVER['REMOTE_ADDR'];
		fwrite($mfile, $txt);
		fclose($mfile);
		echo "You are added...";
		if(sizeof($deny)!=6)
		{
		echo "Waiting for other players...";
		}
		else
		{
			echo "Redirecting to page......<br>please wait..";
		}
	}
?>
<html>
<meta http-equiv="refresh" content="1.5">
</html>