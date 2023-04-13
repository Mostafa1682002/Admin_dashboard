<?php
try {
    //Host===================
    // $host = 'sql207.eb2a.com';
    // $dbname = 'eb2a_33593927_E_commerce';
    // $user = 'eb2a_33593927';
    // $password = 'most1682002';
    //Localhost==================
    $host = 'localhost';
    $dbname = 'ecommerce';
    $user = 'root';
    $password = '';
    $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;", $user, $password);
} catch (Exception $e) {
    echo  $e->getMessage();
}
