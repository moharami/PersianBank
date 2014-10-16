<html>
<head>
	<title>BP PGW Test</title>
	<link href="Css/Style.css" rel="stylesheet" type="text/css" />

	<script language="javascript" type="text/javascript">    
		function postRefId (refIdValue) {
			var form = document.createElement("form");
			form.setAttribute("method", "POST");
			form.setAttribute("action", "https://pgwtest.bpm.bankmellat.ir/pgwchannel/startpay.mellat");         
			form.setAttribute("target", "_self");
			var hiddenField = document.createElement("input");              
			hiddenField.setAttribute("name", "RefId");
			hiddenField.setAttribute("value", refIdValue);
			form.appendChild(hiddenField);

			document.body.appendChild(form);         
			form.submit();
			document.body.removeChild(form);
		}
		
		function initData()
		{
			document.getElementById("PayDate").value = "20091005";
			document.getElementById("PayTime").value = "140351";
			document.getElementById("PayAmount").value = "100";
			document.getElementById("PayOrderId").value = "1";
			document.getElementById("PayAdditionalData").value = "Customer No: 15220";
			document.getElementById("PayCallBackUrl").value = "http://www.yoursite.com/BPPHPSample/callback.php";
			document.getElementById("PayPayerId").value = "0";
		}
	</script>
</head>

