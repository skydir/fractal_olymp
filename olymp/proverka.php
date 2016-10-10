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
	$KodOlymp=$_SESSION['KodOlymp'];
	$KodProid=$_SESSION['KodProid'];
	//$NomOcenka=$_SESSION['NomOcenka'];
	$Nom=$_SESSION['Nom'];
	$strSQL = "SELECT * FROM Otv where KodProidF='$KodProid' and Nom='$Nom' ";
	$otvet_res = mysql_query($strSQL);
	$otvet_row = mysql_fetch_array($otvet_res);	
	
	$strSQL = "SELECT * FROM Vopr where KodOlympF='$KodOlymp' and Nom='$Nom' ";
	$vopr_res = mysql_query($strSQL);
	$vopr_row = mysql_fetch_array($vopr_res);
	
	if($otvet_row['Ocenka']>0)
	{
		$ocenka=$otvet_row['Ocenka'];
	}
	else{$ocenka=0;}
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
.pole_vvoda
{
	color: #000080;
	font-weight:bold;
	word-wrap: break-word;
	font-size: 23pt;
	margin-left: 15%;
	width: 70%;
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

.vnutri_forma_vvoda
{
	margin-left: 2%;
	margin-right: 2%;
	margin-top: 2%;
	margin-bottom: 2%;
}
#tbl
{
	width: 100%;
}
#tbl tr td:first-child
{
	width: 10%;
}
.pole_vvoda3
{
	color: #000;
	word-wrap: break-word;
	font-size: 12pt;
	margin-left: 0;
	width: 20%;
	border-radius: 15px;
}
.knopka3
{
	border-radius: 5px;
	border-style: inset;
	background: #F7FDFD;//#E9F2FB;
    color: #000080;
	border-color: #6495ED;
	border-width: 1px;
	font-size: 14pt;
	font-weight:bold;
	margin-bottom: 0%;
	margin-left: 0%;
}
.text_near_knopka4
{
	color: #000080;
	word-wrap: break-word;
	font-weight: 600;
	font-size: 14pt;
	margin-bottom: 10px;
	margin-left: 28%;
}
.text_near_knopka5
{
	color: #E30000;
	word-wrap: break-word;
	font-weight: 600;
	font-size: 10pt;
	margin-top: 10px;
	margin-left: 0%;
	width: 100%;
}
.text_near_knopka3
{
	color: #000080;
	word-wrap: break-word;
	font-weight: 600;
	font-size: 14pt;
	margin-bottom: 10px;
	margin-left: 0%;
	//width: 40%;
}
.forma_vvoda
{
	border-radius: 35px;
	border-style: solid;
	border-width: 5px;
	border-color: #6495ED;
	background: #E9F2FB;
	margin-left: 0%;
	margin-right: 0%;
	margin-bottom: 7%;
	margin-top: 1%;
}
</style>
</head>
<script>
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
	function change_vopr()
	{
		select = document.getElementById("cur_v"); // Выбираем  select по id
		value = select.options[select.selectedIndex].value; // Значение value для выбранного option
		text = select.options[select.selectedIndex].text; // Текстовое значение для выбранного option	
		select2 = document.getElementById("cur_ocenka"); // Выбираем  select по id
		value2 = select2.options[select2.selectedIndex].value; // Значение value для выбранного option
		text2 = select2.options[select2.selectedIndex].text; // Текстовое значение для выбранного option
		var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
		xmlhttp.open('POST', 'change12.php', true); // Открываем асинхронное соединение
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку		
		var str='xOcenka='+encodeURIComponent(value2)+
		'&xNom='+encodeURIComponent(text);
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
	function change_ocenka()
	{
		select = document.getElementById("cur_v"); // Выбираем  select по id
		value = select.options[select.selectedIndex].value; // Значение value для выбранного option
		text = select.options[select.selectedIndex].text; // Текстовое значение для выбранного option	
		select2 = document.getElementById("cur_ocenka"); // Выбираем  select по id
		value2 = select2.options[select2.selectedIndex].value; // Значение value для выбранного option
		text2 = select2.options[select2.selectedIndex].text; // Текстовое значение для выбранного option
		var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
		xmlhttp.open('POST', 'change12.php', true); // Открываем асинхронное соединение
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку		
		var str='xOcenka='+encodeURIComponent(value2)+
		'&xNom='+encodeURIComponent(text);
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
	if(typeof(EventSource) !== "undefined") 
	{
		var source = new EventSource("proverka.php");
		source.onopen = function() 
		{
			//document.getElementById("myH1").innerHTML = "Getting server updates";
			//change_ocenka();
			select = document.getElementById('cur_v');
			select.selectedIndex=0;
		};
		source.onmessage = function(event) 
		{
			document.getElementById("myDIV").innerHTML += event.data + "<br>";
		};
	} 
	else 
	{
		//document.getElementById("myDIV").innerHTML = "Sorry, your browser does not s";
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
			<li><a href="neprov_olymp.php">Назад</a></li>
			<li><a href="proverka.php" class="active">Проверка олимпиады "<?=$_SESSION['Nazv']?>" ученика "<?=$_SESSION['FIO']?>"</a></li>
			<li><a href="change13.php">Завершить проверку</a></li>
			<li><a href="logout.php">Выход</a></li>
		</ul>
	</div>
	<br></br>
	<div class="text_near_knopka" >Выбрать вопрос:
	<select class="combobox" id="cur_v" type=text name="cur_v" onchange=change_vopr() > </div>
		<?php  	
		$ol=$_SESSION['KodOlymp'];
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
	<div class="forma_vvoda">
		<form align="left">
			<div class="vnutri_forma_vvoda">
				<table align="center">
					<tr>
						<td align="right" >
							<div class="text_near_knopka" >Установить кол-во набранных за ответ баллов:
							<select class="combobox" id="cur_ocenka" type="text" onchange="change_ocenka()" > </div>
								<?php  	
								$temp=-1;
								while ($temp <= $vopr_row['Ocenka']): 
									$temp++;
								?> 
									<option  value=<?=$temp?> ><p><?=$temp?></p></option>
								<? endwhile ?> 	
							</select>
							<script>
								select = document.getElementById('cur_ocenka');
								select.selectedIndex=<?=$ocenka ?>;
							</script>						
						</td>
					</tr>
				</table>			
				<table id="tbl">
					<tr>
						<td align="right" valign="top">
							<p class="text_near_knopka3">Вопрос: </p>
						</td>
						<td>
							<textarea class="pole_vvoda2" id="vopr" rows="5" readonly class="pole_vvoda2" ><?=$vopr_row['Vopr']?></textarea>
						</td>
					</tr>					
					<tr>
						<td align="right" valign="top">
							<p class="text_near_knopka3">Правильный ответ: </p>
						</td>
						<td>
							<textarea class="pole_vvoda2" id="pravotv" rows="5" readonly class="pole_vvoda2" ><?=$vopr_row['Otv']?></textarea>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top">							
							<p class="text_near_knopka3">Ответ ученика: </p>
						</td>
						<td>
							<textarea class="pole_vvoda2" id="otv" rows="5" readonly class="pole_vvoda2" ><?=$otvet_row['Otv']?></textarea>
						</td>
					</tr>
					</tr>				
				</table>
			</div>
		</form>
	</div>
	<div id="footer" align="center">Кружки олимпиадной математики "Фрактал" &nbsp &nbsp 985-40-37 &nbsp &nbsp FRACTALCLUB@GMAIL.COM</div>		
</body>
</html>