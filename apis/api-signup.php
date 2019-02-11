<?php
  // if you didn't pass me anything, don't pass me nothing
  
  // validate
  // isset - checks if the variable exists, but
  // it doesn't check if the variable is empty
  // empty() checks for both isset() and emptyness

  // if( ! isset($_POST['txtSignupName']) ){
  //   echo 'error';
  // }

  // no header redirects in the API!!!

  // if you echo more than one time you need to exit()!!!!
  if( empty($_POST['txtSignupName'] && $_POST['txtSignupLastName'] )){
    echo '{"status": 0, "code": '.__LINE__.', "message": "error"}';
    exit;
    // header('Location: ../signup');
  }

  if( $_POST['txtSignupPassword'] != $_POST['txtSignupConfirmedPassword'] ){
    echo '{"status": 0, "code": '.__LINE__.', "message": "error"}';
    exit;
  }


  // TODO: Create a validation PHP file
  $jClient = new stdCLass(); // same as json_decode('{}');
  $jClient->id = uniqid();
  $jClient->name = $_POST['txtSignupName'];
  $jClient->lastName = $_POST['txtSignupLastName'];
  $jClient->email = strtolower($_POST['txtSignupEmail']);
  $jClient->cpr = $_POST['txtSignupCPR'];
  $jClient->password = password_hash($_POST['txtSignupPassword'], PASSWORD_DEFAULT);
  
  
  // unset($jClient->password);
  $jClient->transactions = [];
  $jClient->signupDate = time();
  $jClient->active = 0;
  $jClient->activationKey = uniqid().'-'.uniqid();
  // $jClient['signupDate'] -> associative array 

  $sData = file_get_contents('../data/clients.txt');
  $aData = json_decode($sData);
  // save the user inside the array
  array_push($aData, $jClient);
  $sData = json_encode($aData);
  file_put_contents('../data/clients.txt', $sData);

  // TODO: save client to file
  // __LINE__ for debugging
  echo '{"status": 1, "code": '.__LINE__.', "message": "client saved"}';
