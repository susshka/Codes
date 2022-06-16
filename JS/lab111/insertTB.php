<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Добавление записей в таблицу "Маршруты"</title>
</head>
<body>
<?php
require_once 'login.php';
$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error)
	echo "<p>Невозможно подключиться к серверу или открыть БД:<br>\n".$conn->connect_error."</p>\n";
else {
	$query="INSERT INTO `Маршруты`(`№ маршрута`, `Название пункта отправления`, `Название пункта прибытия`, `Стоимость проезда, руб.`) ".
	 "values (453, 'Самара', 'Тольятти', 400),".
			"(587, 'Ульяновск', 'Самара', 600),".
			"(653, 'Уфа', 'Самара', 550),".
			"(462, 'Самара', 'Уфа', 550),".
            "(567, 'Ульяновск', 'Уфа', 450),".
            "(634, 'Сызрань', 'Тольятти', 300)";			
	$result=$conn->query($query);
	if (!$result)
		echo "<p>Невозможно добавить записи в таблицу \"Маршруты\":<br>\n".$conn->error."</p>\n";
	else {
		$n=$conn->affected_rows;
		// правильное склонение слов "добавлена запись"
		$n1=$n%10;  // последняя цифра
		$n2=$n%100; // последние 2-е цифры
		if ($n2>=5 && $n2<=20 || $n1==0 || $n1>=5 && $n1<=9) $s="добавлено ".$n." записей";
		elseif ($n1==1) $s="добавлена ".$n." запись";
		else $s="добавлено ".$n." записи";		
		echo "<p>В таблицу \"Маршруты\" ".$s."</p>\n";
		}
	$query="INSERT IGNORE INTO `Попа`(`№ попы`) ".
		"values (453),".
			   "(587),".
			   "(653),".
			   "(462),".
			   "(567),".
			   "(634),".
			   "(634)";		
	//$query= "SELECT `Попа`.*, `Маршруты`.`Название пункта отправления` FROM `Попа` LEFT JOIN `Маршруты` ON `Попа`.`Название пункта отправления` = `Маршруты`.`Название пункта отправления`";	
	//$query="INSERT INTO `Попа`(`Название пункта отправления`) SELECT * FROM `Маршруты` JOIN `Попа` ON `Маршруты`.`Название пункта отправления` = `Попа`.`Название пункта отправления`";	
	$result=$conn->query($query);
	   if (!$result)
		   echo "<p>Невозможно добавить записи в таблицу \"Попы\":<br>\n".$conn->error."</p>\n";
	   else {
		   $n=$conn->affected_rows;
		   // правильное склонение слов "добавлена запись"
		   $n1=$n%10;  // последняя цифра
		   $n2=$n%100; // последние 2-е цифры
		   if ($n2>=5 && $n2<=20 || $n1==0 || $n1>=5 && $n1<=9) $s="добавлено ".$n." записей";
		   elseif ($n1==1) $s="добавлена ".$n." запись";
		   else $s="добавлено ".$n." записи";		
		   echo "<p>В таблицу \"Попы\" ".$s."</p>\n";
			}
	$conn->close();
	}
?>
</body>
</html>