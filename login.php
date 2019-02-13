<?php require_once 'top.php'; ?>

  <h1>LOGIN</h1>
  <form id="frmLogin" action="" method="POST">
    <input name="txtLoginPhone" type="text" placeholder="phone">
    <input name="txtLoginPassword" type="password" placeholder="password">
    <button>login</button>
  </form>



<?php 
  $sLinkToScript = '<script src="js/login.js"></script>';
  require_once 'bottom.php'; 
?>