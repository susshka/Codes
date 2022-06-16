<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лицей имени Жуковой</title>
    <link rel="stylesheet" href="default.css">
    <link rel="stylesheet" href="style.css">
    <script>
        var XMLHttpRequestObject = false;
        if (window.XMLHttpRequest)
            XMLHttpRequestObject = new XMLHttpRequest();
        else if (window.ActiveXObject) {
            XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
        }

        function postDate(file, data, callback){
            if(XMLHttpRequestObject){ 
                XMLHttpRequestObject.open("POST", file, true);
                XMLHttpRequestObject.onreadystatechange = function(){
                    if(XMLHttpRequestObject.status == 200 && XMLHttpRequestObject.readyState == 4 && callback){
                        callback(XMLHttpRequestObject.responseText);
                    }
                }
                XMLHttpRequestObject.send(data);
            }
            else document.write("Что-то пошло не так ...");
        }


        function getDate(file, id) {
            if (XMLHttpRequestObject) {
                var obj = document.getElementById(id);
                XMLHttpRequestObject.open("GET", file, false);

                XMLHttpRequestObject.onreadystatechange = function () {
                    if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
                        obj.innerHTML = XMLHttpRequestObject.responseText;
                    }
                }
                XMLHttpRequestObject.send(null);
            }};
            
        function getStr(){
            var selct = document.getElementById("tbl")
            selct.addEventListener('click', (e) => {
            let cell = e.target;
            let t = cell.parentElement;
            let r = t.parentElement.children;
            for (rowCount = 1; rowCount < r.length; rowCount++) {
                if (r[rowCount] === t) {
                let d = r[rowCount].getElementsByTagName("td");
                document.getElementById("one").value = d[0].innerHTML;
                document.getElementById("one_Old").value = d[0].innerHTML;
                document.getElementById("two").value = d[1].innerHTML;
                document.getElementById("two_Old").value = d[1].innerHTML;
                document.getElementById("tree").value = d[2].innerHTML;
                document.getElementById("tree_Old").value = d[2].innerHTML;
                document.getElementById("four").value = d[3].innerHTML;
                document.getElementById("four_Old").value = d[3].innerHTML;
                return;
                }  
            }
            document.getElementById("tblName").value=document.querySelector('caption').innerHTML;
            rowCount = -1
            })
        };
        function f(data){
            document.getElementsByTagName("article")[0].innerHTML = data;
        }
    function f1(op) { 
        //определяем, какая таблица сейчас открыта и записываем значение в скрытое поле
        tblName.setAttribute('value', document.querySelector('caption').innerHTML);
        //так же создаем отдельную переменную для названия таблицы, чтобы функция поняла какой шаблон проверки использовать
        tbl = document.querySelector('caption').innerHTML;

        one = document.getElementById("one").value;
        two = document.getElementById("two").value;        
        tree = document.getElementById("tree").value;    
        four = document.getElementById("four").value;
       
	    if (tbl == 'Классы') {   
            var errorText = "";
            data = one;
            var reg = new RegExp("[a-zA-Z](...)");
                if(reg.test(data) == true || data.length < 2 || data.length > 3){
                errorText += "Поле \"№ класса\" должно быть строкой из русских букв и цифр до 3-х символов\n";
                }
            data = Number.parseInt(two);
                if(isNaN(data) == true || data.length < 100 || data.length > 150){
                    errorText += "Поле \"Табельный № учителя\" должно быть числом в диапазоне от 100 до 150\n";
                }
            data = tree;
                if(reg.test(data) == true || data.length < 1 || data.length > 40){
                    errorText += "Поле \"Специализация класса\" должно быть строкой из русских букв до 40-ка символов\n";
                }
            data = Number.parseInt(four);  
                if(isNaN(data) == true || data < 1 || data > 999){
                    errorText += "Поле \"Классная комната\" должно быть числом в диапазоне от 1 до 999\n";
                }

                if(errorText != "") {
                    alert(errorText);
                }
                else{
                    Ok.setAttribute('value', op);
                }
            }
        else if (tbl == 'Работники школы'){
            var errorText = "";
            data = Number.parseInt(one);
            var reg = new RegExp("[a-zA-Z](...)");
                if(isNaN(data) == true || data < 1 || data > 150){
                errorText += "Поле \"Табельный номер\" должно быть числом в диапазоне от 100 до 150" + "<br></p>";
                }
            data = two;
                if(reg.test(data) == true || data.length < 1 || data.length > 40){
                    errorText += "Поле \"ФИО учителя\" должно быть строкой из русских букв до 40-ка символов\n";
                }
            data = tree;
                if(reg.test(data) == true || data.length < 1 || data.length > 15){
                    errorText += "Поле \"Должность/профессия\" должно быть строкой из русских букв до 15-ти символов\n";
                }
            data = four; 
            reg = new RegExp("[a-zA-Zа-я](...)"); 
                if(reg.test(data) == true || data.length < 1 || data.length > 1){
                    errorText += "Поле \"Пол\" должно быть строкой из русских букв из 1 символа\n";
                }

                if(errorText != "") {
                    alert(errorText);
                }
                else{
                    Ok.setAttribute('value', op);
                }
        } 
    else if (tbl == 'Школьники'||tbl == 'Школьники1'){
            var errorText = "";
            data = one;
            var reg = new RegExp("[a-zA-Z](...)");
                if(reg.test(data) == true || (data != '10А' && tbl == 'Школьники')){
                errorText += "Поле \"№ класса\" в таблице 'Школьники' должно иметь значение '10A'\n";
                }
                else if(reg.test(data) == true || (data != '11Б' && tbl == 'Школьники1')){
                errorText += "Поле \"№ класса\" в таблице 'Школьники1' должно иметь значение '11Б'\n";
                }
            data = Number.parseInt(two);
                if(isNaN(data) == true || data < 1 || data > 50){
                    errorText += "Поле \"Порядковый № в журнале\" должно быть числом в диапазоне от 1 до 50\n";
                }
            data = tree;
                if(reg.test(data) == true || data.length < 1 || data.length > 40){
                    errorText += "Поле \"ФИО школьника\" должно быть строкой из русских букв до 40-ка символов\n";
                }
            data = four; 
            reg = new RegExp("[a-zA-Zа-я](...)"); 
                if(reg.test(data) == true || data.length < 1 || data.length > 1){
                    errorText += "Поле \"Пол\" должно быть строкой из русских букв из 1 символа\n";
                }

                if(errorText != "") alert(errorText);
                else Ok.setAttribute('value', op);       
        }
		       
    };
     
    </script>
