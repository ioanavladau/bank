<?php

session_start();

if( ! $_SESSION['sUserId'] ) { // or !isset($_SESSION['sUserId']) 
  header('Location: login.php');
}
 
$sUserId = $_SESSION['sUserId'];

$sData = file_get_contents('data/clients.json');
$jData = json_decode($sData);
if( $jData == null ) { echo 'System update'; }
$jInnerData =$jData->data;
$jClient = $jInnerData->$sUserId;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>PROFILE</h1>
  <p>Phone: 
    <?= 
      $sUserId;
    ?>
  </p>
  <p>Name:     
    <?= 
      $jClient->name;
    ?>
    </p>
  <p>Last name:    
    <?= 
      $jClient->lastName;
    ?>
  </p>
  <p>Email:    
    <?= 
      $jClient->email;
    ?>
  </p>
</body>
</html>


<!-- {
  "data": {
    "20345678": {
      "name": "aa",
      "lastName": "AA",
      "email": "a@a.com",
      "password": "$2y$10$TiwoSjdiBpLKSRNqBoVXb.a59BJDkuWAOXmg2RZALYZSycxvLwSvq",
      "cpr": "1234567890",
      "accounts": { "5c62ba3825e92": { "balance": 0 } },
      "transactions": {}
    }
  }
} -->