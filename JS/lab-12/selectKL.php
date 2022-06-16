<?php
require_once 'login.php';
$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error)
	echo "<p>Невозможно подключиться к серверу или открыть БД:<br>\n".$conn->connect_error."</p>\n";
else {
	$query="SELECT `№ класса`, `Табельный № учителя`, `Специализация класса`, `Классная комната` FROM `Классы`";
	$result=$conn->query($query);
	if (!$result)
		echo "<p>Невозможно просмотреть записи из таблицы \"Классы\": $conn->error </p>\n";
	else {
		echo "<table id='tbl' name='Классы' cellspacing='0' cellpadding='8' border='1' align='center'>\n";
		echo "\t<caption id='tblCap'>Классы</caption>\n";
		echo "\t<tbody style='text-align:center'>\n";	 
		echo "\t\t<tr><th>№ класса</th><th>Табельный № учителя</th><th>Специализация класса</th><th>Классная комната</th></tr>\n";
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