</head>
<body>
    <header>
        <img class="logo" src="https://cdn-icons-png.flaticon.com/512/4645/4645232.png" alt="logo">
        <h2>Лицей имени Жуковой</h2>
        <nav>
            <ul class="nav">
                <li><input type="submit" class="nav__item" value="Работники школы" onclick="getDate('selectRB.php','tables');getDate('./forms/formRB.txt','form');getStr();"></li>
                <li><input type="submit" class="nav__item" value="Классы" onclick="getDate('selectKL.php','tables');getDate('./forms/formKL.txt','form');getStr();"></li>
                <li><input type="submit" class="nav__item" value="Школьники" onclick="getDate('selectSHK.php','tables');getDate('./forms/formSHK.txt','form');getStr();"></li>
                <li><input type="submit" class="nav__item" value="Школьники1" onclick="getDate('selectSHK1.php','tables');getDate('./forms/formSHK.txt','form');getStr();"></li>
                <li><button class="nav__item" onclick="getDate('./forms/form2.txt','form')">Отчет</button></li>
            </ul>
        </nav>

        <div class="info">

            <ul>

                <li class="info__list">

                </li>
                <li class="info_list">Телефон: 88005553535</li>
                <li class="info_list">Почта: JuckLic@mail.ru</li>
                <a class="adress" href="https://goo.gl/maps/ibCerVgjkaHe86rn8">
                    Котельники,
                    Московская обл.,
                    140053
                    <img class="adress__icon" src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="">
                </a>
            </ul>

        </div>

    </header>
    
    <aside id="form">
     
    </aside>

    <main>
        <section class="vid" id="vid">
        <input type="submit" class="nav__item" value="Заполнить БД стандартно" onclick="getDate('create.php','vid')">
        <?php include_once 'IDU.php';?>
        </section>
        <section class="tables">
            <article id="tables">
            
            </article>
        </section>

    </main>

    <footer>
        <small>© 2022 "Лицей и.Жуковой". Жукова Анастасия Владиславовна</small>
    </footer>
    
</body>
</html>