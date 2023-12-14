<?php

include ('config.php');
header('Content-Type: application/json');

//get the Authorization token from the header
$headers = apache_request_headers();
$tk = $headers['Authorization'];

if (isset($_GET['fileid'])) {
    $fileid = $_GET['fileid'];
}

//check if the token is correct
if (isset($tk)){
    if ($tk == $authorizedtoken){
        if (isset($fileid)){
            header("HTTP/1.1 200 OK");
            $req = $bdd->prepare('DELETE FROM `index` WHERE ID = :fileid');
            $req->bindParam(':fileid', $fileid);
            $req->execute();
            $response = array(
                'responsecode' => '200',
                'message' => 'OK',
                'data' => $req->fetchAll()
            );
            $req->closeCursor();
        } else {
            header("HTTP/1.1 200 OK");
            $response = array(
                'responsecode' => '410',
                'message' => 'No fileid provided'
            );
        }
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
