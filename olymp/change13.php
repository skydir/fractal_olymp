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
	$KodProid=$_SESSION['KodProid'];

	$str="SELECT * FROM `Otv` where `KodProidF`='$KodProid' ";
	$res1 = mysql_query($str);
	$summa=0;
	while ($row1 = mysql_fetch_array($res1))
	{
		$summa=$summa+$row1['Ocenka'];
	}
	$query= "UPDATE `Proid` set `Ocenka`='$summa' where `KodProid`='$KodProid' ";
	mysql_query($query);		
		
	unset($_SESSION['KodNom']);
	unset($_SESSION['Kod_Proid']);
	unset($_SESSION['TipOlymp']);
	unset($_SESSION['end_time']);
	unset($_SESSION['FIO']);
	unset($_SESSION['Nom']);
	echo "
	<script>
	document.location.href = 'neprov_olymp.php';
	</script>";
?> 