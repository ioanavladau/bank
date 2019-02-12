<?php

    $sData = file_get_contents('clients.json');
    $jData = json_decode($sData);
    // check if the conversion is correct
    if( $jData == null ){
      echo 'Error, check the database';
    }
    
    $jData = $jData->data;

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