<body>
    <form name="form1" method="post" preservedata="true">
    <table width="100%" cellspacing="0" cellpadding="0" align="center">
        <tr>
            <td>
                <table class="InputTable" cellspacing="5" cellpadding="1" align="center">
                    <tr>
                        <td>
                            <table class="MainTable" cellspacing="5" cellpadding="1" align="center">
                                <tr class="HeaderTr">
                                    <td colspan="2" align="center" height="25">
                                        <span class="HeaderText">BPM PGW Method Call</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>TerminalId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="TerminalId" value="<?php echo $_POST['TerminalId'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>UserName</span>
                                    </td>
                                    <td>
                                        <input type="text" name="UserName" value="<?php echo $_POST['UserName'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>UserPassword</span>
                                    </td>
                                    <td>
                                        <input type="text" name="UserPassword" value="<?php echo $_POST['UserPassword'] ?>">
                                    </td>
                                </tr>
                            </table>
                            <hr />
                            <table class="MainTable" cellspacing="5" cellpadding="1" align="center">
                                <tr class="HeaderTr">
                                    <td colspan="2" align="center" height="25">
                                        <span class="HeaderText">Pay Request Method Call</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>LocalDate</span>
                                    </td>
                                    <td>
                                        <input type="text" name="PayDate" id="PayDate" value="<?php echo $_POST['PayDate'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>LocalTime</span>
                                    </td>
                                    <td>                                    
                                        <input type="text" name="PayTime" id="PayTime" value="<?php echo $_POST['PayTime'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>Amount</span>
                                    </td>
                                    <td>
                                        <input type="text" name="PayAmount" id="PayAmount" value="<?php echo $_POST['PayAmount'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>OrderId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="PayOrderId" id="PayOrderId" value="<?php echo $_POST['PayOrderId'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>AdditionalData</span>
                                    </td>
                                    <td>
                                        <input type="text" name="PayAdditionalData" id="PayAdditionalData" value="<?php echo $_POST['PayAdditionalData'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>CallBackUrl</span>
                                    </td>
                                    <td>
                                        <input type="text" name="PayCallBackUrl" id="PayCallBackUrl" value="<?php echo $_POST['PayCallBackUrl'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>PayerId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="PayPayerId" id="PayPayerId" value="<?php echo $_POST['PayPayerId'] ?>">
                                    </td>
                                </tr>
                                <tr class="HeaderTr">
                                    <td colspan="2" align="center">
                                        <input type="submit" CssClass="PublicButton" name="PayRequestButton" value="Pay"/>
                                    </td>
                                </tr>
                            </table>
                            <hr />
                            <table class="MainTable" cellspacing="5" cellpadding="1" align="center">
                                <tr class="HeaderTr">
                                    <td colspan="2" align="center" height="25">
                                        <span class="HeaderText">Verify Request Method Call</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>OrderId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="VerifyOrderId" value="<?php echo $_POST['VerifyOrderId'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>SaleOrderId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="VerifySaleOrderId" value="<?php echo $_POST['VerifySaleOrderId'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>SaleReferenceId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="VerifySaleReferenceId" value="<?php echo $_POST['VerifySaleReferenceId'] ?>">
                                    </td>
                                </tr>
                                <tr class="HeaderTr">
                                    <td colspan="2" align="center">
                                        <input type="submit" CssClass="PublicButton" name="VerifyRequestButton" value="Verify"/>
                                    </td>
                                </tr>
                            </table>
                            <hr />
                            <table class="MainTable" cellspacing="5" cellpadding="1" align="center">
                                <tr class="HeaderTr">
                                    <td colspan="2" align="center" height="25">
                                        <span class="HeaderText">Inquiry Request Method Call</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>OrderId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="InquiryOrderId" value="<?php echo $_POST['InquiryOrderId'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>SaleOrderId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="InquirySaleOrderId" value="<?php echo $_POST['InquirySaleOrderId'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>SaleReferenceId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="InquirySaleReferenceId" value="<?php echo $_POST['InquirySaleReferenceId'] ?>">
                                    </td>
                                </tr>
                                <tr class="HeaderTr">
                                    <td colspan="2" align="center">
                                        <input type="submit" CssClass="PublicButton" name="InquiryRequestButton" value="Inquiry"/>
                                    </td>
                                </tr>
                            </table>    
                            <hr />
                            <table class="MainTable" cellspacing="5" cellpadding="1" align="center">
                                <tr class="HeaderTr">
                                    <td colspan="2" align="center" height="25">
                                        <span class="HeaderText">Reversal Request Method Call</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>OrderId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="ReversalOrderId" value="<?php echo $_POST['ReversalOrderId'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>SaleOrderId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="ReversalSaleOrderId" value="<?php echo $_POST['ReversalSaleOrderId'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>SaleReferenceId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="ReversalSaleReferenceId" value="<?php echo $_POST['ReversalSaleReferenceId'] ?>">
                                    </td>
                                </tr>
                                <tr class="HeaderTr">
                                    <td colspan="2" align="center">
                                        <input type="submit" CssClass="PublicButton" name="ReversalRequestButton" value="Reversal"/>
                                    </td>
                                </tr>
                            </table>
                            <hr />
                            <table class="MainTable" cellspacing="5" cellpadding="1" align="center">
                                <tr class="HeaderTr">
                                    <td colspan="2" align="center" height="25">
                                        <span class="HeaderText">Settle Request Method Call</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>OrderId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="SettleOrderId" value="<?php echo $_POST['SettleOrderId'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>SaleOrderId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="SettleSaleOrderId" value="<?php echo $_POST['SettleSaleOrderId'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelTd">
                                        <span>SaleReferenceId</span>
                                    </td>
                                    <td>
                                        <input type="text" name="SettleSaleReferenceId" value="<?php echo $_POST['SettleSaleReferenceId'] ?>">
                                    </td>
                                </tr>
                                <tr class="HeaderTr">
                                    <td colspan="2" align="center">
                                        <input type="submit" CssClass="PublicButton" name="SettleRequestButton" value="Settle"/>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </form>
</body>

<?php
	require_once("./lib/nusoap.php");
		
	//curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	//$page = curl_exec ($ch);

	$client = new soapclient('https://pgwstest.bpm.bankmellat.ir/pgwchannel/services/pgw?wsdl');
	$namespace='http://interfaces.core.sw.bps.com/';

	///////////////// PAY REQUEST

	if (isset($_POST['PayRequestButton'])) 
	{ 
		$terminalId = $_POST['TerminalId'];
		$userName = $_POST['UserName'];
		$userPassword = $_POST['UserPassword'];
		$orderId = $_POST['PayOrderId'];
		$amount = $_POST['PayAmount'];
		//$date =  date("YYMMDD");
		//$time =  date("HHIISS");
		$localDate = $_POST['PayDate'];
		$localTime = $_POST['PayTime'];
		$additionalData = $_POST['PayAdditionalData'];
		$callBackUrl = $_POST['PayCallBackUrl'];
		$payerId = $_POST['PayPayerId'];

		// Check for an error
		$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			die();
		}
	  
		$parameters = array(
			'terminalId' => $terminalId,
			'userName' => $userName,
			'userPassword' => $userPassword,
			'orderId' => $orderId,
			'amount' => $amount,
			'localDate' => $localDate,
			'localTime' => $localTime,
			'additionalData' => $additionalData,
			'callBackUrl' => $callBackUrl,
			'payerId' => $payerId);

		// Call the SOAP method
		$result = $client->call('bpPayRequest', $parameters, $namespace);
		
		// Check for a fault
		if ($client->fault) {
			echo '<h2>Fault</h2><pre>';
			print_r($result);
			echo '</pre>';
			die();
		} 
		else {
			// Check for errors
			
			$resultStr  = $result;

			$err = $client->getError();
			if ($err) {
				// Display the error
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
				die();
			} 
			else {
				// Display the result

				$res = explode (',',$resultStr);

				echo "<script>alert('Pay Response is : " . $resultStr . "');</script>";
				echo "Pay Response is : " . $resultStr;

				$ResCode = $res[0];
				
				if ($ResCode == "0") {
					// Update table, Save RefId
					echo "<script language='javascript' type='text/javascript'>postRefId('" . $res[1] . "');</script>";
				} 
				else {
				// log error in app
					// Update table, log the error
					// Show proper message to user
				}
			}// end Display the result
		}// end Check for errors
	}
	else
	{	
		echo "<script>initData();</script>";
	}
	
	///////////////// VERIFY REQUEST
	
	if (isset($_POST['VerifyRequestButton'])) 
	{ 
		$terminalId = $_POST['TerminalId'];
		$userName = $_POST['UserName'];
		$userPassword = $_POST['UserPassword'];
		$orderId = $_POST['VerifyOrderId'];
		$verifySaleOrderId = $_POST['VerifySaleOrderId'];
		$verifySaleReferenceId = $_POST['VerifySaleReferenceId'];

		// Check for an error
		$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			die();
		}
	  	  
		$parameters = array(
			'terminalId' => $terminalId,
			'userName' => $userName,
			'userPassword' => $userPassword,
			'orderId' => $orderId,
			'saleOrderId' => $verifySaleOrderId,
			'saleReferenceId' => $verifySaleReferenceId);

		// Call the SOAP method
		$result = $client->call('bpVerifyRequest', $parameters, $namespace);

		// Check for a fault
		if ($client->fault) {
			echo '<h2>Fault</h2><pre>';
			print_r($result);
			echo '</pre>';
			die();
		} 
		else {

			$resultStr = $result;
			
			$err = $client->getError();
			if ($err) {
				// Display the error
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
				die();
			} 
			else {
				// Display the result
				// Update Table, Save Verify Status 
				// Note: Successful Verify means complete successful sale was done.
				echo "<script>alert('Verify Response is : " . $resultStr . "');</script>";
				echo "Verify Response is : " . $resultStr;
			}// end Display the result
		}// end Check for errors
	}	
		
	///////////////// INQUIRY REQUEST
	
	if (isset($_POST['InquiryRequestButton'])) 
	{ 
		$terminalId = $_POST['TerminalId'];
		$userName = $_POST['UserName'];
		$userPassword = $_POST['UserPassword'];
		$orderId = $_POST['InquiryOrderId'];
		$inquirySaleOrderId = $_POST['InquirySaleOrderId'];
		$inquirySaleReferenceId = $_POST['InquirySaleReferenceId'];

		// Check for an error
		$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			die();
		}
	  	  
		$parameters = array(
			'terminalId' => $terminalId,
			'userName' => $userName,
			'userPassword' => $userPassword,
			'orderId' => $orderId,
			'saleOrderId' => $inquirySaleOrderId,
			'saleReferenceId' => $inquirySaleReferenceId);

		// Call the SOAP method
		$result = $client->call('bpInquiryRequest', $parameters, $namespace);

		// Check for a fault
		if ($client->fault) {
			echo '<h2>Fault</h2><pre>';
			print_r($result);
			echo '</pre>';
			die();
		} 
		else {
			$resultStr = $result;
			
			$err = $client->getError();
			if ($err) {
				// Display the error
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
				die();
			} 
			else {
				// Update Table, Save Inquiry Status 
				// Note: Successful Inquiry means complete successful sale was done.
				echo "<script>alert('Inquiry Response is : " . $resultStr . "');</script>";
				echo "Inquiry Response is : " . $resultStr;
			}// end Display the result
		}// end Check for errors
	}	
		
	///////////////// REVERSAL REQUEST
	
	if (isset($_POST['ReversalRequestButton'])) 
	{ 
		$terminalId = $_POST['TerminalId'];
		$userName = $_POST['UserName'];
		$userPassword = $_POST['UserPassword'];
		$orderId = $_POST['ReversalOrderId'];
		$reversalSaleOrderId = $_POST['ReversalSaleOrderId'];
		$reversalSaleReferenceId = $_POST['ReversalSaleReferenceId'];

		// Check for an error
		$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			die();
		}
	  	  
		$parameters = array(
			'terminalId' => $terminalId,
			'userName' => $userName,
			'userPassword' => $userPassword,
			'orderId' => $orderId,
			'saleOrderId' => $reversalSaleOrderId,
			'saleReferenceId' => $reversalSaleReferenceId);

		// Call the SOAP method
		$result = $client->call('bpReversalRequest', $parameters, $namespace);

		// Check for a fault
		if ($client->fault) {
			echo '<h2>Fault</h2><pre>';
			print_r($result);
			echo '</pre>';
			die();
		} 
		else {
			$resultStr = $result;
			
			$err = $client->getError();
			if ($err) {
				// Display the error
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
				die();
			} 
			else {
				// Update Table, Save Reversal Status 
				// Note: Successful Reversal means that sale is reversed.
				echo "<script>alert('Reversal Response is : " . $resultStr . "');</script>";
				echo "Reversal Response is : " . $resultStr;
			}// end Display the result
		}// end Check for errors
	}	
		
	///////////////// SETTLE REQUEST
	
	if (isset($_POST['SettleRequestButton'])) 
	{ 
		$terminalId = $_POST['TerminalId'];
		$userName = $_POST['UserName'];
		$userPassword = $_POST['UserPassword'];
		$orderId = $_POST['SettleOrderId'];
		$settleSaleOrderId = $_POST['SettleSaleOrderId'];
		$settleSaleReferenceId = $_POST['SettleSaleReferenceId'];

		// Check for an error
		$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			die();
		}
	  	  
		$parameters = array(
			'terminalId' => $terminalId,
			'userName' => $userName,
			'userPassword' => $userPassword,
			'orderId' => $orderId,
			'saleOrderId' => $settleSaleOrderId,
			'saleReferenceId' => $settleSaleReferenceId);

		// Call the SOAP method
		$result = $client->call('bpSettleRequest', $parameters, $namespace);

		// Check for a fault
		if ($client->fault) {
			echo '<h2>Fault</h2><pre>';
			print_r($result);
			echo '</pre>';
			die();
		} 
		else {
			$resultStr = $result;
			
			$err = $client->getError();
			if ($err) {
				// Display the error
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
				die();
			} 
			else {
				// Update Table, Save Settle Status 
				// Note: Successful Settle means that sale is settled.
				echo "<script>alert('Settle Response is : " . $resultStr . "');</script>";
				echo "Settle Response is : " . $resultStr;
			}// end Display the result
		}// end Check for errors
	}	
?>



</html>