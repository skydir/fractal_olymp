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
	$xoldNom=$_SESSION['Nom'];
	$KodProid=$_SESSION['KodProid'];
	$xOcenka=$_POST['xOcenka'];
	$query= "UPDATE Otv set `Ocenka`='$xOcenka' where KodProidF='$KodProid' and `Nom`='$xoldNom' ";
	$xNom=$_POST['xNom'];
	$_SESSION['Nom']=$xNom;
	mysql_query($query);	
?>