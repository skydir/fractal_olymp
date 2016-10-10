<?php 
	session_start();
	mysql_connect("localhost", "root", "") or die (mysql_error ());
	mysql_select_db("olymp") or die(mysql_error());
	$log=$_POST['Login'];
	$pas=$_POST['password'];
	$strSQL = "SELECT * FROM Polz where Login='$log' and Pswd='$pas'";
	$rs = mysql_query($strSQL);
	if( mysql_num_rows($rs)==0)
	{
		session_destroy();
		echo "
		<script>
		alert('Данные введены неверно!Повторите ввод снова!');
		document.location.href = 'index.html';
		</script>";
	}
	else
	{
		$row = mysql_fetch_array($rs);
		
		$_SESSION['Tip'] = $row['Tip'];
		$_SESSION['KodPolz'] = $row['KodPolz'];
		switch($row['Tip']) 
		{
			case 'admin':
				echo "
				<script>
				document.location.href = 'admin_prepodavateli.php';
				</script>";
				break;
			case 'prepod':
				echo "
				<script>
				document.location.href = 'prepod_olymp.php';
				</script>";
				break;
			case 'student':
				echo "
				<script>
				document.location.href = 'student_olymp.php';
				</script>";
				break;
			default:
				session_destroy();
				echo "
				<script>
				alert('Не известно, кем Вы являетесь! Повторите ввод снова!');
				document.location.href = 'index.html';
				</script>";
		}
	}
	mysql_close();
?>
<html>

<head>
<meta charset="utf-8">
<title>Вход в систему</title>

</head>
<body>
</body>
</html>