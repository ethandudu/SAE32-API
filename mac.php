<?php

include ('config.php');
header('Content-Type: application/json');

//get the Authorization token from the header
$headers = apache_request_headers();
$tk = $headers['Authorization'];

if (isset($_GET['macsrc'])) {
    $macsrc = $_GET['macsrc'];
}

if (isset($_GET['macdst'])) {
    $macdst = $_GET['macdst'];
}

//check if the token is correct
if (isset($tk)){
    if ($tk == $authorizedtoken){
        if (isset($macdst) && isset($macsrc)){
            $reqbdd = $bdd->prepare('SELECT Organization FROM oui WHERE Assignment = :macsrc');
            $reqbdd->execute(array('macsrc' => $macsrc));
            if ($reqbdd->rowCount() == 0){
                $vendorsrc = 'Unknown';
            } else {
                $vendorsrc = $reqbdd->fetch();
                $vendorsrc = $vendorsrc['Organization'];
                if (strlen($vendorsrc) > 20){
                    $vendorsrc = substr($vendorsrc, 0, 20) . '.';
                }
                
            }
            $reqbdd->closeCursor();
            $reqbdd = $bdd->prepare('SELECT Organization FROM oui WHERE Assignment = :macdst');
            $reqbdd->execute(array('macdst' => $macdst));
            if ($reqbdd->rowCount() == 0){
                $vendordst = 'Unknown';
            } else {
                $vendordst = $reqbdd->fetch();
                $vendordst = $vendordst['Organization'];
                if (strlen($vendordst) > 20){
                    $vendordst = substr($vendordst, 0, 20) . '.';
                }
            }
            $reqbdd->closeCursor();
            header("HTTP/1.1 200 OK");
            $response = array(
                'responsecode' => '200',
                'message' => 'OK',
                'data' => array(
                    'vendorsrc' => $vendorsrc,
                    'vendordst' => $vendordst
                )
            );

            
        } else {
            header("HTTP/1.1 200 OK");
            $response = array(
                'responsecode' => '410',
                'message' => 'No mac address provided'
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
