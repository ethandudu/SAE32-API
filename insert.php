<?php

include ('config.php');
header('Content-Type: application/json');

//get the Authorization token from the header
$headers = apache_request_headers();
$tk = $headers['Authorization'];

//check if the token is correct
if (isset($tk)){
    if ($tk == $authorizedtoken){
        if (isset($_POST['dataindex']) && isset($_POST['datapackets'])){
            $jsondata = json_decode($_POST['dataindex'], true);
            $reqindex = $bdd->prepare("INSERT INTO `index` (name, numberframe, datetime) VALUES (:name, :numberframe, :datetime)");
            $reqindex->bindParam(':name', $jsondata['name']);
            $reqindex->bindParam(':numberframe', $jsondata['numberframe']);
            $reqindex->bindParam(':datetime', $jsondata['datetime']);
            $reqindex->execute();
            $id = $bdd->lastInsertId();
            $reqindex->closeCursor();

            $datapackets = json_decode($_POST['datapackets'],true);
            foreach($datapackets["packets"] as $packet){
                $protocols = json_encode($packet['protocols']);
                $data = json_encode($packet['data']);
                $reqpacket = $bdd->prepare("INSERT INTO `packets` (fileid, packetid, protocols, macsrc, macdst, ipsrc, ipdst, data) VALUES (:fileid, :packetid, :protocols, :macsrc, :macdst, :ipsrc, :ipdst, :data)");
                $reqpacket->bindParam(':fileid', $id);
                $reqpacket->bindParam(':packetid', $packet['packetid']);
                $reqpacket->bindParam(':protocols', $protocols);
                $reqpacket->bindParam(':macsrc', $packet['macsrc']);
                $reqpacket->bindParam(':macdst', $packet['macdst']);
                $reqpacket->bindParam(':ipsrc', $packet['ipsrc']);
                $reqpacket->bindParam(':ipdst', $packet['ipdst']);
                $reqpacket->bindParam(':data', $data);
                $reqpacket->execute();
            }
            $reqpacket->closeCursor();

            

            header("HTTP/1.1 200 OK");
            $response = array(
                'responsecode' => '200',
                'message' => 'OK'
            );
        } else {
            if (!isset($_POST['dataindex']) && isset($_POST['datapackets'])){
                header("HTTP/1.1 200 OK");
                $response = array(
                    'responsecode' => '411',
                    'message' => 'No index data provided'
                );
            } elseif (isset($_POST['dataindex']) && !isset($_POST['datapackets'])){
                header("HTTP/1.1 200 OK");
                $response = array(
                    'responsecode' => '412',
                    'message' => 'No packets data provided'
                );
            } else {
                header("HTTP/1.1 200 OK");
                $response = array(
                    'responsecode' => '410',
                    'message' => 'No data provided'
                );
            }
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
