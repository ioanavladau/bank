<?php

ini_set('display_errors', 0);

// AJAX!
// constrain it for logged users
session_start();
if( !isset($_SESSION['sUserId']) ) { // or !isset($_SESSION['sUserId']) 
  sendResponse(-1, __LINE__, 'You must login to use this api');
}

// $sPhoneToCheck = $_GET['phone'] || '';
if(empty($_GET['phone'])){
  sendResponse(-1, __LINE__, 'Phone missing');
}

$sPhone = $_GET['phone'] ?? '';
if( strlen($sPhone) != 8 ) { sendResponse(-1, __LINE__, 'Phone must be 8 characters in length'); }
if( ctype_digit($sPhone) == false ) { sendResponse(-1, __LINE__, 'Phone can only be numbers'); }

// if( strlen($sPhone) != 8 ) { sendResponse(0, __LINE__, 'Phone can only be numbers'); }




$sData = file_get_contents('../data/clients.json');
// echo $sData;
$jData = json_decode($sData);
if( $jData == null ) { sendResponse(-1, __LINE__, 'Cannot convert data to JSON'); }

$jInnerData = $jData->data;

if( ! $jInnerData->$sPhone ){
  sendResponse(0, __LINE__, 'Phone not registered locally');
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


// function getListOfBanksFromCentralBank(){
//   // get the list of banks
//   $sData = file_get_contents('https://ecuaguia.com/central-bank/api-get-list-of-banks.php?key=1111-2222-3333');
//   echo $sData;
// }