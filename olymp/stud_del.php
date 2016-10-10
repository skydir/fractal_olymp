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
	$KodStud=$_POST['xKodStud'];
	$qqq= "SELECT * FROM `Stud` where KodStud='$KodStud' ";
	$rs=mysql_query($qqq);
	$row = mysql_fetch_array($rs);
	$KodPolz=$row['KodPolzF'];
	$query_vse_proid= "SELECT * FROM `Proid` where `KodStudF`='$KodStud' ";
	$vse_proid=mysql_query($query_vse_proid);
	while($row_cur_proid=mysql_fetch_array($vse_proid) )
	{
		$KodProid=$row_cur_proid['KodProid'];
		$query= "DELETE FROM `Otv` where `KodProidF`='$KodProid' ";
		mysql_query($query);
	}
	$query= "DELETE FROM `Proid` where `KodStudF`='$KodStud' ";
	mysql_query($query);
	$query= "DELETE FROM `Stud` where `KodStud`='$KodStud' ";
	mysql_query($query);
	$query= "DELETE FROM `Polz` where `KodPolz`='$KodPolz' ";
	mysql_query($query);
?>