<?php

ini_set('display_errors', 0);
ini_set('user_agent', 'any');

// AJAX!
// constrain it for logged users
session_start();
if( !isset($_SESSION['sUserId']) ) { // or !isset($_SESSION['sUserId']) 
  sendResponse(-1, __LINE__, 'You must login to use this api');
}

// $sPhoneToCheck = $_GET['phone'] || '';
if(empty($_GET['phone'])){ sendResponse(-1, __LINE__, 'Phone is missing'); }
if(empty($_GET['amount'])){ sendResponse(-1, __LINE__, 'Amount is missing'); }

$sPhone = $_GET['phone'] ?? '';
if( strlen($sPhone) != 8 ) { sendResponse(-1, __LINE__, 'Phone must be 8 characters in length'); }
if( ctype_digit($sPhone) == false ) { sendResponse(-1, __LINE__, 'Phone can only be numbers'); }

$sAmount = $_GET['amount'] ?? '';
if( strlen($sPhone) != 8 ) { sendResponse(-1, __LINE__, 'Phone must be 8 characters in length'); }
if( ctype_digit($sPhone) == false ) { sendResponse(-1, __LINE__, 'Phone can only be numbers'); }

// validate amount
$iAmount = $_GET['amount'] ?? '';




$sData = file_get_contents('../data/clients.json');
// echo $sData;
$jData = json_decode($sData);
if( $jData == null ) { sendResponse(-1, __LINE__, 'Cannot convert data to JSON'); }

$jInnerData = $jData->data;

if( ! $jInnerData->$sPhone ){
  $jListOfBanks = fnjGetListOfBanksFromCentralBank();
  // loop through the list
  // connect to each bank

  foreach( $jListOfBanks as $sKey => $jBank ){
    // echo $jBank->url;
    // echo $jBank->key;
    $sUrl = $jBank->url.'/apis/api-handle-transaction?phone='.$sPhone; // expand code with amount
    // echo "<div>$sUrl</div>";
    $sBankResponse = file_get_contents($sUrl);
    $jBankResponse = json_decode($sBankResponse);
    if( $jBankResponse->status == 1 && 
        $jBankResponse->code && 
        $jBankResponse->message ){
          sendResponse(1, __LINE__, $jBankResponse->message );
          // if sendResponse did not have exit, we should have exited
    }
  }
  
  sendResponse(2, __LINE__, 'Phone does not exist' );
}

sendResponse(1, __LINE__, 'Phone registered locally');


// getListOfBanksFromCentralBank();



// sendResponse(1, __LINE__, 'Phone is valid');
// Continue transfering the money 
// Take money from the logged user 
// Give it to the corresponding phone



// **************************************************

function sendResponse($iStatus, $iLineNumber, $sMessage){
  echo '{"status": '.$iStatus.', "code": '.$iLineNumber.', "message": "'.$sMessage.'"}';
  exit;
}


function fnjGetListOfBanksFromCentralBank(){
  // get the list of banks
  $sData = file_get_contents('https://ecuaguia.com/central-bank/api-get-list-of-banks.php?key=1111-2222-3333');
  return json_decode($sData);
}