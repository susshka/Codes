<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Просмотр записей из таблицы "Маршруты"</title>
<style>
	.left {text-align:left;}
</style>
</head>
<body>
<?php
require_once 'login.php';
$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error)
	echo "<p>Невозможно подключиться к серверу или открыть БД:<br>\n".$conn->connect_error."</p>\n";
else {
	$query="SELECT `№ маршрута`, `Название пункта отправления`, `Название пункта прибытия`, `Стоимость проезда, руб.` FROM `Маршруты`";
	$result=$conn->query($query);
	if (!$result)
		echo "<p>Невозможно просмотреть записи из таблицы \"Маршруты\":<br>\n".$conn->error."</p>\n";
	else {
		echo "<table cellspacing=0 cellpadding=8 border=1>\n";
		echo "\t<caption>Междугородние маршруты</caption>\n";
		echo "\t<tbody style='text-align:center'>\n";	 
		echo "\t\t<tr><th>№ маршрута</th><th>Название пункта отправления</th><th>Название пункта прибытия</th><th>Стоимость проезда, руб.</th></tr>\n";
		while ($row=$result->fetch_array(MYSQLI_NUM)) {
			echo "\t\t<tr><td>$row[0]</td><td class='left'>$row[1]</td><td class='left'>$row[2]</td><td class='center'>$row[3]</td></tr>\n";
		}
		echo "\t</tbody>\n";
		echo "</table>\n";
		$result->close();
	}
	$conn->close();
}
?>
</body>
</html>


