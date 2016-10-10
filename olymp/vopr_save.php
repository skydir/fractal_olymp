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
	$kk=$_SESSION['KodVopr'];
	$qqq= "SELECT * FROM Vopr where KodVopr='$xvopr1' ";
	$rs=mysql_query($qqq);
	$row = mysql_fetch_array($rs);
	$qq=$row['Ocenka'];
	$query= "UPDATE Olymp set `Ocenka`=`Ocenka`-'$qq'+'$xocenka1' where KodOlymp='$k' ";
	mysql_query($query);
	$query= "UPDATE Vopr set `Ocenka`='$xocenka1' , `Vopr`='$xvopr1' , `Otv`='$xotv1' where KodVopr='$kk' ";
	mysql_query($query);	
?>