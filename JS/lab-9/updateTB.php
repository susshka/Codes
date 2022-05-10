<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Обновление записей в таблице "Маршруты"</title>
</head>
<body>
<?php
require_once 'login.php';
$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error)
	echo "<p>Невозможно подключиться к серверу или открыть БД:<br>\n".$conn->connect_error."</p>\n";
else {
	$query="UPDATE `Маршруты` SET `№ маршрута`=2222 WHERE `№ маршрута`=3333;";
	$result=$conn->query($query);
	if (!$result)
		echo "<p>Невозможно обновить записи в таблицы \"Маршруты\":<br>\n".$conn->error."</p>\n";
	else {
		$n=$conn->affected_rows;
		// правильное склонение слов "обновить запись"
		$n1=$n%10;  // последняя цифра
		$n2=$n%100; // последние 2-е цифры
		if ($n2>=5 && $n2<=20 || $n1==0 || $n1>=5 && $n1<=9) $s="обновлено ".$n." записей";
		elseif ($n1==1) $s="обновлена ".$n." запись";
		else $s="обновлено ".$n." записи";		
		echo "<p>В таблицы \"Маршруты\" ".$s."</p>\n";
	}
	$conn->close();
}
?>
</body>
</html>

