<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Создание таблицы "Маршруты"</title>
</head>
<body>
<?php
require_once 'login.php';
$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error)
	echo "<p>Невозможно подключиться к серверу или открыть БД:<br>\n".$conn->connect_error."</p>\n";
else {
	$query="DROP TABLE IF EXISTS `Маршруты`";
	$result=$conn->query($query);
	if (!$result)
		echo "<p>Невозможно удалить таблицу \"Маршруты\":<br>\n".$conn->error."</p>\n";
	else {
		$query="CREATE TABLE `Маршруты`(".
			 "`№ маршрута` INT PRIMARY KEY,".
			 "`Название пункта отправления` VARCHAR(60) NOT NULL,".
             "`Название пункта прибытия` VARCHAR(60) NOT NULL,".
			 "`Стоимость проезда, руб.` INT NOT NULL)";
		$result=$conn->query($query);
		if (!$result)
			echo "<p>Невозможно создать таблицу \"Маршруты\":<br>\n".$conn->error."</p>\n";
		else
			echo "<p>Таблица \"Маршруты\" создана</p>\n";
	}
	$conn->close();
}
?>
</body>
</html>
