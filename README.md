# SAE32-API
## Sommaire

## config.php
```php
<?php
$username = "username"; // username
$password = "password"; // password of the database
$hostname = "sub.domain.tld"; // host of the database
$namebase = "database"; // name of the database
$port = "3306"; // port of the database

$authorizedtoken = "token"; //token for the java app from "SAE32-Processing"

// Attempt to connect to the database
try {
    $bdd = new PDO('mysql:host=' . $hostname . ';dbname=' . $namebase . '', $username, $password);
} catch (Exception $e) {
    // If an error is thrown, display the message
    die('Erreur : ' . $e->getMessage());
}
?>
```
