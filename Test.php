
<html>
<head>
<title>Bingo: The game</title>
<style>
table { table-layout: fixed;
border: 3px solid black;
width: 30%; }
td { width: 20%;
border: 1px solid black; }
</style>
</head>
<body>
<h1 align="center">
Game is Onn....
</h1>
<br><br><br><br><br><br><br><br><br><br><br>
<center>
<form action="?" method="POST" enctype="multipart/form-data">
<table>
<?php
$afile = fopen("turn.txt", "r") or die("Unable to open file!");
$ts=fread($afile,filesize("turn.txt"));
$tw=explode(";",$ts);
fclose($afile);
if($tw[1]!="9")
{
	header("location: http://".$_SERVER['SERVER_ADDR']."/win.php");
	exit();
}
echo "<h2><font color='purple'>Turn of: ".$tw[0]."</font></h2>";
	$myfile = fopen("access.txt", "r") or die("Unable to open file!");
	$rd=fread($myfile,filesize("access.txt"));
	fclose($myfile);
    $deny = explode(";",$rd);
	
	if (!in_array ($_SERVER['REMOTE_ADDR'], $deny)) {
       header("location: http://".$_SERVER['SERVER_ADDR']."/denied.html");
       exit();
    }

if($_SERVER['REMOTE_ADDR']==$deny[$tw[0]+2])
{
	echo "<h1><font color='green'>Oh It's Your Turn....</font></h1>";
}
else
{
	echo "<h1><font color='red'>Please wait for your turn....</font></h1>";
}
$All_con=array(
array(
array(0,0,0,0,0),0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)
);

$check=array(
array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)
);

for($j=0;$j<5;$j++)
{
	$nam=$j.".txt";
	$mfile = fopen($nam, "r") or die("Unable to open file!");
	$dat=fread($mfile,filesize($nam));
	fclose($mfile);
	$val = explode(";",$dat);
	for($i=0;$i<25;$i++)
	{
		$r=explode("-",$val[$i]);
		$All_con[$j][$i]=$r[0];
		$check[$j][$i]=$r[1];
	}
}
if(isset($_POST["start"]) && !empty($_POST["start"]))
{
	for($j=0;$j<5;$j++)
	{
		for($i=0;$i<25;$i++)
		{
			if($All_con[$j][$i]==$_POST["start"])
			{
				$check[$j][$i]="g";
				break;
			}
		}
	}
	for($j=0;$j<5;$j++)
	{
		$name=$j.".txt";
		$sfile = fopen($name, "w") or die("Unable to open file!");
		for($i=0;$i<25;$i++)
		{
			$temp = $All_con[$j][$i]."-".$check[$j][$i].";";
			fwrite($sfile, $temp);
		}
		fclose($sfile);
	}
	$ch=0;
	$v=($tw[0]+1)%5;
	$bfile = fopen("turn.txt", "w") or die("Unable to open file!");
	fwrite($bfile,$v);
	//fwrite($bfile,"4");
	fclose($bfile);
	for($x=0;$x<5;$x++){
	$cv=0;
	$y=($tw[0]+$x)%5;
	for($j=0;$j<5;$j++)
	{
		for($i=$j*5;$i<$j*5+5;$i++)
		{
			if($check[$y][$i]=="r")
			{
				break;
			}
		}
		if($i==$j*5+5)
		{
			$cv=1;
		}
	}
	if($cv!=1){
	for($j=0;$j<5;$j++)
	{
		for($i=$j;$i<25;$i=$i+5)
		{
			if($check[$y][$i]=="r")
			{
				break;
			}
		}
		if($i==$j+25)
		{
			$cv=1;
		}
	}
	if($cv==0){
	for($j=0;$j<25;$j=$j+6)
	{
		if($check[$y][$j]=="r")
		{
			break;
		}
	}
	if($j==30)
	{
		$cv=1;
	}
	if($cv==0)
	{
		for($j=4;$j<21;$j=$j+4)
		{
			if($check[$y][$j]=="r")
			{
				break;
			}
		}
		if($j==24)
		{
			$cv=1;
		}
	}
	}
	}
if($cv==1)
{
	$ch=1;
	$bfile = fopen("turn.txt", "a") or die("Unable to open file!");
	fwrite($bfile,";".$y);
	fclose($bfile);
}

}
if($ch==0)
{
	$bfile = fopen("turn.txt", "a") or die("Unable to open file!");
	fwrite($bfile,";9");
	fclose($bfile);
}
}
for($k=0;$k<5;$k++){
if($_SERVER['REMOTE_ADDR']==$deny[$k+2]){
for($j=0;$j<5;$j++)
{
	
		echo "<tr>"."\n";
		for($i=$j*5;$i<$j*5+5;$i++)
		{
			if($k==$tw[0])
			{
				$var="start";
			}
			else{
				$var="nope";
			}
			if($check[$k][$i]=="r")
			{
				$colo="orange";
			}
			else
			{
				$colo="green";
			}
			echo "<td height='60' bgcolor='".$colo."'><center><input type='submit' name='".$var."' value='".$All_con[$k][$i]."'/><center></td>"."\n";
		}
		echo "</tr>"."\n";
}
}
}
?>
</form>
<meta http-equiv="refresh" content="2.5">