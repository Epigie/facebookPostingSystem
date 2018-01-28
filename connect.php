<?php
$dsn = 'mysql:host=localhost;dbname=ajax';
$username = 'root';
$passwd = '';

try{
    $connect = new PDO($dsn, $username, $passwd);
}catch(PDOException $e){
    die('There\'s Problem : '.$e->getMessage());
}
?>