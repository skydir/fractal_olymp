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
	$q=$_SESSION['KodPrep'];
	$strSQL = "SELECT * FROM `Prep` where `KodPrep`='$q'";
	$rs = mysql_query($strSQL);	
	$row = mysql_fetch_array($rs); 
	
	$qq=$row['KodPolzF'];
	$strSQL = "SELECT * FROM `Polz` where `KodPolz`='$qq'";
	$rs1 = mysql_query($strSQL);	
	$row1 = mysql_fetch_array($rs1); 	
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
.vnutri_forma_vvoda
{
	margin-left: 5%;
	margin-right: 5%;
	margin-top: 5%;
}
#tbl
{
	width: 100%;
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
	margin-bottom: 20px;
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
	margin-left: 15%;
	margin-right: 15%;
	margin-bottom: 5%;
	margin-top: 5%;
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
</style>
</head>
<script>
	var if_ins_good=false;
	function Sel_Change()
	{
		var xlogin1 = document.getElementById('login1').value;//берем значение из элемента с id=
		var xfio1 = document.getElementById('fio1').value;
		var xkontakt1 = document.getElementById('kontakt1').value;
		var xinfo1 = document.getElementById('info1').value;
		var xpassword1 = document.getElementById('password1').value;
		var xtip1 = 'prepod';
		var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
		xmlhttp.open('POST', 'prep_save.php', true); // Открываем асинхронное соединение
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
		var str='xlogin1='+encodeURIComponent(xlogin1)+
		'&xfio1='+encodeURIComponent(xfio1)+
		'&xkontakt1='+encodeURIComponent(xkontakt1)+
		'&xinfo1='+encodeURIComponent(xinfo1)+
		'&xpassword1='+encodeURIComponent(xpassword1);
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
				document.location.href = 'admin_prepodavateli.php';
			}
			else
			{
				alert("Возникла ошибка при редактировании!");
				document.location.href = 'admin_prepodavateli.php';
			}	
		}
	}
//Отмена
	function b2_click()
	{
		document.location.href = 'admin_prepodavateli.php';
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
			<li><a href="admin_prepodavateli.php">Назад</a></li>
			<li><a href="admin_prepodavateli_red.php" class="active">Редактирование преподавателя</a></li>
			<li><a href="logout.php">Выход</a></li>
		</ul>
	</div>
	<br></br>
	<div class="forma_vvoda">
		<form align="left">
			<div class="vnutri_forma_vvoda">
				<table id="tbl">
					<tr>
						<td align="right" valign="top">
							<p class="text_near_knopka3">Логин: </p>
						</td>
						<td>
							<input class="pole_vvoda2" id="login1" type="text" name="login1" value='<?=$row1['Login']?>' />
							<div  class="text_near_knopka5" id="d1"></div>
						</td>
					</tr>					
					<tr>
						<td align="right" valign="top">
							<p class="text_near_knopka3">ФИО: </p>
						</td>
						<td>
							<input class="pole_vvoda2" id="fio1" type="text" name="fio1" value='<?=$row['FIO']?>' />
						</td>
					</tr>
					<tr>
						<td align="right" valign="top">							
							<p class="text_near_knopka3">Контакты: </p>
						</td>
						<td>
							<textarea class="pole_vvoda2" id="kontakt1" rows="2"  ><?=$row['Kontakt']?></textarea>
							<div  class="text_near_knopka5" id="d3"></div>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top">							
							<p class="text_near_knopka3">Информация: </p>
						</td>
						<td>
							<textarea class="pole_vvoda2" id="info1" rows="2"  ><?=$row['Info']?></textarea>
							<div  class="text_near_knopka5" id="d4"></div>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top">							
							<p class="text_near_knopka3">Пароль: </p>
						</td>
						<td>
							<input class="pole_vvoda2" id="password1" type="password" name="password1" value='<?=$row1['Pswd']?>' />
							<div  class="text_near_knopka5" id="d6"></div>
						</td>
					</tr>
					<tr>
						<td width=25%; align="right" valign="top">							
							<p class="text_near_knopka3">Повтор пароля: </p>
						</td>
						<td width=75%;>
							<input class="pole_vvoda2" id="password2" type="password" name="password2" value='<?=$row1['Pswd']?>' />
							<div  class="text_near_knopka5" id="d7"></div>
							<div  class="text_near_knopka5" id="d8"></div>		
						</td>
					</tr>				
				</table><br>
				<table align="center">
					<tr>
						<td>
							<input class="knopka3" type="button" name="b1" value="Сохранить" onclick="b1_click()"/>
						</td>
						<td>
							<input class="knopka3" type="button" name="b2" value="Отмена" onclick="b2_click()"/>
						</td>
					</tr>
				</table>
			</div>
		</form>
	</div>
	<br></br>
	<div id="footer" align="center">Кружки олимпиадной математики "Фрактал" &nbsp &nbsp 985-40-37 &nbsp &nbsp FRACTALCLUB@GMAIL.COM</div>			
</body>
</html>