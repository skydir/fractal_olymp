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
	$q=$_SESSION['KodOlymp'];
	$strSQL = "SELECT * FROM Vopr where kodOlymp='$q'";
	$rs = mysql_query($strSQL);	
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
	margin-left: 5%;
}
.forma_vvoda2
{
	
	border-radius: 35px;
	border-style: solid;
	border-width: 5px;
	border-color: #6495ED;
	background: #E9F2FB;
	margin-left: 0%;
	margin-right: 0%;
	margin-bottom: 5%;
	margin-top: 10%;
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
	margin-left: 5%;
	width: 90%;
	border-radius: 15px;
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
	var if_ins_good=false;
	function Sel_Change()
	{
		var xvopr1 = document.getElementById('vopr1').value;//берем значение из элемента с id=
		var xotv1 = document.getElementById('otv1').value;
		var xocenka1 = document.getElementById('ocenka1').value;
		var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
		xmlhttp.open('POST', 'vopr_ins.php', true); // Открываем асинхронное соединение
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
		var str='xvopr1='+encodeURIComponent(xvopr1)+
		'&xotv1='+encodeURIComponent(xotv1)+
		'&xocenka1='+encodeURIComponent(xocenka1);
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
//Добавить
	function b1_click()
	{
		var if_good=true;
		//здесь могла бы быть проверка
		//добавляем
		if(if_good)
		{
			Sel_Change();
			if(!if_ins_good)
			{
				document.location.href = 'prepod_olymp_red.php';
			}
			else
			{
				alert("Возникла ошибка при добавлении!");
				document.location.href = 'prepod_olymp_red.php';
			}	
		}
	}
//Отмена
	function b2_click()
	{
		document.location.href = 'prepod_olymp_red.php';
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
			<li><a href="prepod_olymp_red.php">Назад</a></li>
			<li><a href="prepod_olymp_insert.php" class="active">Добавление нового вопроса</a></li>
			<li><a href="logout.php">Выход</a></li>
		</ul>
	</div>
	<div class="forma_vvoda2">
		<form align="left">
			<table class="vopros_otvet">
				<tr>
					<td>
						<p class="text_near_knopka" class="text_near_knopka" >Вопрос:</p><textarea class="pole_vvoda2" id="vopr1" name="vopr1" rows="10" cols="45" ></textarea>
					</td>
					<td>
						<p class="text_near_knopka" class="text_near_knopka">Правильный ответ:</p><textarea class="pole_vvoda2" id="otv1" name="otv1" rows="10" cols="45" ></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<p class="text_near_knopka" ><br>Макс.балл за вопрос: <input class="pole_vvoda3" id="ocenka1" type="text" name="ocenka1"  /></p>	
					</td>
				</tr>
			</table>			
			<table align="center">
				<tr>
					<td>
						<input class="knopka" type="button" name="b1" value="Добавить" onclick="b1_click()" />
					</td>
					<td>
						<input class="knopka" type="button" name="b2" value="Отмена" onclick="b2_click()" />
					</td>
				</tr>
			</table>
		</form>
	</div>
	<br>
	<div id="footer" align="center">Кружки олимпиадной математики "Фрактал" &nbsp &nbsp 985-40-37 &nbsp &nbsp FRACTALCLUB@GMAIL.COM</div>		
</body>
</html>