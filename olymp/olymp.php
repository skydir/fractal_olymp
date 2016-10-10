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
	$ol=$_SESSION['Kodcur_ol'];
	$nom=$_SESSION['Nom'];
	$k=$_SESSION['KodStud'];
	$strSQL = "SELECT * FROM Vopr where KodOlympF='$ol' and Nom='$nom' ";
	$res = mysql_query($strSQL);
	//echo "<script> alert('$strSQL'); </script>";
	$newrow = mysql_fetch_array($res);
	$xx=$_SESSION['Kod_Proid'];
	$strSQL = "SELECT * FROM Otv where KodProidF='$xx' and Nom='$nom' ";
	$res = mysql_query($strSQL);
	$row22 = mysql_fetch_array($res);
	$nnn=$nom-1;
	//автоматическое завершение олимпиады
	if($_SESSION['end_time']<time())
	{
		echo "<script>alert('Время прохождения олимпиады истекло!');</script>";
		echo "<script>
		document.location.href = 'change7.php';
		</script>";
	}
	$end=$_SESSION['end_time'];
	
	
	$xcur_ol=$_SESSION['Kodcur_ol'];
	$strSQL = "SELECT * FROM `Olymp` where `KodOlymp`='$xcur_ol' ";
	$res = mysql_query($strSQL);
	$row = mysql_fetch_array($res);
	$vr=$row['Time']; //чч:мм
	// функция  explode()разбивает  строку другой строкой. В данном случае 
	// $access_date разбит на символе : 
	$vr_elements  = explode(":",$vr);
	$q1=3600*$vr_elements[0]+60*$vr_elements[1];
	$end=$_SESSION['end_time'];
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
</style>
</head>
<script>
	var handle=window.setInterval("time2()",1000);
	function save_otv()
	{
		select = document.getElementById("otv1"); // Выбираем  select по id
		value = select.value; // Значение value для выбранного option
		select2 = document.getElementById("cur_v"); // Выбираем  select по id
		value2 = select2.options[select2.selectedIndex].value; // Значение value для выбранного option
		text2 = select2.options[select2.selectedIndex].text; // Текстовое значение для выбранного option
		var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
		xmlhttp.open('POST', 'change5.php', true); // Открываем асинхронное соединение
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
		var str='xOtv1='+encodeURIComponent(value)+
		'&xNom='+encodeURIComponent(text2);
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
	function change_vopr()
	{
		select = document.getElementById("cur_v"); // Выбираем  select по id
		value = select.options[select.selectedIndex].value; // Значение value для выбранного option
		text = select.options[select.selectedIndex].text; // Текстовое значение для выбранного option
		//alert("Value: " + value + "\nТекст: " + text); // Вывод алерта для проверки значений
		var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
		xmlhttp.open('POST', 'change4.php', true); // Открываем асинхронное соединение
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
		var str='xNom='+encodeURIComponent(text);
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
	function setTime()
	{
		clearInterval(handle);
		window.setTimeout(time2,0);
		handle=setInterval(time2,1000);
	}
	function time2()
	{
		
		select = document.getElementById("end"); // Выбираем  select по id
		end=select.innerHTML; // Значение value для выбранного option
		time2 = new Date();
		time=time2.getTime()/1000;
		time=Math.trunc(time);
		ost=end-time;//в секундах
		thour=ost/3600;
		thour=Math.trunc(thour);
		if(thour<10)thour='0'+thour;
		ost=ost-thour*3600;
		tmin=ost/60;
		tmin=Math.trunc(tmin);
		if(tmin<10)tmin='0'+tmin;
		ost=ost-tmin*60;
		tsec=ost;
		if(tsec<10)tsec='0'+tsec;		
		timestr=thour+":"+tmin+":"+tsec;
		if(end-time>0)
		document.getElementById('t').innerHTML=timestr;
		else
		{
			clearInterval(handle);
			document.location.reload();
		}
		setTimeout(time2(),1000);
		//document.getElementById('cur').innerHTML=timestr;
		
/* 	
			<tr>
					<td>
						<input type="button" class="knopka" name="b1" value="Сохранить" onclick="save_otv()" />
					</td>
				</tr> */
	}
</script>
<body onload="setTime()" class="bd" >
	<table>	
		<tr>
			<td><div><img src="5.png"/></div></td> 
			<td><div id="nadpis">&nbsp &nbsp Интернет-олимпиады кружка "Фрактал"</div></td>
		</tr>
	</table>
<div id="end" style="visibility: hidden;"><?=$end?></div>
	<div id="centeredmenu">
		<ul>
			<!-- <li><a href="#" class="active">Вторая закладка</a></li>    style="visibility: hidden;" -->
			<li><a href="olymp.php"><div id="t"></div></a></li>
			<li><a href="olymp.php" class="active">Прохождение олимпиады</a></li>
			<li><a href="change7.php">Завершить олимпиаду</a></li>
		</ul>
	</div>
	<br></br>
	<div class="text_near_knopka" >Выбрать вопрос:
	<select class="combobox" id="cur_v" type=text name="cur_v" onchange="change_vopr()" > </div>
		<?php  	
		$ol=$_SESSION['Kodcur_ol'];
		$nom=$_SESSION['Nom'];
		$strSQL = "SELECT * FROM Vopr where KodOlympF='$ol' ";
		$res = mysql_query($strSQL);	
		while ($row11 = mysql_fetch_array($res)): 
		?> 
			<option  value=<?=$row11['KodVopr']?> ><p><?=$row11['Nom']?></p></option>
		<? endwhile ?> 	
	</select>
	<script>
		select = document.getElementById('cur_v');
		select.selectedIndex=<?=$nom-1?>;		//<input id="ocenka1" type="text" name="ocenka1" readonly value=<?=$newrow['Ocenka']?> /> </p>	
	</script>
		<tr>
			<td>
				<input type="button" class="knopka" name="b1" value="Сохранить ответ" onclick="save_otv()" />
			</td>
		</tr> 	
	<br>
	<div class="forma_vo">
		<form align="left" >
			<table class="vopros_otvet">
				<tr>
					<td>
						<p class="text_near_knopka" >Вопрос:</p><textarea id="vopr1" name="vopr1" rows="15" readonly class="pole_vvoda2" ><?=$newrow['Vopr']?></textarea>
					</td>
					<td>
						<p class="text_near_knopka">Введите в поле ниже ответ на вопрос:</p><textarea  id="otv1" rows="15" name="otv1" class="pole_vvoda2" ><?=$row22['Otv']?></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<p class="text_near_knopka" id="ocenka1"><?="Макс.балл за вопрос: ".$newrow['Ocenka']?></p>	
					</td>
				</tr>
			</table>
		</form>
	</div>
	<br></br>
	<br></br>
	<div id="footer" align="center">Кружки олимпиадной математики "Фрактал" &nbsp &nbsp 985-40-37 &nbsp &nbsp FRACTALCLUB@GMAIL.COM</div>	
</body>
</html>