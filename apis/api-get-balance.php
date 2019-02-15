<?php

session_start();

$sUserId = $_SESSION['sUserId'];

$sData = file_get_contents('../data/clients.json');
$jData = json_decode($sData);
$jInnerData = $jData->data;

// we as professionals should echo json
echo $jInnerData->$sUserId->balance;