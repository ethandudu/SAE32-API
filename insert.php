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
            $jsondata = ($_POST['dataindex']);
            $reqindex = $bdd->prepare("INSERT INTO `index` ('name', 'numberframe', 'datetime') VALUES (:name, :numberframe, :datetime)");
            $reqindex->bindParam(':name', $_POST['name']);
            $reqindex->bindParam(':numberframe', $_POST['numberframe']);
            $reqindex->bindParam(':datetime', $_POST['datetime']);
            $reqindex->execute();
            $id = $bdd->lastInsertId();

            $jsondata = ($_POST['datapackets']);
            //execute many queries
            $req = $bdd->prepare("INSERT INTO `packets` ('fileid', 'packetid', 'protocols', 'macsrc', 'macdst', 'ipsrc', 'ipdst', 'data') VALUES (:fileid, :packetid, :protocols, :macsrc, :macdst, :ipsrc, :ipdst, :data)");
            $req->bindParam(':fileid', $id);
            $req->bindParam(':packetid', $packetid);
            $req->bindParam(':protocols', $protocols);
            $req->bindParam(':macsrc', $macsrc);
            $req->bindParam(':macdst', $macdst);
            $req->bindParam(':ipsrc', $ipsrc);
            $req->bindParam(':ipdst', $ipdst);
            $req->bindParam(':data', $data);
            foreach ($jsondata as $packet) {
                $packetid = $packet['packetid'];
                $protocols = $packet['protocols'];
                $macsrc = $packet['macsrc'];
                $macdst = $packet['macdst'];
                $ipsrc = $packet['ipsrc'];
                $ipdst = $packet['ipdst'];
                $data = $packet['data'];
                $req->execute();
            }
            $req->closeCursor();

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