function showResult(str) {
    if (str.length===0) {
        document.getElementById("livesearch").innerHTML="";
        document.getElementById("livesearch").style.border="0px";
        return;
    }
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState===4 && this.status===200) {
            document.getElementById("livesearch").innerHTML=this.responseText;
            document.getElementById("livesearch").style.border="1px solid #A5ACB2";
            document.getElementById("livesearch").style.display="block";
        }
    };
    xmlhttp.open("GET","./processor/livesearch.php?q="+str,true);
    xmlhttp.send();
}

function setProduct(object) {
    const id = object.getAttribute("href");
    const name = object.getAttribute("target");
    const mainPhoto = object.getAttribute("image");

    document.getElementById('productName').value = name.toString();
    document.getElementById('productId').value = id.toString();
    document.getElementById("livesearch").style.display="none";
    document.getElementById('mainphoto').src = mainPhoto;
}

function clearSearch() {
    document.getElementById('searchField').value = null;
}

function getImageList(str) {
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
        xmlhttp.open("GET","./processor/getProductImages.php?id="+str,true);
        xmlhttp.send();
    }
}

function getProductMoreInfo(str) {
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
        xmlhttp.open("GET","./getproductmoreinfo.php?id="+str,true);
        xmlhttp.send();
    }
}