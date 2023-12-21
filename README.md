# SAE32-API
## Summary
- [Github Actions](#Github_Actions)
- [Installation](#Installation)
    - [Requirements](#Requirements)
    - [Automatic installation](#Automatic_installation)
    - [Manual installation](#Manual_installation)
        - [config.php example](#config.php_example)
    - [(Optional) Add secrets to your repo](#(Optional)_Add_secrets_to_your_repo)

## Github Actions
Actual state of the Github Actions tests :
|Name|Status|
|----|------|
|Get tests|[![Tests](https://github.com/ethandudu/SAE32-API/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/ethandudu/SAE32-API/actions/workflows/tests.yml)|
## Installation
### Requirements
- A web server with PHP 7.3 or higher (8.1 recommended)
- A MariaDB or MySQL database (MariaDB 10.6 recommended)
### Automatic installation
Create a database and a user with all permissions on it then run the following commands
```
# go to your web server directory and run
git clone https://github.com/ethandudu/SAE32-API
# give all permissions of the directory to the web server user
chown -R www-data:www-data SAE32-API
```
go to https://yourwebserver.tld/SAE32-API/install.php and follow the instructions
### Manual installation
#### config.php example
Rename the `config.example.php` to `config.php` and edit the credentials
```php
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
```
### (Optional) Add secrets to your repo
If you want to use Github Actions, you can add secrets to your repo to automatically deploy the code to your web server

Add two secrets named `url` and `token` wich are the url of your web server (like `https://sub.domain.tld`) and the token set in the `config.php` file

## Credits
Made with ❤️ by Yanis Boukadida, Cyril Caparros & Ethan Duault