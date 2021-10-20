<?php
/**
 * Created by PhpStorm.
 * User: vahuy
 * Date: 1/18/2019
 * Time: 3:09 PM
 */
require "../../objects/CONSTANT.php";
$hint="";
$xmlDoc=new DOMDocument();
$xmlDoc->load(XML_PRODUCT_LOCATION_LV1);

$x=$xmlDoc->getElementsByTagName('product');

//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
    for($i=0; $i<($x->length); $i++) {
        $y=$x->item($i)->getElementsByTagName('name');
        $z=$x->item($i)->getElementsByTagName('id');
        $p=$x->item($i)->getElementsByTagName('image');
        if ($y->item(0)->nodeType==1) {
            //find a link matching the search text
            $id = $z->item(0)->childNodes->item(0)->nodeValue;
            $target = $y->item(0)->childNodes->item(0)->nodeValue;
            $image = $p->item(0)->childNodes->item(0)->nodeValue;
            if (stristr($target,$q)) {
                if ($hint=="") {
                    $hint="<p onclick='setProduct(this)' image='".$image ."' href='".$id ."' target='$target'>".$target . "</p>";
                } else {
                    $hint=$hint . "<p onclick='setProduct(this)' image='".$image ."' href='".$id ."' target='$target'>".$target."</p>";
                }
            }
        }
    }
}

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
    $response="no suggestion";
} else {
    $response=$hint;
}

//output the response
echo $response;
