<?php

ini_set('user_agent', 'any');
ini_set('display_errors', 0);

$sData = file_get_contents('../data/clients.json');
$jData = json_decode( $sData );
if( $jData == null ){ fnvSendResponse(-1, __LINE__, 'Cannot convert the data file to json'); }
$jInnerData = $jData->data;

$sPhoneFromOtherServer = $_GET['phone'];
// $iAmountToTransfer = $_GET['amount'];

if( ! $jInnerData->$sPhoneFromOtherServer ){   
  fnvSendResponse(0, __LINE__, 'Phone not registered in BANK VLADAU');
}

// echo $jInnerData->$sPhoneFromOtherServer->balance;
// exit;
// $jInnerData->$sPhoneFromOtherServer->balance += $iAmountToTransfer;
$sData = json_encode($jData);
// if( $sData == null ) { sendResponse(-1, __LINE__); }
// file_put_contents('../data/clients.json', $sData); 
fnvSendResponse(1, __LINE__, 'Transaction success from BANK VLADAU');


// **************************************************
function fnvSendResponse( $iStatus, $iLineNumber, $sMessage ){
  echo '{"status":'.$iStatus.', "code":'.$iLineNumber.', "message":"'.$sMessage.'"}';
  exit;
}