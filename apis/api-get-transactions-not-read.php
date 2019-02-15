<?php

// CHeck if the user is logged
// This API is only for the user that is logged

session_start();
$sUserId = $_SESSION['sUserId'];

$sData = file_get_contents('../data/clients.json');
$jData = json_decode($sData);
// TODO: Check if json is valid
$jInnerData = $jData->data;

$jTransactionsNotRead = $jInnerData->$sUserId->transactionsNotRead;

echo json_encode($jTransactionsNotRead);
// TODO: Delete what is inside the transactionsNotRead