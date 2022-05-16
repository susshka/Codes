<?php
require_once 'login.php';
$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error)
	echo "<p>Невозможно подключиться к серверу или открыть БД: $conn->connect_error </p>\n";
else 
{
	$Ok        = $_POST['Ok']; 
	$path = $_POST['path$path'];
	$from       = $_POST['from'];
	$to  = $_POST['to'];
	$price    = $_POST['price'];

	switch ($Ok) 
	{
		case 'insert':
			$query= "INSERT INTO `Маршруты`(`№ маршрута`, `Пункт отправления`, `Пункт прибытия`, `Стоимость ру.`) ".
					"values ('$path', '$from', '$to', '$price')";			
			$result=$conn->query($query);
			if (!$result)
				echo "<p>Невозможно добавить записи в таблицу \"Маршруты\" $conn->error </p>\n";
			break;
		case 'update':
			$path_Old = $_POST['path_Old'];
			$from_Old       = $_POST['from_Old'];
			$to_Old  = $_POST['to_Old'];
			$price_Old    = $_POST['price_Old'];
			
			$query= "UPDATE `Маршруты` ".
					"SET `№ маршрута`='$path', `Пункт отправления`='$from', `Пункт прибытия`='$to' , `Стоимость ру.`='$price' ".
					"WHERE `№ маршрута`='$path_Old' AND `Пункт отправления`='$from_Old' AND `Пункт прибытия`='$to_Old' AND `Стоимость ру.`='$price_Old'";
			$result=$conn->query($query);
			if (!$result)
				echo "<p>Невозможно обновить записи в таблицы \"Маршруты\" $conn->error </p>\n";
			break;
		case 'delete':
			$query="DELETE FROM `Маршруты` ".
				   "WHERE `№ маршрута`= '$path' and `Пункт отправления`='$from' and `Пункт прибытия`='$to' and `Стоимость ру.`='$price'";	   
			$result=$conn->query($query);
			if (!$result){echo "<p>Невозможно удалить записи из таблицы \"Маршруты\": $conn->error </p>\n";}
				
	
		}

	 			$query="SELECT `№ маршрута`, `Пункт отправления`, `Пункт прибытия`, `Стоимость ру.` FROM `Маршруты`";
	 			$result=$conn->query($query);
	 			if (!$result)
	 				echo "<p>Невозможно просмотреть записи из таблицы \"Маршруты\": $conn->error </p>\n";
	 			else 
	 				$txt='';
	 				while ($row=$result->fetch_array(MYSQLI_NUM)) {
	 					$txt.='["'.$row[0].'", "'.$row[1].'", "'.$row[2].'", "'.$row[3].'"],'\n"; }
	 				$result->close();
	}
	$conn->close();
}
?>

