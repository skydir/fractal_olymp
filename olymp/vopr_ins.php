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
	$xvopr1=$_POST['xvopr1'];
	$xotv1=$_POST['xotv1'];
	$xocenka1=$_POST['xocenka1'];
	$k=$_SESSION['KodOlymp'];
	$strSQL = "SELECT * FROM `Vopr` where `KodOlympF`='$k' ";
	$rs = mysql_query($strSQL);
	$c = mysql_num_rows($rs);
	$c++;
	$query = "INSERT INTO `Vopr` (`KodOlympF`, `Vopr`, `Otv`, `Nom`, `Ocenka`) VALUES ('$k','$xvopr1','$xotv1','$c','$xocenka1')";
	mysql_query($query);
	$query= "UPDATE Olymp set `Kol`=`Kol`+1 , `Ocenka`=`Ocenka`+'$xocenka1' where KodOlymp='$k' ";
	mysql_query($query);
?>