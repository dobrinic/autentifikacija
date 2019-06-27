<?php

class Config {

    private function __construct(){}
    
    private function __clone(){}

    public static function get($path = null){

        if ($path) {

            $path_array = explode('.', $path);

            foreach ($path_array as $key => $value) {
                if ($key === 0) {
                    $items = require "config/$value.php";                        
                } else {
                    $items = $items[$value];
                }
            }
            return $items;        
        }
        
        return false;
    }
}

?>