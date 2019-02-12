<?php

  $sData = file_get_contents('../data/clients.json');
  $jData = json_decode($sData);
  if( $jData == null ){ sendResponse(0, __LINE__); }
  $jInnerData = $jData->data;

  // validate phone
  $sPhone = $_POST['txtSignupPhone'] ?? '';
  if( empty($sPhone) ) { sendResponse(0, __LINE__); }
  if( strlen($sPhone) != 8 ) { sendResponse(0, __LINE__); }
  if( intval($sPhone) < 10000000 ) { sendResponse(0, __LINE__); }
  // if it's below 1 mil. and max 8 chars then it's < 9 mil
  if( intval($sPhone) > 99999999 ) { sendResponse(0, __LINE__); }

  // validate name
  $sName = $_POST['txtSignupName'] ?? '';
  if( empty($sName) ) { sendResponse(0, __LINE__); }
  if( strlen($sName) < 2 ) { sendResponse(0, __LINE__); }
  if( strlen($sName) > 20 ) { sendResponse(0, __LINE__); }

  // validate last name
  $sLastName = $_POST['txtSignupLastName'] ?? '';
  if( empty($sLastName) ) { sendResponse(0, __LINE__); }
  if( strlen($sLastName) < 2 ) { sendResponse(0, __LINE__); }
  if( strlen($sLastName) > 20 ) { sendResponse(0, __LINE__); }

  // validate email
  $sEmail = $_POST['txtSignupEmail'] ?? '';
  if ( ! filter_var($sEmail, FILTER_VALIDATE_EMAIL)) { sendResponse(0, __LINE__); }

  // if( empty($sEmail) ) { sendResponse(0, __LINE__); }
  // if( strlen($sEmail) < 5 ) { sendResponse(0, __LINE__); }
  // if( strlen($sEmail) > 30 ) { sendResponse(0, __LINE__); }

  // validate password
  $sPassword = $_POST['txtSignupPassword'] ?? '';
  if( empty($sPassword) ) { sendResponse(0, __LINE__); }
  if( strlen($sPassword) < 6 ) { sendResponse(0, __LINE__); }
  if( strlen($sPassword) > 50 ) { sendResponse(0, __LINE__); }
  
  // check if passwords match
  $sConfirmedPassword = $_POST['txtSignupConfirmedPassword'] ?? '';
  if( empty($sPassword) ) { sendResponse(0, __LINE__); }
  if( $sPassword != $sConfirmedPassword ) { sendResponse(0, __LINE__); }

  // validate CPR
  $sCpr = $_POST['txtSignupCpr'] ?? '';
  if( empty($sCpr) ) { sendResponse(0, __LINE__); }
  if( ctype_digit($sCpr) == FALSE ) { sendResponse(0, __LINE__); }
  if( strlen($sCpr) != 10 ) { sendResponse(0, __LINE__); }

  // // "111": { "name": "A" }
  // $jClient = new stdClass(); // json object
  // $jClient->$sPhone = new stdClass(); // '{}'
  // $jClient->$sPhone->name = $sName; // I invent a key called "name" and I assign it the value passed via POST

  $jClient = new stdClass();
  $jClient->name = $sName;
  $jClient->lastName = $sLastName;
  $jClient->email = $sEmail;
  $jClient->password = password_hash($sPassword, PASSWORD_DEFAULT);
  $jClient->cpr = $sCpr;
  $jClient->accounts = new stdClass();
  $jClient->transactions = new stdClass();

  // add all client data to the key which is phone number
  $jInnerData->$sPhone = $jClient;
  


  $sData = json_encode($jData);
  if( $sData == null ) { sendResponse(0, __LINE__); }

  $uTest = file_put_contents('../data/clients.json', $sData); // unknown
  // sendResponse( $uTest, __LINE__ );

  // $jInnerData->12321->transactions->ID111->message = "XXXX";

  // SUCCESS
  sendResponse(1, __LINE__);


  // **************************************************

  function sendResponse( $bStatus, $iLineNumber ){
    echo '{"status": '.$bStatus.', "code": '.$iLineNumber.'}';
    exit();
  }

  sendResponse(1, __LINE__);


  // ORIGINAL CLIENTS.JSON FILE
  // {
  //   "data": {

  //   }
  // }