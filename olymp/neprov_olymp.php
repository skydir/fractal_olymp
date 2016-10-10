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
	$k=$_SESSION['KodPolz'];
	$qqq= "SELECT * FROM `Prep` where KodPolzF='$k' ";
	$rs=mysql_query($qqq);
	$row = mysql_fetch_array($rs);
	$_SESSION['KodPrep']=$row['KodPrep'];	
	$KodPrep=$_SESSION['KodPrep'];
	$KodOlymp=$_SESSION['KodOlymp'];
	
	
	$strSQL = "SELECT * FROM `Proid`  where `KodOlympF`='$KodOlymp' and `Ocenka`=-1 ";
	$vse_neprov_proid = mysql_query($strSQL);	
	$rs2=mysql_query($strSQL);	
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
	maxwidth: 100%;
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
.pole_vvoda2
{
	color: #000;
	word-wrap: break-word;
	font-size: 12pt;
	margin-left: 0;
	width: 100%;
	border-radius: 15px;
}
.vopros_otvet
{
	width: 100%;
}
.vopros_otvet tr td
{
	width:50%;
	
}
.pocentru
{
	text-align: center;
}
</style>
</head>
<script>
	function perehod()
	{
		select = document.getElementById("cur_stud"); // Выбираем  select по id
		value = select.options[select.selectedIndex].value; // Значение value для выбранного option
		text = select.options[select.selectedIndex].text; // Текстовое значение для выбранного option
		//alert("Value: " + value + "\nТекст: " + text); // Вывод алерта для проверки значений
		var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
		xmlhttp.open('POST', 'change11.php', true); // Открываем асинхронное соединение
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
		var str='xKodProid='+encodeURIComponent(value)+
		'&xFIO='+encodeURIComponent(text);
		xmlhttp.send(str); // Отправляем POST-запрос
		xmlhttp.onreadystatechange = 
		function() 
		{ // Ждём ответа от сервера
			if (xmlhttp.readyState == 4) { // Ответ пришёл
				if(xmlhttp.status == 200) { // Сервер вернул код 200 (что хорошо)
					if_ins_good=true;
				}
			}
		};	
		document.location.href = 'proverka.php';
	}
	function getXmlHttp() 
	{
		var xmlhttp;
		try 
		{
			xmlhttp = new ActiveXObject('Msxml2.XMLHTTP');
		} 
		catch (e) 
		{
			try 
			{
				xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
			} 
			catch (E) 
			{
			xmlhttp = false;
			}
		}	
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') 
		{
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
	}
</script>
<body class="bd">
	<?php 
	if(mysql_num_rows($rs2)==0)
	{
	    echo "<script>
		document.location.href = 'prepod_neprov_olymp.php';
		</script>";
	}
	?>	
	<table>	
		<tr>
			<td><div><img src="5.png"/></div></td> 
			<td><div id="nadpis">&nbsp &nbsp Интернет-олимпиады кружка "Фрактал"</div></td>
		</tr>
	</table>	
	<div id="centeredmenu">
		<ul>
			<!-- <li><a href="#" class="active">Вторая закладка</a></li> -->
			<li><a href="prepod_neprov_olymp.php">Назад</a></li>
			<li><a href="neprov_olymp.php" class="active">Проверка олимпиады "<?=$_SESSION['Nazv']?>"</a></li>
			<li><a href="logout.php">Выход</a></li>
		</ul>
	</div>
	<br><br><br>
	<div class="text_near_knopka">Выбранный ученик:
	<select class="combobox" id="cur_stud" type="text" > 
		<?php  	
		while ($row1 = mysql_fetch_array($vse_neprov_proid)): 
			$KodStud=$row1['KodStudF'];
			$query = "SELECT `FIO` FROM `Stud`  where `KodStud`='$KodStud' ";
			$stud = mysql_query($query);
			$row_stud =mysql_fetch_array($stud);
		?> 
			<option value=<?=$row1['KodProid']?> ><p><?=$row_stud['FIO']?></p></option>
		<? endwhile ?> 	
	</select>
 		<input class="knopka" id="b_change" type="button" value="Проверить олимпиаду выбранного ученика" onclick="perehod()" />
	</div>
	<div id="div1">
		<table class="StandardTable" align="center" border="1"> 
			<thead>
				<tr>
					<th><p>ФИО ученика</p></th> 
					<th><p>Класс</p></th>
				</tr>
			</thead>
			<tbody>
				<?php
				while ($row2 = mysql_fetch_array($rs2) ):
					$KodStud=$row2['KodStudF'];
					$query = "SELECT * FROM `Stud`  where `KodStud`='$KodStud' ";
					$stud = mysql_query($query);
					$row_stud =mysql_fetch_array($stud);				
				?> 
					<tr> 
						<td><p><?=$row_stud['FIO']?></p></td> 
						<td class="pocentru"><p><?=$row_stud['Class']?></p></td>						
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