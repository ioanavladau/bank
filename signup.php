<?php require_once 'top.php'; ?>

  <h1>SIGNUP</h1>
  <!-- WE WANT THE FORM TO SUBMIT ON ENTER -->
  <form id="frmSignup" action="apis/api-signup.php" method="POST">
    <input name="txtSignupName" id="txtSignupName" type="text" placeholder="name">
    <button>signup</button>
  </form>

<?php 
  $sLinkToScript = '<script src="js/signup.js"></script>';
  require_once 'bottom.php'; 
?>