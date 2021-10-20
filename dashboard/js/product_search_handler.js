let btnSearch = document.getElementById('btnSearch');
let input = document.getElementById('txtInput');

btnSearch.disabled = true;
let str = "";

function search() {
    if (str === "") {
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getproductbykey.php?q="+str,true);
        xmlhttp.send();
    }
}

function verify(value) {
    if (value.length >= 2) {
        btnSearch.disabled=false;
        str = value;
    }
}