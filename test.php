<?php

    $sData = file_get_contents('clients.json');
    $jData = json_decode($sData);
    // check if the conversion is correct
    if( $jData == null ){
      echo 'Error, check the database';
    }
    
    $jData = $jData->data;
    foreach( $jData as $sKey=>$jClient ){
    // echo $sKey.json_encode($jClient);
    }

  // gender: fem 0, male 1

  function sendResponse($bStatus, $iLineNumber){
    echo '{"status": '.$bStatus.', "code": '.$iLineNumber.'}';
    exit;
  }



  // ******************************************************************

  
  $sCpr = $_POST['txtLoginCpr'] ?? '';
  if( empty($sCpr) ) { sendResponse(0, __LINE__); }
  if( ! validateCpr($sCpr) ) { sendResponse(0, __LINE__); }

  function validateCpr($sCpr){

    if( ! ctype_digit($sCpr) ) { sendResponse(0, __LINE__); return false; }
    if( strlen($sCpr) != 10 ) { sendResponse(0, __LINE__); return false; }

    $sCprMonth = substr($sCpr, 2, -6); 
    $sCprDay = substr($sCpr, 0, -8);
    $sCprYear = substr($sCpr, 4, -4);

    switch($sCprMonth){
      case 1:
      case 3:
      case 5:
      case 7:
      case 8:
      case 10:
      case 12:
        // echo '31 days in the month';
        if( $sCprDay > 31 ) { sendResponse(0, __LINE__); return false; }
        break;
      case 2:
        if( $sCprYear%4 == 0 ){ // if it's leap year feb 29 days
          if( $sCprDay > 29 ) { 
            sendResponse(0, __LINE__); return false; 
            }
          } else {
          if( $sCprDay > 28 ) { 
            // echo 'ERROR: max 28 days'; 
            sendResponse(0, __LINE__); return false; 
            }
          }
        break;
      case 4:
      case 6:
      case 9:
      case 11:
        // echo '30 days in the month';
        if( $sCprDay > 30 ) { sendResponse(0, __LINE__); return false; }
        break;
      default:
        echo 'month does not exist';
    }
    sendResponse(1, __LINE__);
    return true;
  }










    // TO AVOID REMOVING THE CODE, THE CODE AFTER EXIT() WILL NEVER RUN
    exit();

    $sLoggedUserId = 'ID1';
    
    $sLoggedName = $jData->$sLoggedUserId->name;
    $sLoggedPhone = $jData->$sLoggedUserId->phone;
    $iTransferAmount = 1;
    $jData->$sLoggedUserId->balance -= $iTransferAmount;
    $sLoggedBalance = $jData->$sLoggedUserId->balance;

    echo "<div>Name is $sLoggedName</div>";
    echo "<div>Phone is $sLoggedPhone</div>";
    echo "<div>Balace is $sLoggedBalance</div>";
    // echo "<div>Balace is {$jData->$sLoggedUserId->balance} </div>";

    $jData->ID3->balance += $iTransferAmount;
    echo "<div>Name is {$jData->ID3->name} </div>";
    echo "<div>Phone is {$jData->ID3->phone}</div>";
    echo "<div>Balace is {$jData->ID3->balance}</div>";