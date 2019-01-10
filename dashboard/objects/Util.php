<?php
/**
 * Created by PhpStorm.
 * User: vahuy
 * Date: 1/10/2019
 * Time: 2:54 PM
 */

class Util {
    function getUrl() {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $link = "https";
        else
            $link = "http";

        // Here append the common URL characters.
        $link .= "://";

        // Append the host(domain name, ip) to the URL.
        $link .= $_SERVER['HTTP_HOST'];

        // Append the requested resource location to the URL
        $link .= $_SERVER['REQUEST_URI'];

        // Print the link
        return $link;
    }

    function getUrlForNote($url) {
        $notePosition = $url->indexOf("?");
        echo $notePosition;
    }
}