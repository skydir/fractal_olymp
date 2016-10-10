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
	$KodStud=$_SESSION['KodStud'];
	$ol=$_SESSION['Kodcur_ol'];
	$KodProid=$_SESSION['Kod_Proid'];
	$TipOlymp=$_SESSION['TipOlymp'];

	$str="SELECT * FROM `Otv` where `KodProidF`='$KodProid' ";
	$res1 = mysql_query($str);
	$strSQL2 = "SELECT * FROM `Vopr` where `KodOlympF`='$ol' ";
	$res2 = mysql_query($strSQL2);	
	$n=0;
	while ($row2 = mysql_fetch_array($res2))
	{
		$n++;
		$row1 = mysql_fetch_array($res1);
		$xocenka=$row2['Ocenka'];
		$prav_otv=$row2['Otv'];
		$stud_otv=$row1['Otv'];
		if($TipOlymp=="automat")
		{
			if($prav_otv == $stud_otv)
			{
				$query= "UPDATE `Otv` set `Ocenka`='$xocenka' where `KodProidF`='$KodProid' and `Nom`='$n' ";
				mysql_query($query);
				$query= "UPDATE `Proid` set `Ocenka`=`Ocenka`+'$xocenka' where `KodProid`='$KodProid' ";
				mysql_query($query);
			}
		}
		else
		{
			$query= "UPDATE `Proid` set `Ocenka`=-1 where `KodProid`='$KodProid' ";
			mysql_query($query);		
			$query= "UPDATE `Otv` set `Ocenka`=-1 where `KodProidF`='$KodProid' and `Nom`='$n' ";
			mysql_query($query);			
		}
	}
	
	
	
/* 	if($TipOlymp=="automat")
	{
		$str="SELECT * FROM `Otv` where `KodProidF`='$KodProid' ";
		$res1 = mysql_query($str);
		$strSQL2 = "SELECT * FROM `Vopr` where `KodOlympF`='$ol' ";
		$res2 = mysql_query($strSQL2);	
		$n=0;
		while ($row2 = mysql_fetch_array($res2))
		{
			$n++;
			$row1 = mysql_fetch_array($res1);
			$xocenka=$row2['Ocenka'];
			$prav_otv=$row2['Otv'];
			$stud_otv=$row1['Otv'];
			if($prav_otv == $stud_otv)
			{
				$query= "UPDATE `Otv` set `Ocenka`='$xocenka' where `KodProidF`='$KodProid' and `Nom`='$n' ";
				mysql_query($query);
				$query= "UPDATE `Proid` set `Ocenka`=`Ocenka`+'$xocenka' where `KodProid`='$KodProid' ";
				mysql_query($query);
			}
		}
	
	}
	else
	{
		$query= "UPDATE `Proid` set `Ocenka`=-1 where `KodProid`='$KodProid' ";
		mysql_query($query);
	}	 */
	unset($_SESSION['Kodcur_ol']);
	unset($_SESSION['Kod_Proid']);
	unset($_SESSION['TipOlymp']);
	unset($_SESSION['end_time']);
	unset($_SESSION['Nom']);	
	echo "
	<script>
	document.location.href = 'student_proid.php';
	</script>";
?> 