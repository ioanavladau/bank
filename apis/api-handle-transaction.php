<?php
// header('Access-Control-Allow-Origin: *');
// validate we have the key

ini_set('display_errors', 0);

$sData = file_get_contents('../data/clients.json');
// convert it into an object
$jData = json_decode( $sData );
if( $jData == null ){ fnvSendResponse(-1, __LINE__, 'Cannot convert the data file to JSON'); }
$jInnerData = $jData->data;

$sPhoneFromOtherServer = $_GET['phone'];
$iAmountToTransfer = $_GET['amount'];
// fetch amount

if( ! $jInnerData->$sPhoneFromOtherServer ){
  fnvSendResponse(0, __LINE__, 'Phone not registered in BANK VLADAU');
}

$jInnerData->$sPhoneFromOtherServer->balance += $iAmountToTransfer;

$sData = json_encode($jData);
if( $sData == null ) { sendResponse(0, __LINE__, 'Could not write to file'); }
file_put_contents('../data/clients.json', $sData); // unknown


// before I find the match talk to json object and update the balance to be the balance + 
fnvSendResponse(1, __LINE__, 'Transaction success from BANK VLADAU');

// **************************************************

function fnvSendResponse( $iStatus, $iLine, $sMessage ){
  echo '{"status": '.$iStatus.', "code": '.$iLine.', "message": "'.$sMessage.'"}';
  exit; // exit kills the PHP script
}

// echo 'VISITING BANK VLADAU';
// if the phone exists in this bank
// get the amount and the message
// and set the new balance to the phone number
// then reply to the server saying that
// the transaction was successful
// else
// no prone or sth went wrong, reply with error

