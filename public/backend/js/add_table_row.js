let tbody = document.querySelector('#tbody');
let addBtn = document.querySelector('#addBtn');

let IdString = "tablerow";

let i = 4;
function creatTableEl(id, pname, pweight, pprice) {
    const createTR = document.createElement("tr");
    createTR.setAttribute("id", id);
    tbody.appendChild(createTR);
    const createTD1 = document.createElement("td");
    const createTD2 = document.createElement("td");
    const createTD3 = document.createElement("td");
    const createTD4 = document.createElement("td");
    createTR.append(createTD1, createTD2, createTD3, createTD4);

    //for td 1 for Product Name
    const createInputField1 = document.createElement("input");
    createTD1.appendChild(createInputField1);
    createInputField1.setAttribute("type", "text");
    createInputField1.setAttribute("name", pname);
    createInputField1.setAttribute('id', pname);
    createInputField1.setAttribute('class', 'form-control');

    //for td 2 for Product Weight
    const createInputField2 = document.createElement("input");
    createTD2.appendChild(createInputField2);
    createInputField2.setAttribute("type", "text");
    createInputField2.setAttribute("name", pweight);
    createInputField2.setAttribute('id', pweight);
    createInputField2.setAttribute('class', 'form-control');

    //for td 3 or Product Price
    const createInputField3 = document.createElement("input");
    createTD3.appendChild(createInputField3);
    createInputField3.setAttribute("type", "number");
    createInputField3.setAttribute("name", pprice);
    createInputField3.setAttribute("id", pprice);
    createInputField3.setAttribute("class", "form-control");

    //for Delete Button or td six.
    createTD4.style.textAlign = "center";
    createTD4.style.fontWeight = "800";
    createTD4.setAttribute("id", "Delete");
    createTD4.innerHTML = "&#10006";
    createTD4.style.color = "orange";
    createTD4.style.cursor = "pointer";
    createTD4.addEventListener("mouseover", changeStyleOver);
    function changeStyleOver() {
        createTD4.style.color = "red";
    }
    createTD4.addEventListener("mouseout", changeStyleOut);
    function changeStyleOut() {
        createTD4.style.color = "orange";
    }
    //for Delete Button
    createTD4.addEventListener("click", DeleteCells);
    function DeleteCells() {
        i--;
        tablerowlength(i);
        const deleteCellIDs = createTR.getAttribute("id");
        // console.log(deleteCellIDs);
        createTR.remove(deleteCellIDs);
    }
    return createTR;
}
function tablerowlength(len) {
    document.getElementById('tablelength').value = len;
}

function addTableRowBtn() {
    let id = IdString + i;
    let pname = 'pname' + i;
    let pweight = 'pweight' + i;
    let pprice = 'pprice' + i;
    i++;
    const tableEle = creatTableEl(id, pname, pweight, pprice);
    tablerowlength(i);
    tbody.insertBefore(tableEle, addBtn);
}

function Table() {
    for (let y = 0; y < 4; y++) {
        let id = IdString + y;
        let pname = 'pname' + y;
        let pweight = 'pweight' + y;
        let pprice = 'pprice' + y;
        const constTableEle = creatTableEl(id, pname, pweight, pprice);
        tablerowlength(4);
        tbody.insertBefore(constTableEle, addBtn);
    }
    addBtn.addEventListener("click", addTableRowBtn);

}
Table();