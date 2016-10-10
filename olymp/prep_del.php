<?php 
	session_start();
	if( !isset($_SESSION['KodPolz']) || $_SESSION['Tip']!="admin") 
    { 
        echo "<script>
		document.location.href = 'logout.php';
		</script>";
    }	
	mysql_connect("localhost", "root", "") or die (mysql_error ());
	mysql_select_db("olymp") or die(mysql_error());	
	$KodPrep=$_POST['xKodPrep'];
	$qqq= "SELECT * FROM `Prep` where KodPrep='$KodPrep' ";
	$rs=mysql_query($qqq);
	$row = mysql_fetch_array($rs);
	$KodPolz=$row['KodPolzF'];	
	$query_vse_olymp= "SELECT * FROM `Olymp` where `KodPrepF`='$KodPrep' ";
	$vse_olymp=mysql_query($query_vse_olymp);
	while($row_cur_olymp=mysql_fetch_array($vse_olymp) )
	{
		$KodOlymp=$row_cur_olymp['KodOlymp'];
		$query_vse_proid= "SELECT * FROM `Proid` where `KodOlympF`='$KodOlymp' ";
		$vse_proid=mysql_query($query_vse_proid);
		while($row_cur_proid=mysql_fetch_array($vse_proid) )
		{
			$KodProid=$row_cur_proid['KodProid'];
			$query= "DELETE FROM `Otv` where `KodProidF`='$KodProid' ";
			mysql_query($query);
		}
		$query= "DELETE FROM `Vopr` where `KodOlympF`='$KodOlymp' ";
		mysql_query($query);
		$query= "DELETE FROM `Proid` where `KodOlympF`='$KodOlymp' ";
		mysql_query($query);
	}
	$query= "DELETE FROM `Olymp` where `KodOlymp`='$KodOlymp' ";
	mysql_query($query);
	$query= "DELETE FROM `Prep` where `KodPrep`='$KodPrep' ";
	mysql_query($query);
	$query= "DELETE FROM `Polz` where `KodPolz`='$KodPolz' ";
	mysql_query($query);
?>