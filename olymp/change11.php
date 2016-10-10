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
	$xKodProid=$_POST['xKodProid'];
	$xFIO=$_POST['xFIO'];
	$_SESSION['KodProid']=$xKodProid;
	$_SESSION['FIO']=$xFIO;
	$_SESSION['Nom']=1;
?>