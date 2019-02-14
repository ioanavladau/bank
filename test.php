<?php

ini_set('display_errors', 0);

// $jClient->name = 'A';
// $jTransaction->amount = 10;
// $jClient->transactions = $jTransaction;
// echo json_encode($jClient);

$jClient->name = "a";
echo $jClient->name;
if( ! $jClient->price ) { echo 'NO PRICE'; }

// $aLetters = [];
// array_push($aLetters, "a", "b", "c");
// associative array - based on key values
// $aLettersTest['one'] = "a";
// $aLettersTest['two'] = "b";
// if you encode an associative array, PHP returns JSON
// echo json_encode($aLettersTest);



// tunnel KEA website 
// $sData = file_get_contents('https://kea.dk');
// $sData = str_replace('Åbent hus', 'Mac pro for kea students now only 2000 kr', $sData);
// echo $sData;

