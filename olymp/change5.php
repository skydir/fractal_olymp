<?php 
	session_start();
	if( !isset($_SESSION['KodPolz']) || $_SESSION['Tip']!="student") 
    { 
        echo "<script>
		document.location.href = 'logout.php';
		</script>";
    }	
	mysql_connect("localhost", "root", "") or die (mysql_error ());
	mysql_select_db("olymp") or die(mysql_error());
	$xNom=$_POST['xNom'];
	$xOtv1=$_POST['xOtv1'];
	$qq=$_SESSION['Kod_Proid'];
	$query= "UPDATE Otv set `Otv`='$xOtv1' where KodProidF='$qq' and `Nom`='$xNom' ";
	mysql_query($query);
	//$_SESSION['start_time']=time();
?>