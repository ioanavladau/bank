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
$iAmountToTransfer = $_GET['amount'];




if( !$jInnerData->$sPhoneFromOtherServer ){
    fnvSendResponse(0, __LINE__, "Phone not registered in BANK VLADAU");
}


// echo $jInnerData->$sPhoneFromOtherServer->balance;
// exit;
$jInnerData->$sPhoneFromOtherServer->balance += $iAmountToTransfer;

// $jInnerData->$_SESSION['sUserId']->balance -= $iAmountToTransfer;

$sData = json_encode($jData);

// file_put_contents('../data/clients.json', $sData);


$filename = '../data/clients.json';
$writable = ( is_writable($filename) ) ? TRUE : chmod($filename, 0755);
if ( !$writable ) {
    echo "BIG FAIL";
}
    file_put_contents($filename, $sData);






fnvSendResponse(1, __LINE__, "Transaction success with BANK VLADAU");

//************************/
function fnvSendResponse( $iStatus, $iLineNumber, $sMessage ){
    echo '{"status": '.$iStatus.', "code": '.$iLineNumber.', "message": "'.$sMessage.'"}';
    exit;
}

//get tthe amount and the message and 
//set the new balance to the phone number, 
//then reply to the server saying, that the transaction was successful

//else - no phone or something went wrong - reply with an error



//update the amount in the json