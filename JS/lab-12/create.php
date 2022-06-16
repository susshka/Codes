<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
    <?php
        include_once "login.php";
        $conn = new mysqli($server, $user, $password, $dbname);
        if($conn->connect_error) die("Во время подключения к веб-серверу произошла ошибка:" . $conn->connect_error . "<br>");
        else {
        echo("Успешное подключение к серверу произведено!" . "<br>");


        $query="DROP TABLE IF EXISTS `Работники школы`";
        $result=$conn->query($query);
        if (!$result)
        echo "<p>Невозможно удалить таблицу \"Работники школы\":<br>\n".$conn->error."</p>\n";
        else {
        $query="CREATE TABLE IF NOT EXISTS `Работники школы` 
        (`Табельный номер` INT(3) PRIMARY KEY,
        `ФИО учителя` VARCHAR(40) NOT NULL,
        `Должность/профессия` VARCHAR(15) NOT NULL,
        `Пол` VARCHAR(1) NOT NULL);";
        $result=$conn->query($query);
        if (!$result)
            echo "<p>Невозможно создать таблицу \"Работники школы\":<br>\n".$conn->error."</p>\n";
        else
            echo "<p>Таблица \"Работники школы\" создана</p>\n";
        }
    
            $insert_Table = "INSERT IGNORE INTO `Работники школы` (`Табельный номер`, `ФИО учителя`, `Должность/профессия`, `Пол`) VALUES
            (100, 'Петров Станислав Васильевич', 'Учитель', 'М'),
            (101, 'Петрова Валентина Григорьевна', 'Учитель', 'Ж'),
            (102, 'Рыбакова Анна Ивановна', 'Завуч', 'Ж'),
            (103, 'Федеров Юрий Васильевич', 'Директор', 'М'),
            (104, 'Смирнов Антон Юрьевич', 'Учитель', 'М');";
            $result=$conn->query($insert_Table);
            if(!$result) die("Во время добавления записей в таблицу \"Работники школы\" произошла ошибка:" . $conn->error . "<br>");
            else echo("В таблицу \"Работники школы\" успешно добавлены записи в кол-ве " . $conn->affected_rows . " штук(и)" . "<br>");



        $query="DROP TABLE IF EXISTS `Классы`";
        $result=$conn->query($query);
        if (!$result)
        echo "<p>Невозможно удалить таблицу \"Классы\":<br>\n".$conn->error."</p>\n";
        else {
        $query="CREATE TABLE IF NOT EXISTS `Классы` 
        (`№ класса` VARCHAR(3) NOT NULL,
        `Табельный № учителя` INT(3) NOT NULL,
        `Специализация класса` VARCHAR(40) NOT NULL,
        `Классная комната` INT(3) NOT NULL,
        PRIMARY KEY (`№ класса`, `Табельный № учителя`),
        FOREIGN KEY (`Табельный № учителя`) REFERENCES `Работники школы` (`Табельный номер`) ON DELETE RESTRICT ON UPDATE CASCADE);";
        $result=$conn->query($query);
        if (!$result)
            echo "<p>Невозможно создать таблицу \"Классы\":<br>\n".$conn->error."</p>\n";
        else
            echo "<p>Таблица \"Классы\" создана</p>\n";
        }

            $insert_Table = "INSERT IGNORE INTO `Классы` (`№ класса`, `Табельный № учителя`, `Специализация класса`, `Классная комната`) VALUES
            ('10А', 101, 'Иностранные языки (английский и немецкий', 203),
            ('11Б', 100, 'Математика и физика', 212);";
            $result=$conn->query($insert_Table);
            if(!$result) die("Во время добавления записей в таблицу \"Классы\" произошла ошибка:" . $conn->error . "<br>");
            else echo("В таблицу \"Классы\" успешно добавлены записи в кол-ве " . $conn->affected_rows . " штук(и)" . "<br>");



        $query="DROP TABLE IF EXISTS `Школьники`";
        $result=$conn->query($query);
        if (!$result)
        echo "<p>Невозможно удалить таблицу \"Школьники\":<br>\n".$conn->error."</p>\n";
        else {
        $query="CREATE TABLE IF NOT EXISTS `Школьники`
        (`№ класса` VARCHAR(3) NOT NULL,
        `Порядковый № в журнале` INT(2) NOT NULL,
        `ФИО школьника` VARCHAR(40) NOT NULL,
        `Пол` VARCHAR(1) NOT NULL,
        PRIMARY KEY (`№ класса`, `Порядковый № в журнале`),
        FOREIGN KEY (`№ класса`) REFERENCES `Классы` (`№ класса`) ON DELETE RESTRICT ON UPDATE CASCADE);";
        $result=$conn->query($query);
        if (!$result)
            echo "<p>Невозможно создать таблицу \"Школьники\":<br>\n".$conn->error."</p>\n";
        else
            echo "<p>Таблица \"Школьники\" создана</p>\n";
        }
            $insert_Table = "INSERT IGNORE INTO `Школьники` (`№ класса`, `Порядковый № в журнале`, `ФИО школьника`, `Пол`) VALUES
            ('10А', 1, 'Иванов Сергей Петрович', 'М'),
            ('10А', 2, 'Костин Петр Васильевич', 'М'),
            ('10А', 3, 'Матросова Елена Ивановна', 'Ж');";
            $result=$conn->query($insert_Table);
            if(!$result) die("Во время добавления записей в таблицу \"Школьники\" произошла ошибка:" . $conn->error . "<br>");
            else echo("В таблицу \"Школьники\" успешно добавлены записи в кол-ве " . $conn->affected_rows . " штук(и)" . "<br>");


        $query="DROP TABLE IF EXISTS `Школьники1`";
        $result=$conn->query($query);
        if (!$result)
        echo "<p>Невозможно удалить таблицу \"Школьники1\":<br>\n".$conn->error."</p>\n";
        else {
        $query="CREATE TABLE IF NOT EXISTS `Школьники1`
        (`№ класса` VARCHAR(3) NOT NULL,
        `Порядковый № в журнале` INT(2) NOT NULL,
        `ФИО школьника` VARCHAR(40) NOT NULL,
        `Пол` VARCHAR(1) NOT NULL,
        PRIMARY KEY (`№ класса`, `Порядковый № в журнале`),
        FOREIGN KEY (`№ класса`) REFERENCES `Классы` (`№ класса`) ON DELETE RESTRICT ON UPDATE CASCADE);";
        $result=$conn->query($query);
        if (!$result)
            echo "<p>Невозможно создать таблицу \"Школьники1\":<br>\n".$conn->error."</p>\n";
        else
            echo "<p>Таблица \"Школьники1\" создана</p>\n";
        }
            $insert_Table = "INSERT IGNORE INTO `Школьники1` (`№ класса`, `Порядковый № в журнале`, `ФИО школьника`, `Пол`) VALUES
            ('11Б', 1, 'Богданов Юрий Сергеевич', 'М'),
            ('11Б', 2, 'Потапова Юлия Петровна', 'Ж'),
            ('11Б', 3, 'Сорокина Ольга Петровна', 'Ж'),
            ('11Б', 4, 'Сидоров Андрей петрович', 'М');";
            $result=$conn->query($insert_Table);
            if(!$result) die("Во время добавления записей в таблицу \"Школьники1\" произошла ошибка:" . $conn->error . "<br>");
            else echo("В таблицу \"Школьники1\" успешно добавлены записи в кол-ве " . $conn->affected_rows . " штук(и)" . "<br>");

            
        $conn->close();
    }
    ?>
</body>
</html>