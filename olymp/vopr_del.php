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
	$k=$_SESSION['KodOlymp'];
	$kk=$_POST['xKodVopr'];
	$strSQL = "SELECT * FROM `Vopr` where `KodVopr`='$kk' ";
	$rs = mysql_query($strSQL);	
	echo "alert('Сообщение отправлено!');</script>";
	$row = mysql_fetch_array($rs);
	$xocenka1=$row['Ocenka'];
	$query= "UPDATE `Olymp` SET `Ocenka`=`Ocenka`-'$xocenka1' , `Kol`=`Kol`-1  where `KodOlymp`='$k' ";
	mysql_query($query);
	$query= "DELETE FROM `Vopr` where `KodVopr`='$kk' ";
	mysql_query($query);	
	
	$strSQL = "SELECT * FROM `Vopr` where `KodOlympF`='$k' ";
	$ree = mysql_query($strSQL);	
	$n=0;
	while ($roww = mysql_fetch_array($ree) )
	{
		$n=$n+1;
		$aa=$roww['KodVopr'];
		$strSQL2 = "UPDATE `Vopr` SET `Nom`='$n' where `KodVopr`='$aa' ";
		mysql_query($strSQL2);	
	}
	$_SESSION['KodVopr']=1;
?>