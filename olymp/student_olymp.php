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
	$k=$_SESSION['KodPolz'];
	$strSQL = "SELECT * FROM Stud where KodPolzF='$k' ";
	$r = mysql_query($strSQL);	
	$row2 = mysql_fetch_array($r);
	$k=$row2['KodStud'];
	$_SESSION['KodStud']=$k;
	
	$strSQL = "SELECT * FROM Olymp where `Kol`>0 ";
	$rs = mysql_query($strSQL);	
	$rrr = mysql_query($strSQL);	
	
	$rs2=mysql_query($strSQL);	
	$rs3=mysql_query($strSQL);
	//$strSQL = "SELECT * FROM Olymp EXCEPT SELECT * FROM Proid where KodStud='$k' ";
	$rr = mysql_query($strSQL);	
	
		$flaggg=false;
		$strSQL = "SELECT * FROM Olymp where `Kol`>0 ";
		$res = mysql_query($strSQL);			
		while ($row11 = mysql_fetch_array($res))
		{
			$cur=time();
			$cur_date=date("Y-m-d");
			$start=$row11['Start'];
			$start_elements  = explode(".",$start);
			$m=$start_elements[1];
			$d=$start_elements[0];
			$y=$start_elements[2];
			$start_date = date("Y-m-d", mktime(0,0,0, $start_elements[1], $start_elements[0], $start_elements[2]  ));
			$end=$row11['End'];
			$end_elements  = explode(".",$end);
			$end_date = date("Y-m-d", mktime(0,0,0, $end_elements[1], $end_elements[0], $end_elements[2]  ));
			$result1=( $start < $cur_date );
			$result2=( $cur_date < $end_date );
			if($result1 && $result2 )
			{
				$w=$row11['KodOlymp'];
				$ww=$_SESSION['KodStud'];
				$strSQL = "SELECT * FROM Proid where KodOlympF='$w' and KodStudF='$ww'";
				$res2 = mysql_query($strSQL);
				if(!(mysql_num_rows($res2)>0))
				{
					$flaggg=true;
				}
			}
		}
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
	width: 100%;
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
<script>
	function olymp_start()
	{
		select = document.getElementById('cur_ol'); // Выбираем  select по id
		value = select.options[select.selectedIndex].value; // Значение value для выбранного option
		text = select.options[select.selectedIndex].text; // Текстовое значение для выбранного option
		//alert("Value: " + value + "\nТекст: " + text); // Вывод алерта для проверки значений
		var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
		xmlhttp.open('POST', 'change3.php', true); // Открываем асинхронное соединение
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
		var str='xcur_ol='+encodeURIComponent(value);
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
		document.location.href = 'olymp.php';
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
	<table>	
		<tr>
			<td><div><img src="5.png"/></div></td> 
			<td><div id="nadpis">&nbsp &nbsp Интернет-олимпиады кружка "Фрактал"</div></td>
		</tr>
	</table>
	<div id="centeredmenu">
		<ul>
			<!-- <li><a href="#" class="active">Вторая закладка</a></li> -->
			<li><a href="student_olymp.php" class="active">Олимпиады для прохождения</a></li>
			<li><a href="student_proid.php">Пройденные олимпиады</a></li>
			<li><a href="student_vse_olymp.php">Рейтинг по олимпиадам</a></li>
			<li><a href="logout.php">Выход</a></li>
		</ul>
	</div>
	<br></br>
	<?php
	if($flaggg)
	{
	?>
		<div class="text_near_knopka">Выбор олимпиады для прохождения среди доступных:</div>
		<select class="combobox" type=text id="cur_ol" > 
			<?php  	
			$strSQL = "SELECT * FROM Olymp where `Kol`>0 ";
			$res = mysql_query($strSQL);			
			while ($row11 = mysql_fetch_array($res)): 
				$cur=time();
				$cur_date=date("Y-m-d");
				$start=$row11['Start'];
				$start_elements  = explode(".",$start);
				$m=$start_elements[1];
				$d=$start_elements[0];
				$y=$start_elements[2];
				$start_date = date("Y-m-d", mktime(0,0,0, $start_elements[1], $start_elements[0], $start_elements[2]  ));
				$end=$row11['End'];
				$end_elements  = explode(".",$end);
				$end_date = date("Y-m-d", mktime(0,0,0, $end_elements[1], $end_elements[0], $end_elements[2]  ));
				$result1=( $start < $cur_date );
				$result2=( $cur_date < $end_date );
				if($result1 && $result2 )
				{
					$w=$row11['KodOlymp'];
					$ww=$_SESSION['KodStud'];
					$strSQL = "SELECT * FROM Proid where KodOlympF='$w' and KodStudF='$ww'";
					$res2 = mysql_query($strSQL);
					if(!(mysql_num_rows($res2)>0)){
			?> 
				<option  value=<?=$row11['KodOlymp']?> ><p><?=$row11['Nazv']?></p></option>
			<? } } endwhile ?> 	
		</select>
		<input type="button" onclick="olymp_start()" value="Пройти олимпиаду" class="knopka" />
		<div id="div1">
			<table class="StandardTable" align="center" border="1"> 
				<thead>
					<tr> 
						<th align="center"><p>Название</p></th>
						<th align="center"><p>Тип проверки</p></th> 
						<th align="center"><p>Кол-во вопросов</p></th>
						<th align="center"><p>Дата начала</p></th>
						<th align="center"><p>Дата окончания</p></th>
						<th align="center"><p>Время прохождения</p></th>
						<th align="center"><p>Макс. балл</p></th>
					</tr>
				</thead>
				<tbody>  	
			<?php  	
			$strSQL = "SELECT * FROM Olymp where `Kol`>0 ";
			$res = mysql_query($strSQL);			
			while ($row11 = mysql_fetch_array($res)): 
				$cur=time();
				$cur_date=date("Y-m-d");
				$start=$row11['Start'];
				$start_elements  = explode(".",$start);
				$m=$start_elements[1];
				$d=$start_elements[0];
				$y=$start_elements[2];
				$start_date = date("Y-m-d", mktime(0,0,0, $start_elements[1], $start_elements[0], $start_elements[2]  ));
				$end=$row11['End'];
				$end_elements  = explode(".",$end);
				$end_date = date("Y-m-d", mktime(0,0,0, $end_elements[1], $end_elements[0], $end_elements[2]  ));
				$result1=( $start < $cur_date );
				$result2=( $cur_date < $end_date );
				if($result1 && $result2 )
				{
					$w=$row11['KodOlymp'];
					$ww=$_SESSION['KodStud'];
					$strSQL = "SELECT * FROM Proid where KodOlympF='$w' and KodStudF='$ww'";
					$res2 = mysql_query($strSQL);
					if(!(mysql_num_rows($res2)>0)){
			
						if($row11['Tip']=='automat')
						$row11['Tip']='Автоматическая';
						else
						$row11['Tip']='Силами преподавателя';
				?> 
					<tr> 
						<td><p><?=$row11['Nazv']?></p></td> 
						<td><p><?=$row11['Tip']?></p></td>  
						<td class="pocentru"><p><?=$row11['Kol']?></p></td> 
						<td class="pocentru"><p><?=$row11['Start']?></p></td> 
						<td class="pocentru"><p><?=$row11['End']?></p></td> 
						<td class="pocentru"><p><?=$row11['Time']?></p></td> 
						<td class="pocentru"><p><?=$row11['Ocenka']?></p></td> 					
					</tr>
				<? } } endwhile ?> 	
				</tbody>
			</table>
		</div>
	<?php
	}
	else
	{
	?>
		<div class="text_near_knopka">На данный момент нет ни одной олимпиады для прохождения!</div>
	<?php
	}
	?>
	<br></br>
	<br></br>
	<div id="footer" align="center">Кружки олимпиадной математики "Фрактал" &nbsp &nbsp 985-40-37 &nbsp &nbsp FRACTALCLUB@GMAIL.COM</div>
</body>
</html>