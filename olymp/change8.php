<?php 
	session_start();
	if( !isset($_SESSION['KodPrep']) || $_SESSION['Tip']!="admin") 
    { 
        echo "<script>
		document.location.href = 'logout.php';
		</script>";
    }	
	mysql_connect("localhost", "root", "") or die (mysql_error ());
	mysql_select_db("olymp") or die(mysql_error());
	$xKodPrep=$_POST['xKodPrep'];
	$xFIO=$_POST['xFIO'];
	$_SESSION['KodPrep']=$xKodPrep;
	$_SESSION['FIO']=$xFIO;
?>