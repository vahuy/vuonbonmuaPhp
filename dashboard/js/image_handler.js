function display() {
    alert("Hello World!");
}
function getImageList(str) {
    if (str === "") {
        document.getElementById("txtHint").innerHTML = "empty";
        return;
    } else {
        console.log("get list");
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
        xmlhttp.open("GET","./processor/getProductImages.php?id="+str,true);
        xmlhttp.send();
    }
}