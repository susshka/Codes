

// Добавление
function add() {
    var path = document.getElementById("path")
    var from = document.getElementById("from")
    var to = document.getElementById("to")
    var price = document.getElementById("price")
    var t = document.getElementsByTagName("table")[0]
    var r = t.getElementsByTagName("tr")
    for (var j = 1; j < r.length; j++) { // Пробегаем по всем строкам таблицы (пропустив заголовок)
        var d = r[j].getElementsByTagName("td")
        if (path.value == d[0].innerHTML) {
            alert("Запись с № маршрута = \"" + path.value + "\" уже существует")
            return false
        }
    }

    r = t.insertRow()
    d = document.createElement("td")
    d.innerHTML = path.value
    r.appendChild(d)

    d = document.createElement("td")
    d.style.textAlign = "left"
    d.innerHTML = from.value
    r.appendChild(d)

    d = document.createElement("td")
    d.innerHTML = to.value
    r.appendChild(d)

    d = document.createElement("td")
    d.innerHTML = price.value
    r.appendChild(d)

    return true

}

// Изменение
var rowCount = -1
function change() {

    let path = document.getElementById("path")
    let t = document.getElementsByTagName("table")[0]
    let r = t.getElementsByTagName("tr")
    for (let i = 1; i < r.length; i++) { // Пробегаем по всем строкам таблицы (пропустив заголовок)
        let d = r[i].getElementsByTagName("td")
        if ((path.value == d[0].innerHTML) && (i != rowCount)) {
            alert("Запись с № маршрута = \"" + path.value + "\" уже существует")
            return
        }
    }
    let d = r[rowCount].getElementsByTagName('td')
    d[0].innerHTML = document.getElementById("path").value
    d[1].innerHTML = document.getElementById("from").value
    d[2].innerHTML = document.getElementById("to").value
    d[3].innerHTML = document.getElementById("price").value

}


var select = document.getElementById("tbl")
select.addEventListener('click', (e) => {
    let cell = e.target;
    let t = cell.parentElement;
    let r = t.parentElement.children;
    for (rowCount = 1; rowCount < r.length; rowCount++) {
        if (r[rowCount] === t) {
            let d = r[rowCount].getElementsByTagName("td");
            document.getElementById("path").value = d[0].innerHTML;
            document.getElementById("from").value = d[1].innerHTML;
            document.getElementById("to").value = d[2].innerHTML;
            document.getElementById("price").value = d[3].innerHTML;

            return;
        }
    }
    rowCount = -1


})

// Удаление

function del() {
    let c = document.getElementById("path");
    let t = document.getElementsByTagName("table")[0];
    let r = t.getElementsByTagName("tr");
    for (let j = 1; j < r.length; j++) {
        // Пробегаем по всем строкам таблицы (пропустив заголовок)
        let d = r[j].getElementsByTagName("td");
        if (c.value == d[0].innerHTML) {
            t.deleteRow(j);
            return;
        }
    }
    alert("Запись с данным значением № зачетки не найдена");

}