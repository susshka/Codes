function seek() {
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

