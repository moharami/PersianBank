<?php

include_once 'lib/nusoap.php';

$ns = 'http://tejarat/paymentGateway/definitions';
$wsdl = "http://pg.sabapardazesh.net:9086/paymentGateway/services/merchant.wsdl";

if (isset($_POST['resultCode'])) {

    $resultCode = $_POST['resultCode'];
    $referenceId = isset($_POST['referenceId']) ? $_POST['referenceId'] : 0;
    $paymentID = isset($_SESSION["PaymentID"]) ? $_SESSION['PaymentID'] : 0;

    if (($resultCode == 100)) {
        try {
            $client = new nusoap_client($wsdl, true);

            $err = $client->getError();
            if ($err) {
                echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
                echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
            }

            $params = array(
                "verifyRequest" => array(
                    'merchantId' => 'A0F2S',
                    'referenceNumber' => $referenceId)

            );

            $client->setUseCurl(0);
            $client->soap_defencoding = 'UTF-8';
            $client->decode_utf8 = true;

            $client->setEndpoint($wsdl);
            $result = $client->call("verify", $params);


            

        } catch (Exception $ex) {

            echo '<h2>Error</h2><pre>' . $ex->getMessage() . '</pre>';
        }
    }
}
?>

