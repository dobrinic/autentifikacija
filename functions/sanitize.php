<?php

function escape($string){
    return htmlentities($string, ENT_QUOTES, "UTF-8");
}

function dd($obj){
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
    die();
}

?>
