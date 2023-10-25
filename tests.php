<?php

include ('config.php');
header('Content-Type: application/json');

//get the Authorization token from the header
$headers = apache_request_headers();
$tk = $headers['Authorization'];

//check if the token is correct
if (isset($tk)){
    if ($tk == $authorizedtoken){
        header("HTTP/1.1 200 OK");
        $req = $bdd->prepare('SELECT * FROM `index` LIMIT 100');
        $req->execute();
        $response = array(
            'responsecode' => '200',
            'message' => 'OK',
            'data' => $req->fetchAll()
        );
    } else {
        header("HTTP/1.1 401 Unauthorized");        
        $response = array(
            'responsecode' => '400',
            'message' => 'Not authorized'
        );
    }
} else {
    header("HTTP/1.1 401 Unauthorized");
    $response = array(
        'responsecode' => '400',
        'message' => 'Not authorized'
    );
}

echo json_encode($response);
?>