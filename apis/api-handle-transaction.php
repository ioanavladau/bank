<?php 
ini_set('display_errors', 0);
session_start();
//if phone exists in this bank

$sData = file_get_contents('../data/clients.json');
$jData = json_decode($sData);
if($jData == null){
    fnvSendResponse(-1, __LINE__, "Cannot convert the data file to JSON");
}
$jInnerData = $jData->data;

$sPhoneFromOtherServer = $_GET['phone'];
echo $sPhoneFromOtherServer;
$iAmountFromOtherServer = $_GET['amount'];
$sMessageFromOtherServer = $_GET['message'];

// TODO: validate

if( !$jInnerData->$sPhoneFromOtherServer ){
    fnvSendResponse(0, __LINE__, "Phone not registered in BANK VLADAU");
}

$jInnerData->$sPhoneFromOtherServer->balance += $iAmountFromOtherServer;

// $jTransaction is one transaction
$jTransaction->date = time(); 
$jTransaction->amount = $iAmountFromOtherServer;
$jTransaction->name = 'AA';
$jTransaction->lastName = 'AAAA';
$jTransaction->fromPhone = $sPhoneFromOtherServer;
$jTransaction->message = $sMessageFromOtherServer;

$sTransactionUniqueId = uniqid();

$jInnerData->$sPhoneFromOtherServer->transactionsNotRead->$sTransactionUniqueId = $jTransaction;
$jInnerData->$sPhoneFromOtherServer->transactions->$sTransactionUniqueId = $jTransaction;




$sData = json_encode($jData);
file_put_contents('../data/clients.json', $sData);



fnvSendResponse(1, __LINE__, "Transaction success with BANK VLADAU");


// ************************************************************************

function fnvSendResponse( $iStatus, $iLineNumber, $sMessage ){
    echo '{"status": '.$iStatus.', "code": '.$iLineNumber.', "message": "'.$sMessage.'"}';
    exit;
}

//get the amount and the message and 
//set the new balance to the phone number, 
//then reply to the server saying, that the transaction was successful

//else - no phone or something went wrong - reply with an error



//update the amount in the json