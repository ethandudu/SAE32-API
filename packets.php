<?php

include ('config.php');
header('Content-Type: application/json');

//get the Authorization token from the header
$headers = apache_request_headers();
$tk = $headers['Authorization'];

if (isset($_GET['fileid'])) {
    $fileid = $_GET['fileid'];
}

if (isset($_GET['packetid'])) {
    $packetid = $_GET['packetid'];
}

//check if the token is correct
if (isset($tk)){
    if ($tk == $authorizedtoken){
        if (isset($fileid)){
            if (isset($packetid)){
                header("HTTP/1.1 200 OK");
                $req = $bdd->prepare('SELECT * FROM `packets` WHERE fileid = :fileid AND packetid = :packetid');
                $req->bindParam(':fileid', $fileid);
                $req->bindParam(':packetid', $packetid);
                $req->execute();
                $response = array(
                    'responsecode' => '200',
                    'message' => 'OK',
                    'data' => $req->fetchAll()
                );
            } else {
                header("HTTP/1.1 200 OK");
                $req = $bdd->prepare('SELECT ID, fileid, protocols, macsrc, macdst, ipsrc, ipdst FROM `packets` WHERE fileid = :fileid');
                $req->bindParam(':fileid', $fileid);
                $req->execute();
                $response = array(
                    'responsecode' => '200',
                    'message' => 'OK',
                    'data' => $req->fetchAll()
                );
            }
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