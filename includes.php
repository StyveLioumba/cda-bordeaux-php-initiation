<?php

session_start();

try {
    $connection = new PDO("mysql:host=localhost;dbname=course", "root", "root");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    var_dump($e);
    die;
}
?>

