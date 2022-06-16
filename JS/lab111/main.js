var rowCount
var select = document.getElementById("tbl")
select.addEventListener('click', (e) => {
    let cell = e.target;
    let t = cell.parentElement;
    let r = t.parentElement.children;
    for (rowCount = 1; rowCount < r.length; rowCount++) {
        if (r[rowCount] === t) {
            let d = r[rowCount].getElementsByTagName("td");
            document.getElementById("path").value = d[0].innerHTML;
            document.getElementById("path_Old").value = d[0].innerHTML;
            document.getElementById("from").value = d[1].innerHTML;
            document.getElementById("from_Old").value = d[1].innerHTML;
            document.getElementById("to").value = d[2].innerHTML;
            document.getElementById("to_Old").value = d[2].innerHTML;
            document.getElementById("price").value = d[3].innerHTML;
            document.getElementById("price_Old").value = d[3].innerHTML;

        }
    }
    rowCount = -1


})