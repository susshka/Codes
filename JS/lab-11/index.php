<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Создание, обновлене и удаление записей в таблице</title>
<link rel="stylesheet" href="style.css" type="text/css">
<script>
////////////
var XMLHttpRequestObject=false;
if (window.XMLHttpRequest) 
	XMLHttpRequestObject=new XMLHttpRequest(); 
else if ( window.ActiveXObject ) {
	XMLHttpRequestObject=new ActiveXObject("Microsoft.XMLHTTP");
}
///////////
function getDate(txt,callback){
	XMLHttpRequestObject.open("POST", "ajax.php",true);
	XMLHttpRequestObject.send(txt);
	if ( XMLHttpRequestObject ) {
		XMLHttpRequestObject.onreadystatechange= function() {
			if ( XMLHttpRequestObject.readyState==4 && XMLHttpRequestObject.status==200 ) {
				callback(XMLHttpRequestObject.response);
			} 
		}
	}
}
//////////
function f1(op) { 
	Ok.setAttribute('value', op);
	if (op == 'update') {    
		path_Old.setAttribute('name', 'path_Old');
		from_Old.setAttribute('name', 'from_Old');
		to_Old.setAttribute('name', 'to_Old');
		price_Old.setAttribute('name', 'price_Old');
	}
	getDate("jjj", (txt)=>{document.innerHTML=txt;})
}
</script>
</head>

<body>

<table id='tbl' cellspacing='0' cellpadding='8' border='1'>
	<caption>Междугородние маршруты</caption>
	<tbody style='text-align:center'>	 
	<tr>
		<th>№ маршрута</th>
		<th>Пункт отправления</th>
		<th>Пункт прибытия</th>
		<th>Стоимость руб.</th>
	</tr>";
	<?php require_once 'ajax.php';?>
	</tbody>
</table>

<br>
<form id="form1" method="post">
	<input type="hidden" id="path_Old">
	<input type="hidden" id="from_Old">
	<input type="hidden" id="to_Old">
	<input type="hidden" id="price_Old">
	<input type="hidden" id="Ok" name="Ok">
	<table cellspacing="0" cellpadding="4" border="0">
		<tr>
			<th class="stR"><label for="path">№ маршрута</label></th>
			<td><input id="path" name="path" size=4 maxlength=4 placeholder="666" required></td>
		</tr>
		<tr>
			<th class="stR"><label for="from">Название пункта отправления</label></th>
			<td><input id="from" name="from" size=30 maxlength=40 placeholder="Мотяково" required></td>
		</tr>
		<tr>
			<th class="stR"><label for="to">Название пункта прибытия</label></th>
			<td><input id="to" name="to" size=30 maxlength=40 placeholder="Марусино" required></td>
		</tr>
		<tr>
			<th class="stR"><label for="price">Стоимость проезда, руб.</label></th>
			<td><input id="price" name="price" size=4 maxlength=4 placeholder="777" required></td>
		</tr>
		<tr>
			<th class="stR"><input type="submit" value="Создать новую запись" onclick="f1('insert')"></th>
			<td><input type="submit" value="Изменить выбранную запись" onclick="f1('update')"></td>
		</tr>
		<tr>		
			<th class="stR"><input type="reset" value="Очистить поля формы"></th>
			<td><input type="submit" value="Удалить выбранную запись" onclick="f1('delete')"></td>
		</tr>	
	</table>
</form>
<script src="main.js"></script>
</body>
</html>