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


	$query="DROP TABLE IF EXISTS `Попа`";
	$result=$conn->query($query);
	if (!$result)
		echo "<p>Невозможно удалить таблицу \"Попа\":<br>\n".$conn->error."</p>\n";
	else {
		$query="CREATE TABLE `Попа`(".
			"`№ попы` INT NOT NULL,".
			"`№ маршрута` INT NOT NULL DEFAULT '111' ,".
			"PRIMARY KEY (`№ попы`),".
			"FOREIGN KEY (`№ маршрута`) REFERENCES `Маршруты` (`№ маршрута`) ON DELETE RESTRICT ON UPDATE CASCADE)";
	    $result=$conn->query($query);
	    if (!$result)
		   echo "<p>Невозможно создать таблицу \"Попа\":<br>\n".$conn->error."</p>\n";
	    else
		   echo "<p>Таблица \"Попа\" создана</p>\n";
			
	}

	$conn->close();
}
?>
</body>
</html>
