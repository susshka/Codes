<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Удаление записей из таблицы "Маршруты"</title>
</head>
<body>
<?php
require_once 'login.php';
$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error)
	echo "<p>Невозможно подключиться к серверу или открыть БД:<br>\n".$conn->connect_error."</p>\n";
else {
	$query="DELETE FROM `Маршруты` WHERE `№ маршрута`=1234";
	$result=$conn->query($query);
	if (!$result)
		echo "<p>Невозможно удалить записи из таблицы \"Маршруты\":<br>\n".$conn->error."</p>\n";
	else {
		$n=$conn->affected_rows;
		// правильное склонение слов "удалена запись"
		$n1=$n%10;  // последняя цифра
		$n2=$n%100; // последние 2-е цифры
		if ($n2>=5 && $n2<=20 || $n1==0 || $n1>=5 && $n1<=9) $s="удалено ".$n." записей";
		elseif ($n1==1) $s="удалена ".$n." запись";
		else $s="удалено ".$n." записи";		
		echo "<p>Из таблицы \"Маршруты\" ".$s."</p>\n";
	}
	$conn->close();
}
?>
</body>
</html>

