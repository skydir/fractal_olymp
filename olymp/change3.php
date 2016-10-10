<?php 
	session_start();
	if( !isset($_SESSION['KodPolz']) || $_SESSION['Tip']!="student") 
    { 
        echo "<script>document.location.href = 'logout.php';</script>";
    }	
	mysql_connect("localhost", "root", "") or die (mysql_error ());
	mysql_select_db("olymp") or die(mysql_error());
	$xcur_ol=$_POST['xcur_ol'];
	$_SESSION['Kodcur_ol']=$xcur_ol;
	$k=$_SESSION['KodStud'];
	$strSQL = "INSERT INTO `Proid` (`KodOlympF`, `KodStudF`, `Ocenka`) VALUES ('$xcur_ol','$k','0' )";
	$res = mysql_query($strSQL);
	
	
	$strSQL = "SELECT * FROM `Olymp` where `KodOlymp`='$xcur_ol' ";
	$res = mysql_query($strSQL);
	$ww = mysql_fetch_array($res);
	$_SESSION['TipOlymp']=$ww['Tip'];
	
	
	$strSQL = "SELECT * FROM Proid where KodStudF='$k' and KodOlympF='$xcur_ol' ";
	$res = mysql_query($strSQL);
	$row = mysql_fetch_array($res);
	$_SESSION['Kod_Proid']=$row['KodProid'];
	$qq=$_SESSION['Kod_Proid'];
	
	$strSQL = "SELECT * FROM Vopr where KodOlympF='$xcur_ol'";
	$res = mysql_query($strSQL);	
	$n=0;
	$col=mysql_num_rows($res);
	while ($n<$col)
	{
		$n=$n+1;
		$p="";
		$strSQL = "INSERT INTO `Otv` (`KodProidF`, `Otv`, `Ocenka`, `Nom`) VALUES ('$qq','$p','0' , '$n' )";
		mysql_query($strSQL);
	}
	$_SESSION['Nom']=1;
	
	$strSQL = "SELECT * FROM `Olymp` where `KodOlymp`='$xcur_ol' ";
	$res = mysql_query($strSQL);
	$row = mysql_fetch_array($res);
	$vr=$row['Time']; //чч:мм
	// функция  explode()разбивает  строку другой строкой. В данном случае 
	// $access_date разбит на символе : 
	$vr_elements  = explode(":",$vr);
	$_SESSION['end_time']=time()+3600*$vr_elements[0]+60*$vr_elements[1];//в секундах
	//$_SESSION['end_time_str']=$vr;
?>