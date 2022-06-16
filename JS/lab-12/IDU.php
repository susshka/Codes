<?php
function ValidateFlats($n1, $n2, $n3, $n4,$tbl){
	$errorTxt = "";

	if($tbl=="Классы"){
	if(strlen($n1) < 3 or strlen($n1) > 5 or preg_match("[a-zA-Z]", $n1) == 1){
		$errorTxt .= "<p>Поле \"№ класса\" ".$n1." должно быть вида '11A' и состоять из цифр и букв русского алфавита" . "<br></p>";
	}
	if(is_numeric($n2) == false or strlen($n2) < 3 or strlen($n2) > 3 or $n2 < 100 or $n2 > 150){
		$errorTxt .= "<p>Поле \"Табельный № учителя\" должно быть числом в диапазоне от 1 до 150" . "<br></p>";
	}
	//т.к. значение в поле - русские буквы, uft-8 кодирует их по 2 байта
	if(strlen($n3) < 2 or strlen($n3) > 80 or preg_match("[a-zA-Z]", $n3) == 1){
		$errorTxt .= "<p>Поле \"Специализация класса\" может состоять только из русских букв" 
		."и находиться в диапазоне от 1-го до 40-ка символов" . "<br></p>";
	}
	if(is_numeric($n4) == false or strlen($n4) < 1 or strlen($n4) > 3 or $n4 < 1 or $n4 > 999){
		$errorTxt .= "<p>Поле \"Классная комната\" должно быть числом в диапазоне от 1 до 999" . "<br></p>";
	}
	}
	else if($tbl=="Работники школы"){
		if(is_numeric($n1) == false or strlen($n1) < 3 or strlen($n1) > 3 or $n1 < 100 or $n1 > 150){
			$errorTxt .= "<p>Поле \"Табельный номер\" ".$n1." должно быть числом в диапазоне от 1 до 150" . "<br></p>";
		}
		if(strlen($n2) < 2 or strlen($n2) > 80 or preg_match("[a-zA-Z]", $n2) == 1){
			$errorTxt .= "<p>Поле \"ФИО учителя\" может состоять только из русских букв" 
			." и находиться в диапазоне от 1-го до 40-ка символов" . "<br></p>";
		}
		//т.к. значение в поле - русские буквы, uft-8 кодирует их по 2 байта
		if(strlen($n3) < 2 or strlen($n3) > 30 or preg_match("[a-zA-Z]", $n3) == 1){
			$errorTxt .= "<p>Поле \"Должность/профессия\" может состоять только из русских букв" 
			." и находиться в диапазоне от 1-го до 15-ти символов" . "<br></p>";
		}
		if(strlen($n4) < 2 or strlen($n4) > 2 or preg_match("[a-zA-Zа-я]", $n4)== 1){
			$errorTxt .= "<p>Поле \"Пол\" должно быть символом русского алфавита длинной не больше 1" . "<br></p>";
		}
	}
	else if($tbl=="Школьники"||$tbl=="Школьники1"){
			if(strlen($n1) < 3 or strlen($n1) > 5 or preg_match("[a-zA-Zа-я]", $n1)== 1 or ($tbl=="Школьники" and $n1 !="10А")){
				$errorTxt .= "<p>Поле \"№ класса\" ".$n1." таблицы ".$tbl." должно иметь значение '10A' и состоять из цифр и букв русского алфавита" . "<br></p>";
			}
			else if(strlen($n1) < 3 or strlen($n1) > 5 or preg_match("[a-zA-Zа-я]", $n1)== 1 or ($tbl=="Школьники1" and $n1 !="11Б")){
				$errorTxt .= "<p>Поле \"№ класса\" ".$n1." таблицы ".$tbl." должно иметь значение '11Б' и состоять из цифр и букв русского алфавита" . "<br></p>";
			}
			//т.к. значение в поле - русские буквы, uft-8 кодирует их по 2 байта
			if(is_numeric($n2) == false or strlen($n2) < 1 or strlen($n2) > 2 or $n2 < 1 or $n2 > 50){
				$errorTxt .= "<p>Поле \"Порядковый № в журнале\" должно быть числом в диапазоне от 1 до 50" . "<br></p>";
			}
			if(strlen($n3) < 2 or strlen($n3) > 80 or preg_match("[a-zA-Z]", $n3)== 1){
				$errorTxt .= "<p>Поле \"ФИО школьника\" должно быть текстом из русского алфавита длинной не больше 40 символов" . "<br></p>";
			}	
			if(strlen($n4) < 2 or strlen($n4) > 2 or preg_match("[a-zA-Zа-я]", $n4)== 1){
				$errorTxt .= "<p>Поле \"Пол\" должно быть символом русского алфавита длинной не больше 1" . "<br></p>";
			}	
	}
	return $errorTxt;
}
 include_once "login.php";
 $conn = new mysqli($server, $user, $password, $dbname);
 if($conn->connect_error) echo ("<p>Невозможно подключиться к серверу или открыть БД:<br>\n".$conn->connect_error."<br></p>\n");
 else {
    echo("<p>Успешное подключение к серверу произведено!" . "<br></p>\n");
	$Ok        = $_POST['Ok']; 
    $tbName = $_POST['tblName'];
    //echo("<p>таблица ".$tbName."</p>");
	$one = $_POST['one'];
	$two = $_POST['two'];
	$tree  = $_POST['tree'];
	$four = $_POST['four'];
	
	
	$err = "";
	$err = ValidateFlats($one, $two, $tree,$four,$tbName);
	if($err != "") echo($err);
	else{
	if($Ok=='insert'){
                if($tbName == 'Классы'){
                    //echo ("<p>сейчас должен вставить</p>\n");
                    	$query="INSERT INTO `Классы`(`№ класса`, `Табельный № учителя`, `Специализация класса`, `Классная комната`) ".
    					"values ('$one', '$two', '$tree', '$four')";			
						$result=$conn->query($query);
						if (!$result)
						echo ("<p>Невозможно добавить записи в таблицу \"Классы\":<br>\n".$conn->error."</p>\n");
    					else 
        				echo ("<p>Запись добавлена в таблицу \"Классы\"</p>\n");	
                }
				else if($tbName == 'Работники школы'){
				
					//echo ("<p>сейчас должен вставить</p>\n");
                    $query="INSERT INTO `Работники школы`(`Табельный номер`, `ФИО учителя`, `Должность/профессия`, `Пол`) ".
    				"values ('$one', '$two', '$tree', '$four')";			
					$result=$conn->query($query);
					if (!$result)
					echo ("<p>Невозможно добавить записи в таблицу \"Работники школы\":<br>\n".$conn->error."</p>\n");
    				else 
        			echo ("<p>Запись добавлена в таблицу \"Работники школы\"<br></p>\n");
				
				}
				else if($tbName == 'Школьники'|| $tbName == 'Школьники1'){
					//echo ("<p>сейчас должен вставить</p>\n");
                    $query="INSERT INTO `$tbName`(`№ класса`, `Порядковый № в журнале`, `ФИО школьника`, `Пол`) ".
    				"values ('$one', '$two', '$tree', '$four')";			
					$result=$conn->query($query);
					if (!$result)
					echo ("<p>Невозможно добавить записи в таблицу \"".$tbName."\":<br>\n".$conn->error."</p>\n");
    				else 
        			echo ("<p>Запись добавлена в таблицу \"".$tbName."\"<br></p>\n");
				}
			}
		else if($Ok=='delete'){
			if($tbName == 'Классы'){
				//echo ("<p>сейчас должен вставить</p>\n");
					$flag = false;
					$check = "SELECT `№ класса`, `Табельный № учителя` FROM `Классы`;";
					$res = $conn->query($check);
					$flats = $res->fetch_all(MYSQLI_NUM);
					mysqli_free_result($res);
					for($j = 0; $j < count($flats); $j++){
						if(in_array($one, $flats[$j]) == true and in_array($two, $flats[$j]) == true){
							$flag = true;}
						}
					if($flag == false) echo("Записи с такими номерами ключевых полей \"$one\", \"$two\" нет в таблице  \"Классы\"" . "<br>");
					else{
					$query="DELETE FROM `Классы` WHERE `№ класса` = '$one'
					AND `Табельный № учителя` = $two AND `Специализация класса` = '$tree' AND `Классная комната` = $four;";			
					$result=$conn->query($query);
					if (!$result)
					echo ("<p>Невозможно удалить записи из таблицы \"Классы\":<br>\n".$conn->error."</p>\n");
					else 
					echo ("<p>Запись с ключевым полем ".$one." удалена из таблицы \"Классы\"</p>\n");	
					}
			}
			else if($tbName == 'Работники школы'){
				//echo ("<p>сейчас должен вставить</p>\n");
					$flag = false;
					$check = "SELECT `Табельный номер` FROM `Работники школы`;";
					$res = $conn->query($check);
					$flats = $res->fetch_all(MYSQLI_NUM);
					mysqli_free_result($res);
					for($j = 0; $j < count($flats); $j++){
						if(in_array($one, $flats[$j]) == true){
							$flag = true;}
						}
					if($flag == false) echo("Записи с таким номерам ключевого поля \"$one\" нет в таблице  \"Работники школы\"" . "<br>");
					else{
					$query="DELETE FROM `Работники школы` WHERE `Табельный номер` = $one
					AND `ФИО учителя` = '$two' AND `Должность/профессия` = '$tree' AND `Пол` = '$four';";			
					$result=$conn->query($query);
					if (!$result) echo ("<p>Невозможно удалить записи из таблицы \"Работники школы\":<br>\n".$conn->error."</p>\n");
					else echo ("<p>Запись с ключевым полем ".$one." удалена из таблицы \"Работники школы\"</p>\n");
					}	
			}
			else if($tbName == 'Школьники'|| $tbName == 'Школьники1'){
				//echo ("<p>сейчас должен вставить</p>\n");
					$flag = false;
					$check = "SELECT `№ класса`, `Порядковый № в журнале` FROM `$tbName`;";
					$res = $conn->query($check);
					$flats = $res->fetch_all(MYSQLI_NUM);
					mysqli_free_result($res);
					for($j = 0; $j < count($flats); $j++){
						if(in_array($one, $flats[$j]) == true and in_array($two, $flats[$j]) == true){
							$flag = true;}
						}
					if($flag == false) echo("Записи с такими номерами ключевых полей \"$one\", \"$two\" нет в таблице  \"$tbName\"" . "<br>");
					else{
						$query="DELETE FROM `$tbName` WHERE `№ класса` = '$one'
						AND `Порядковый № в журнале` = $two AND `ФИО школьника` = '$tree' AND `Пол` = '$four';";			
						$result=$conn->query($query);
						if (!$result) echo ("<p>Невозможно удалить записи из таблицы \"".$tbName."\":<br>\n".$conn->error."</p>\n");
						else echo ("<p>Запись с ключевыми полями ".$one." и ".$two." удалена из таблицы \"".$tbName."\"</p>\n");	
					}
				}
		}
		else if($Ok=='update'){
			$one_Old = $_POST['one_Old'];
			$two_Old = $_POST['two_Old'];
			$tree_Old = $_POST['tree_Old'];
			$four_Old  = $_POST['four_Old'];
			$tbName = $_POST['tblName'];
			$err = "";
			$err = ValidateFlats($one_Old, $two_Old, $tree_Old,$four_Old,$tbName);
			if($err != "") echo($err);
			else{
				if($tbName == 'Классы'){
					//echo ("<p>сейчас должен вставить</p>\n");
						$query="UPDATE `Классы` SET `№ класса` = '$one', `Табельный № учителя` = '$two', `Специализация класса` = '$tree', `Классная комната` = '$four'
						WHERE `№ класса` = '$one_Old' AND `Табельный № учителя` = '$two_Old' AND `Специализация класса` = '$tree_Old' AND `Классная комната` = '$four_Old';";			
						$result=$conn->query($query);
						if (!$result)
						echo ("<p>Невозможно обновить запись из таблицы \"Классы\":<br>\n".$conn->error."</p>\n");
						else 
						echo ("<p>Запись с ключевым полем ".$one." успешно обновлена</p>\n");	
				}
				else if($tbName == 'Работники школы'){
					//echo ("<p>сейчас должен вставить</p>\n");
						$query="UPDATE `Работники школы` SET `Табельный номер` = '$one', `ФИО учителя` = '$two', `Должность/профессия` = '$tree', `Пол` = '$four'
						WHERE `Табельный номер` = '$one_Old' AND `ФИО учителя` = '$two_Old' AND `Должность/профессия` = '$tree_Old' AND `Пол` = '$four_Old';";			
						$result=$conn->query($query);
						if (!$result)
						echo ("<p>Невозможно обновить запись из таблицы \"Работники школы\":<br>\n".$conn->error."</p>\n");
						else 
						echo ("<p>Запись с ключевым полем ".$one." успешно обновлена</p>\n");	
				}
				else if($tbName == 'Школьники'|| $tbName == 'Школьники1'){
					//echo ("<p>сейчас должен вставить</p>\n");
						$query="UPDATE `$tbName` SET `№ класса` = '$one', `Порядковый № в журнале` = '$two', `ФИО школьника` = '$tree', `Пол` = '$four'
						WHERE `№ класса` = '$one_Old' AND `Порядковый № в журнале` = '$two_Old' AND `ФИО школьника` = '$tree_Old' AND `Пол` = '$four_Old';";	
						$result=$conn->query($query);
						if (!$result)
						echo ("<p>Невозможно обновить запись из таблицы \"".$tbName."\":<br>\n".$conn->error."</p>\n");
						else 
						echo ("<p>Запись с ключевыми полями ".$one." и ".$two." успешно обновлена</p>\n");	
				}
			}
		}
	
	$conn->close();
}
}
?>
