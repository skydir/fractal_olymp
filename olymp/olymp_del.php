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
	$KodOlymp=$_POST['xKodOlymp'];	
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
	$query= "DELETE FROM `Olymp` where `KodOlymp`='$KodOlymp' ";
	mysql_query($query);		
?>