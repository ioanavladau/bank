<?php

  ini_set('display-errors', 0);

  $sPhone = $_POST['txtLoginPhone'] ?? '';
  if( empty($sPhone) ) { sendResponse(0, __LINE__); }
  if( ctype_digit($sPhone) == FALSE ) { sendResponse(0, __LINE__); }
  if( strlen($sPhone) != 8 ) { sendResponse(0, __LINE__); }

  $sPassword = $_POST['txtLoginPassword'] ?? '';
  if( empty($sPassword) ) { sendResponse(0, __LINE__); }
  if( strlen($sPassword) < 4 ) { sendResponse(0, __LINE__); }
  if( strlen($sPassword) > 50 ) { sendResponse(0, __LINE__); }

  $sData = file_get_contents('../data/clients.json');
  $jData = json_decode($sData);
  if( $jData == null ){ sendResponse(0, __LINE__); }
  $jInnerData = $jData->data;

  // if( !isset($jInnerData->$sPhone)){ sendResponse(0, __LINE__); }
  if( !password_verify( $sPassword, $jInnerData->$sPhone->password ) ){ sendResponse(0, __LINE__); }

  // SUCCESS
  session_start();
  $_SESSION['sUserId'] = $sPhone;
  $_SESSION['sUsername'] = $jInnerData->$sPhone->name;
  $_SESSION['sLastName'] = $jInnerData->$sPhone->lastName;
  $_SESSION['sEmail'] = $jInnerData->$sPhone->email;
  sendResponse(1, __LINE__);



  // **************************************************

  function sendResponse($bStatus, $iLineNumber){
    echo '{"status": '.$bStatus.', "code": '.$iLineNumber.'}';
    exit;
  }