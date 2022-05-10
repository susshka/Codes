<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Создание, обновлене и удаление записей в таблице</title>
<link rel="stylesheet" href="style.css" type="text/css">
<script>
function f1(op) { 
	Ok.setAttribute('value', op);
	if (op == 'update') {    
		path_Old.setAttribute('name', 'path_Old');
		from_Old.setAttribute('name', 'from_Old');
		to_Old.setAttribute('name', 'to_Old');
		price_Old.setAttribute('name', 'price_Old');
	}
}
</script>
</head>
<body>
<?php
//require_once 'createTB.php';
//require_once 'insertTB.php';
require_once 'login.php';
$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error)
	echo "<p>Невозможно подключиться к серверу или открыть БД: $conn->connect_error </p>\n";
else {
	$Ok        = $_POST['Ok']; 
	$path = $_POST['path'];
	$from       = $_POST['from'];
	$to  = $_POST['to'];
	$price = $_POST['price'];

	switch ($Ok) {
		case 'insert':
			$query= "INSERT INTO `Маршруты`(`№ маршрута`, `Название пункта отправления`, `Название пункта прибытия`, `Стоимость проезда, руб.`) ".
					"values ('$path', '$from', '$to', '$price')";			
			$result=$conn->query($query);
			if (!$result)
				echo "<p>Невозможно добавить записи в таблицу \"Маршруты\" $conn->error </p>\n";
			break;
		case 'update':
			$path_Old = $_POST['path_Old'];
			$from_Old       = $_POST['from_Old'];
			$to_Old  = $_POST['to_Old'];
			$price_Old = $_POST['price_Old'];

			$query= "UPDATE `Маршруты` ".
					"SET `№ маршрута`='$path', `Название пункта отправления`='$from', `Название пункта прибытия`='$to' , `Стоимость проезда, руб.`='$price' ".
					"WHERE `№ маршрута`='$path_Old' AND `Название пункта отправления`='$from_Old' AND `Название пункта прибытия`='$to_Old' AND `Стоимость проезда, руб.`='$price_Old'";
			$result=$conn->query($query);
			if (!$result)
				echo "<p>Невозможно обновить записи в таблицы \"Маршруты\" $conn->error </p>\n";
			break;
		case 'delete':
			$query="DELETE FROM `Маршруты` ".
				   "WHERE `№ маршрута`= '$path' AND `Название пункта отправления`='$from' AND `Название пункта прибытия`='$to' AND `Стоимость проезда, руб.`='$price'";	   
			$result=$conn->query($query);
			if (!$result)
				echo "<p>Невозможно удалить записи из таблицы \"Маршруты\": $conn->error </p>\n";
	}

	$query="SELECT `№ маршрута`, `Название пункта отправления`, `Название пункта прибытия`, `Стоимость проезда, руб.` FROM `Маршруты`";
	$result=$conn->query($query);
	if (!$result)
		echo "<p>Невозможно просмотреть записи из таблицы \"Маршруты\": $conn->error </p>\n";
	else {
		echo "<table id='tbl' cellspacing='0' cellpadding='8' border='1'>\n";
		echo "\t<caption>Междугородние маршруты</caption>\n";
		echo "\t<tbody style='text-align:center'>\n";	 
		echo "\t\t<tr><th>№ маршрута</th><th>Название пункта отправления</th><th>Название пункта прибытия</th><th>Стоимость проезда, руб.</th></tr>\n";
		while ($row=$result->fetch_array(MYSQLI_NUM)) {
			echo "\t\t<tr><td>$row[0]</td><td class='stL'>$row[1]</td><td class='stL'>$row[2]</td><td>$row[3]</td></tr>\n";
		}
		echo "\t</tbody>\n";
		echo "</table>\n";
		$result->close();
	}
	$conn->close();
}
?>
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