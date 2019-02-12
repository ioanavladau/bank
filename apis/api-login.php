<?php

  ini_set('display_errors', 0);

  // defensive coding! 

  $sUsername = $_POST['txtLoginUsername'];
  if( strlen($sUsername) < 2 || strlen($sUsername) > 20 ){
    sendResponse(0, __LINE__);
  }

  // different if statements for checking different conditions

  $sPassword = $_POST['txtLoginPassword'];
  if( strlen($sPassword) < 4 || strlen($sPassword) > 50 ){
    sendResponse(0, __LINE__);
  }

  sendResponse(1, __LINE__);

  // **************************************************

  function sendResponse($bStatus, $iLineNumber){
    echo '{"status": '.$bStatus.', "code": '.$iLineNumber.'}';
    exit;
  }