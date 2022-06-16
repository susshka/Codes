<?php
require_once 'login.php';
$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error)
	echo "<p>Невозможно подключиться к серверу или открыть БД:<br>\n".$conn->connect_error."</p>\n";
else {
	$query="SELECT 
    `Классы`.`Табельный № учителя`, `Классы`.`Специализация класса`,
    `Работники школы`.`ФИО учителя`, `Работники школы`.`Должность/профессия`,
    `Школьники1`.`№ класса`, `Школьники1`.`ФИО школьника`
    FROM `Работники школы` INNER JOIN `Классы` ON `Работники школы`.`Табельный номер` = `Классы`.`Табельный № учителя`
    INNER JOIN `Школьники1` ON `Классы`.`№ класса` = `Школьники1`.`№ класса`
    ORDER BY `Классы`.`Табельный № учителя`;";
	$result=$conn->query($query);
	if (!$result)
		echo "<p>Во время выборки записей произошла ошибка: $conn->error </p>\n";
	else {
		echo "<table id='rep' name='Отчет' cellspacing='0' cellpadding='8' border='1' align='center'>\n";
		echo "\t<caption id='tblCap'>Отчет</caption>\n";
		echo "\t<tbody style='text-align:center'>\n";	 
		echo "\t\t<tr><th>Табельный № учителя</th><th>Специализация класса</th><th>ФИО учителя</th><th>Должность/профессия</th><th>№ класса</th><th>ФИО школьника</th></tr>\n";
		while ($row=$result->fetch_array(MYSQLI_NUM)) {
			echo "\t\t<tr><td>$row[0]</td><td class='stL'>$row[1]</td><td class='stL'>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>\n";
		}
		echo "\t</tbody>\n";
		echo "</table>\n";
		$result->close();
	}
	$conn->close();
	}

?>