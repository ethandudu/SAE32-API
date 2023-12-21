<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])) {
    $filename = "../config.php";
    $content = "<?php\n";
    $content .= "\$authorizedtoken = \"" . $_POST['token'] . "\"; // token\n";
    $content .= "\$username = \"" . $_POST['username'] . "\"; // username\n";
    $content .= "\$password = \"" . $_POST['password'] . "\"; // password of the database\n";
    $content .= "\$hostname = \"" . $_POST['host'] . "\"; // host of the database\n";
    $content .= "\$namebase = \"" . $_POST['database'] . "\"; // name of the database\n";
    $content .= "\$port = \"" . $_POST['port'] . "\"; // port of the database\n";
    $content .= "\n";
    $content .= "\n";
    $content .= "// Attempt to connect to the database\n";
    $content .= "try {\n";
    $content .= "    \$bdd = new PDO('mysql:host=' . \$hostname . ';dbname=' . \$namebase . '', \$username, \$password);\n";
    $content .= "} catch (Exception \$e) {\n";
    $content .= "    // If an error is thrown, display the message\n";
    $content .= "    die('Erreur : ' . \$e->getMessage());\n";
    $content .= "}\n";
    $content .= "\n";
    $content .= "?>";

    $handle = fopen($filename, "w+");
    fwrite($handle, $content);
    fclose($handle);

    include('../config.php');
    //insert database.sql
    $sql = file_get_contents('database.sql');
    $bdd->exec($sql);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Installation - SAE32</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/tooplate.css">
</head>

<body id="application">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  mx-auto">
                <header class="mt-5 mb-5 text-center">
                    <h1>SAE32</h1>
                    <h3>Installation</h3>
                    <p class="tm-form-description">Bienvenue dans l'installateur automatisé de l'API SAE32. Renseignez les champs ci-dessous pour commencer l'installation.</p>
                </header>
                <?php 
                if (isset($_POST['submit'])) {
                    echo "<div class=\"alert alert-success\" role=\"alert\">
                    L'installation s'est déroulée avec succès !
                  </div>";
                }
                ?>
                <form action="" method="post" enctype="multipart/form-data" class="tm-form-white tm-font-big">
                    <div class="tm-bg-white tm-form-pad-big">
                        <div class="form-group mb-5">
                            <h4>Base de données</h4>
                            <label for="username" class="black-text mb-4 big">Nom d'utilisateur</label>
                            <input id="username" name="username" type="text" class="validate tm-input-white-bg" autofocus required>
                            <label for="password" class="balck-text mb-4 big">Mot de passe</label>
                            <input id="password" name="password" type="password" class="validate tm-input-white-bg" required>
                            <label for="host" class="black-text mb-4 big">Hôte</label>
                            <input id="host" name="host" type="text" class="validate tm-input-white-bg" required>
                            <label for="database" class="black-text mb-4 big">Nom de la base de données</label>
                            <input id="database" name="database" type="text" class="validate tm-input-white-bg" required>
                            <label for="port" class="black-text mb-4 big">Port</label>
                            <input id="port" name="port" type="number" class="validate tm-input-white-bg" required>
                        </div>
                        <div class="form-group mb-5">
                            <h4>Administration</h4>
                            <label for="token" class="black-text mb-4 big">Token</label>
                            <input id="token" name="token" type="text" class="validate tm-input-white-bg" required>
                            <label for="generate" class="black-text mb-4 big">Générer un token</label>
                            <button id="generate" name="generate" type="button" class="waves-effect btn-large btn-large-white" onclick="generateToken()">Générer</button>
                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <button type="submit" class="waves-effect btn-large btn-large-white" value="submit" id="submit" name="submit">Installer</button>
                    </div>
                </form>
            </div>
        </div>
        <footer class="row tm-mt-big mb-3">
            <div class="col-xl-12 text-center">
                <p class="d-inline-block tm-bg-black white-text py-2 tm-px-5">
                    SAE32 - Yanis Boukadida, Cyril Caparros, Ethan Duault
                </p>
            </div>
        </footer>
    </div>

    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
        function generateToken(){
            console.log("test")
    var token = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@%$=+?[]{}-_&";
    for(var i = 0; i < 16; i++){
        token += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    //change the value of the input
    document.getElementById('token').value = token;
}

    </script>
</body>

</html>