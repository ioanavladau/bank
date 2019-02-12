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

  echo checkCpr('011396-1345');

  // gender: fem 0, male 1
  function checkCpr($cpr)
  {
      // remove spaces and uppercase it
      $preg = "/^[0-3][0-9][0-1]\d{3}-\d{4}?/";
      if (preg_match($preg, $cpr)) {
          $cpr           = str_replace('-', '', $cpr);
          $y = substr($cpr, -1);
          switch ($gender) {
          case 'M':
              $genderOK = (($y % 2) == 1);
              break;
          case 'F':
              $genderOK = (($y % 2) == 0);
              break;
          default:
              $genderOK = true;
              break;
          }
          return $genderOK;
      } else {
          return false;
      }
  }
  echo 'x';










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