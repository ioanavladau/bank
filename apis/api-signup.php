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
  if( empty($_POST['txtSignupName']) ){
    echo '{"status": 0, "code": '.__LINE__.', "message": "error"}';
    exit;
    // header('Location: ../signup');
  }


  // TODO: Create a validation PHP file
  $jClient = new stdCLass(); // same as json_decode('{}');
  $jClient->id = uniqid();
  $jClient->name = $_POST['txtSignupName'];

  // TODO: save client to file
  // __LINE__ for debugging
  echo '{"status": 1, "code": '.__LINE__.', "message": "client saved"}';
