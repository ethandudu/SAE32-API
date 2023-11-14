# SAE32-API
## Summary
- [Github Actions](#Github_Actions)
- [Installation](#Installation)

## Github Actions
Actual state of the Github Actions tests :
|Name|Status|
|----|------|
|Tests.php|[![Tests](https://github.com/ethandudu/SAE32-API/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/ethandudu/SAE32-API/actions/workflows/tests.yml)|
## Installation
### config.php example
Rename the `config.example.php` to `config.php` and edit the credentials
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
### Add secrets to your repo
Add two secrets named `url` and `token` wich are the url of your web server (like `https://sub.domain.tld`) and the token set in the `config.php` file
