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

require_once 'top.php';

?>

  <h1>PROFILE</h1>
  <p>Name: <?= $jClient->name; ?></p>
  <p>Last name: <?= $jClient->lastName; ?></p>
  <p>Email: <?= $jClient->email; ?></p>
  <p>Phone: <?= $sUserId; ?></p>
  <p>Balance: <span id="lblBalance"><?= $jClient->balance; ?></span> </p>

  <h1>Transfer</h1>
  <form id="frmTransfer">
    <input name="txtTransferToPhone" id="txtTransferToPhone" type="text" placeholder="transfer to phone">
    <input name="txtTransferAmount" id="txtTransferAmount" type="text" placeholder="transfer amount">
    <input name="txtTransferMessage" id="txtTransferMessage" type="text" placeholder="transfer message">
    <button>transfer</button>
  </form>

  <h1>Transactions</h1>
  <table>
    <thead>
      <tr>
        <td>ID</td>
        <td>DATE</td>
        <td>AMOUNT</td>
        <td>NAME</td>
        <td>LAST NAME</td>
        <td>PHONE</td>
        <td>MESSAGE</td>
      </tr>
    </thead>
    <tbody id="lblTransactions">

      <?php
        foreach( $jClient->transactions as $sTransactionId=> $jTransaction ){
          echo "
            <tr>
              <td>$sTransactionId</td>
              <td>$jTransaction->date</td>
              <td>$jTransaction->amount</td>
              <td>$jTransaction->name</td>
              <td>$jTransaction->lastName</td>
              <td>$jTransaction->fromPhone</td>
              <td>$jTransaction->message</td>
            </tr>
          ";
        }


      ?>
    </tbody>
  </table>

<?php 
  $sLinkToScript = '<script src="js/profile.js"></script>';
  require_once 'bottom.php'; 
?>


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