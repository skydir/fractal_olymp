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
	$xlogin1=$_POST['xlogin1'];
	$xfio1=$_POST['xfio1'];
	$xkontakt1=$_POST['xkontakt1'];
	$xclass1=$_POST['xclass1'];
	$xmesto1=$_POST['xmesto1'];
	$xpassword1=$_POST['xpassword1'];
	
	$k=$_SESSION['KodStud'];
	$qqq= "SELECT * FROM `Stud` where KodStud='$k' ";
	$rs=mysql_query($qqq);
	$row = mysql_fetch_array($rs);
	$qq=$row['KodPolz'];	
	$query= "UPDATE Stud set `FIO`='$xfio1' , `Kontakt`='$xkontakt1' , `Class`='$xclass1' , `Mesto`='$xmesto1' where KodStud='$k' ";
	mysql_query($query);
	$query= "UPDATE Polz set `Login`='$xlogin1' , `Pswd`='$xpassword1' where KodPolz='$qq' ";
	mysql_query($query);	
?>