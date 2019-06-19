<?php

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

$cookie_expiery = Config::get('cookie')['remember']['cookie_expiery'];


// DZ napraviti da ovaj način dohvaćamo propertije iz konfiguracije
// substr_count()
//$cookie_expiery = Config::get('cookie.remember.cookie_expiery');

//error_reporting(E_ALL);
ini_set('display_errors', Config::get('app')['error_reporting']);

require_once 'functions/sanitize.php';

?>