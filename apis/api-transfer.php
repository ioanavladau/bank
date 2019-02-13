<?php

ini_set('display_errors', 0);

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

$sPhone = $_GET['phone'] ?? '';
if( strlen($sPhone) != 8 ) { sendResponse(-1, __LINE__, 'Phone must be 8 characters in length'); }
if( ctype_digit($sPhone) == false ) { sendResponse(-1, __LINE__, 'Phone can only be numbers'); }


$sData = file_get_contents('../data/clients.json');
// echo $sData;
$jData = json_decode($sData);
if( $jData == null ) { sendResponse(-1, __LINE__, 'Cannot convert data to JSON'); }

$jInnerData = $jData->data;

if( ! $jInnerData->$sPhone ){
  $jListOfBanks = fnjGetListOfBanksFromCentralBank();
  // loop through the list
  // connect to each bank


  $agent= 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36';

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_VERBOSE, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_USERAGENT, $agent);

  foreach( $jListOfBanks as $sKey => $jBank ){
    // echo $jBank->url;
    // echo $jBank->key;
    $sUrl = $jBank->url.'/apis/api-test.php';

    curl_setopt($ch, CURLOPT_URL, $sUrl);
    $result=curl_exec($ch);
    echo $result.'<div> </div>';

    // echo $sUrl2;
    // echo file_get_contents($sUrl2);

    // echo $sUrl;
    // if( strpos($sUrl, 'https') !== false ){
      // echo "<div>$sUrl</div>";
      // echo file_get_contents($sUrl);
    // }
  }


  exit();
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