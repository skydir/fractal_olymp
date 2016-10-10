<?php 
	session_start();
	if( !isset($_SESSION['KodPolz']) || $_SESSION['Tip']!="admin") 
    { 
        echo "<script>
		document.location.href = 'logout.php';
		</script>";
    }	
	mysql_connect("localhost", "root", "") or die (mysql_error ());
	mysql_select_db("olymp") or die(mysql_error());
	$xtip1=$_POST['xtip1'];
	
	if($xtip1=='prepod')
	{
		$xlogin1=$_POST['xlogin1'];
		$xfio1=$_POST['xfio1'];
		$xkontakt1=$_POST['xkontakt1'];
		$xinfo1=$_POST['xinfo1'];
		$xpassword1=$_POST['xpassword1'];
		$query = "INSERT INTO `Polz`(`Login`, `Pswd`, `Tip`) VALUES ('$xlogin1','$xpassword1','prepod')";
		mysql_query($query);
		$srt=$query;
		$strSQL = "SELECT * FROM Polz where Login='$xlogin1'";
		$rs = mysql_query($strSQL);
		$row = mysql_fetch_array($rs);
		$r=$row['KodPolz'];
		$query = "INSERT INTO `Prep`(`KodPolzF`, `FIO`, `Kontakt`, `Info` ) VALUES ( '$r' , '$xfio1' , '$xkontakt1' , '$xinfo1' )";
		mysql_query($query);
	}
	else if($xtip1=='student')
	{
		$xlogin1=$_POST['xlogin1'];
		$xfio1=$_POST['xfio1'];
		$xkontakt1=$_POST['xkontakt1'];
		$xclass1=$_POST['xclass1'];
		$xmesto1=$_POST['xmesto1'];
		$xpassword1=$_POST['xpassword1'];	
		$query = "INSERT INTO `Polz`(`Login`, `Pswd`, `Tip`) VALUES ('$xlogin1','$xpassword1','student')";
		mysql_query($query);
		$srt=$query;
		$strSQL = "SELECT * FROM Polz where Login='$xlogin1'";
		$rs = mysql_query($strSQL);
		$row = mysql_fetch_array($rs);
		$r=$row['KodPolz'];
		$query = "INSERT INTO `Stud`(`KodPolzF`, `FIO`, `Kontakt`, `Class`, `Mesto` ) VALUES ( '$r' , '$xfio1' , '$xkontakt1' , '$xclass1', '$xmesto1' )";
		mysql_query($query);
	}	
	else if($xtip1=='admin')
	{
		$query = "INSERT INTO `Polz`(`Login`, `Pswd`, `Tip`) VALUES ('$xlogin1','$xpassword1','prepod')";
		mysql_query($query);
		$srt=$query;
		$strSQL = "SELECT * FROM Polz where Login='$xlogin1'";
		$rs = mysql_query($strSQL);
		$row = mysql_fetch_array($rs);
		$r=$row['KodPolz'];
		$query = "INSERT INTO `Prep`(`KodPolzF`, `FIO`, `Kontakt`, `Info` ) VALUES ( '$r' , '$xfio1' , '$xkontakt1' , '$xinfo1' )";
		mysql_query($query);
	}	
?>