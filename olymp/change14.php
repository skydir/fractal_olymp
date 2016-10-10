<?php 
	session_start();
	if( !isset($_SESSION['KodPolz']) || !($_SESSION['Tip']=="prepod" || $_SESSION['Tip']=="student" ) ) 
    { 
        echo "<script>
		document.location.href = 'logout.php';
		</script>";
    }	
	mysql_connect("localhost", "root", "") or die (mysql_error ());
	mysql_select_db("olymp") or die(mysql_error());
	$xKodOlymp=$_POST['xKodOlymp'];
	$xNazv=$_POST['xNazv'];
	$_SESSION['KodOlymp']=$xKodOlymp;
	$_SESSION['Nazv']=$xNazv;
?>