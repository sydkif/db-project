var defaultText, t;

window.onload = function () {
    var table = document.getElementById("table");
    var rows = table.getElementsByTagName("tr");
    for (var x = 1; x <= rows.length; x++) {
        document.getElementById("save" + x).hidden = true;
        document.getElementById("cancel" + x).hidden = true;
    }
};

function edit(n) {
    if (defaultText != null) {
        document.getElementById("name" + t).contentEditable = false;
        document.getElementById("update" + t).hidden = false;
        document.getElementById("save" + t).hidden = true;
        document.getElementById("cancel" + t).hidden = true;
        document.getElementById("name" + t).style.outlineStyle = "";
        document.getElementById("name" + t).style.outlineOffset = "";
        document.getElementById("name" + t).innerText = defaultText;
    }
    defaultText = document.getElementById("name" + n).innerText;
    document.getElementById("name" + n).contentEditable = true;
    document.getElementById("name" + n).focus();
    document.getElementById("update" + n).hidden = true;
    document.getElementById("save" + n).hidden = false;
    document.getElementById("cancel" + n).hidden = false;
    document.getElementById("name" + n).style.outlineStyle = "solid";
    document.getElementById("name" + n).style.outlineOffset = "-10px";
    t = n;
}

function cancel(n) {
    document.getElementById("name" + n).contentEditable = false;
    document.getElementById("update" + n).hidden = false;
    document.getElementById("save" + n).hidden = true;
    document.getElementById("cancel" + n).hidden = true;
    document.getElementById("name" + n).style.outlineStyle = "";
    document.getElementById("name" + n).style.outlineOffset = "";
    document.getElementById("name" + n).innerText = defaultText;
}

function update(table, n) {
    var id = document.getElementById("id" + n).innerText;
    var name = document.getElementById("name" + n).innerText;
    var url = ("../update.php?table=" + table + "&id=" + id + "&name=" + name);
    var msg = "Are you sure want to update this record?\n\n ID :\n" + id + "\n\n Name :\n" + name;
    var conf = confirm(msg);
    if (conf)
        window.location = "" + url;
}

function remove(table, n) {
    var id = document.getElementById("id" + n).innerText;
    var name = document.getElementById("name" + n).innerText;
    var url = ("../delete.php?table=" + table + "&id=" + id);
    var msg = "Are you sure want to delete this record?\n\n ID :\n" + id + "\n\n Name :\n" + name;
    var conf = confirm(msg);
    if (conf)
        window.location = "" + url;
}