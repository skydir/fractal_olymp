<?php 
	session_start();
	if( !isset($_SESSION['KodPolz']) || $_SESSION['Tip']!="prepod") 
    { 
        echo "<script>
		document.location.href = 'logout.php';
		</script>";
    }	
	mysql_connect("localhost", "root", "") or die (mysql_error ());
	mysql_select_db("olymp") or die(mysql_error());
	$xtip=$_POST['xtip'];
	$xstart1=$_POST['xstart1'];
	$xend1=$_POST['xend1'];
	$xvremya1=$_POST['xvremya1'];
	$xnazv1=$_POST['xnazv1'];
	$k=$_SESSION['KodPolz'];
	$strSQL = "SELECT * FROM Prep where KodPolzF='$k' ";
	$rs = mysql_query($strSQL);
	$row = mysql_fetch_array($rs);
	$r=$row['KodPrep'];
	$q=$_SESSION['KodOlymp'];
	$query = "UPDATE `Olymp` set `Tip`='$xtip' , `Start`='$xstart1' , `End`='$xend1' , `Time`='$xvremya1' , `Nazv`='$xnazv1' where `KodOlymp`='$q' ";
	mysql_query($query);
?>