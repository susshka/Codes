var rowCount = -1
function seek() {

    let path = document.getElementById("path")
    let from = document.getElementById("from")
    let to = document.getElementById("to")
    let price = document.getElementById("price")
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
