<?php
/**
 * Created by PhpStorm.
 * User: vahuy
 * Date: 1/10/2019
 * Time: 2:54 PM
 */

class UTIL {
    static function getUrl() {
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

    static function getUrlForNote($url) {
        $notePosition = $url->indexOf("?");
        echo $notePosition;
    }

    static function formatCurrency($number) {
        $number = floatval($number);
        return	number_format("$number")." vnđ<br>";
    }
}