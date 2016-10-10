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
	$KodOlymp=$_SESSION['KodOlymp'];
	$str = "SELECT * FROM `Olymp` where `KodOlymp`='$KodOlymp' ";
	$res111 = mysql_query($str);	
	$row222 = mysql_fetch_array($res111);
	$Nazv=$row222['Nazv'];	
?>
<html>
<head>
<meta charset="utf-8">
<title>Фрактал: Интернет-олимпиады</title>
  <style>
#centeredmenu {
   float:right;
   width:100%;
   border-bottom:4px solid #000080;
   overflow:hidden;
   position:relative;
   background: #F7FDFD;
}
#centeredmenu ul {
   clear:right;
   float:right;
   list-style:none;
   margin:0;
   padding:0;
   position:relative;
   right:0%;
   text-align:center;
}
#centeredmenu ul li {
   display:block;
   float:left;
   list-style:none;
   margin:0;
   padding:0;
   position:relative;
   right:0%;
}
#centeredmenu ul li a {
   display:block;
   margin:0 0 0 1px;
   padding:3px 10px;
   background:#6495ED;
   color:#fff;
   text-decoration:none;
   line-height:1.3em;
   font-weight:bold;
}
#centeredmenu ul li a:hover {
   background:#369;
   color:#fff;
}
#centeredmenu ul li a.active,
#centeredmenu ul li a.active:hover {
   color:#fff;
   background:#000080;
   font-weight:bold;
}
.StandardTable
{
	//border-collapse: collapse;
	border-radius: 10px;
	border-spacing: 0;
	border: 1px solid #6495ED;
	maxwidth:100%;
}
.StandardTable tbody 
{
    background-color: #E9F2FB;
}
.StandardTable th
{
    background: #000080; 
	color: white;
	font-weight:bold;
	font-size: 13pt;
	border: 1px solid #6495ED;
}
.StandardTable th:first-child 
{
	border-top-left-radius: 10px;
}
.StandardTable th:last-child 
{
	border-top-right-radius: 10px;
}
.StandardTable tr:last-child td:first-child 
{
	border-radius: 0 0 0 10px;
}
.StandardTable tr:last-child td:last-child 
{
	border-radius: 0 0 10px 0;
}
.StandardTable tbody tr td
{
	padding: 10px 30px;
	font-size: 13pt;
	word-wrap: break-word;
	border: 1px solid #6495ED;
}
#footer 
{
    position: fixed; /* Фиксированное положение */
    left: 0; 
	bottom: 0; 
	padding: 5px; /* Поля вокруг текста */
    background: #6495ED; /* Цвет фона */
    color: #fff; /* Цвет текста */
    width: 100%; /* Ширина слоя */  
}
.bd
{
	background: #F7FDFD;
	margin-left: 15%;
	position: absolute;
	width: 70%;
}
#nadpis
{
	color: #000080;
	font-style: italic; /* Курсивное начертание */
	font-weight: 600;
	font-size: 25pt;
}
.combobox
{
	word-wrap: break-word;
	font-size: 13pt;
	background: #F7FDFD;//#E9F2FB;
	border-color: #6495ED;
	border-style: inset;
}
.text_near_knopka
{
	color: #000080;
	font-weight:bold;
	word-wrap: break-word;
	font-size: 16pt;
	margin-bottom: 10px;
}
.knopka
{
	border-radius: 5px;
	border-style: inset;
	background: #E9F2FB;
    color: #000080;
	border-color: #6495ED;
	border-width: 1px;
	font-size: 13pt;
	font-weight:bold;
	margin-bottom: 20px;
}
.pocentru
{
	text-align: center;
}
</style>
</head>
<body class="bd">
	<table>	
		<tr>
			<td><div><img src="5.png"/></div></td> 
			<td><div id="nadpis">&nbsp &nbsp Интернет-олимпиады кружка "Фрактал"</div></td>
		</tr>
	</table>
	<div id="centeredmenu">
		<ul>
			<!-- <li><a href="#" class="active">Вторая закладка</a></li> -->
			<li><a href="student_proid.php">Назад</a></li>
			<li><a href="student_proid_res.php" class="active">Результаты олипиады "<?=$Nazv?>"</a></li>
			<li><a href="logout.php">Выход</a></li>
		</ul>
	</div> 
	<br></br>
	<br></br>
	<div id="div1">
		<table class="StandardTable" align="center" border="1"> 
			<thead>
				<tr>
					<th><p>Номер вопроса</p></th>
					<th><p>Оценка</p></th>
					<th><p>Макс. балл</p></th>
				</tr>
			</thead>
			<tbody>
			<?php
	$KodStud=$_SESSION['KodStud'];
	$str = "SELECT * FROM `Proid` where `KodOlympF`='$KodOlymp' and `KodStudF`='$KodStud' ";
	$res111 = mysql_query($str);	
	$row222 = mysql_fetch_array($res111);
	$KodProid=$row222['KodProid'];
	
	$strSQL3 = "SELECT * FROM Vopr where KodOlympF='$KodOlymp' ";
	$res3 = mysql_query($strSQL3);
	
	$strSQL = "SELECT * FROM Otv where KodProidF='$KodProid' ";
	$res = mysql_query($strSQL);			
			
			while ($row = mysql_fetch_array($res)):
				$row3 = mysql_fetch_array($res3);
				if($row['Ocenka']==-1)
				{
					$sss="Вопрос ещё не проверен";
					}
				else
				{
					$sss=$row['Ocenka'];
					}
			?> 
				<tr class="pocentru"> 
					<td><p><?=$row3['Nom']?></p></td> 
					<td><p><?=$sss?></p></td> 
					<td><p><?=$row3['Ocenka']?></p></td>					
				</tr>
			<? endwhile ?> 
			</tbody>
		</table>
	</div>
	<br></br>
	<br></br>
	<div id="footer" align="center">Кружки олимпиадной математики "Фрактал" &nbsp &nbsp 985-40-37 &nbsp &nbsp FRACTALCLUB@GMAIL.COM</div>		
</body>
</html>