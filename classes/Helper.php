<?php

class Helper{

    private function __construct(){}
    
    private function __clone(){}

    public static function getHeader($title, $path = 'header'){

        $header = require_once "includes/$path.php";

        return $header;
    }

    public static function getNav($path = 'nav'){

        $nav = require_once "includes/$path.php";

        return $nav;
    }

    public static function getFooter($path = 'footer'){

        return require_once "includes/$path.php";   
    }

}

?>