<?php
$authorizedtoken = "token"; // token
$username = "username"; // username
$password = "password"; // password of the database
$hostname = "localhost"; // host of the database
$namebase = "database"; // name of the database
$port = "3306"; // port of the database


// Attempt to connect to the database
try {
    $bdd = new PDO('mysql:host=' . $hostname . ';dbname=' . $namebase . '', $username, $password);
} catch (Exception $e) {
    // If an error is thrown, display the message
    die('Erreur : ' . $e->getMessage());
}

?>
