<?php require_once 'top.php'; ?>

  <h1>SIGNUP</h1>
  <!-- WE WANT THE FORM TO SUBMIT ON ENTER -->
  <form id="frmSignup" action="apis/api-signup.php" method="POST">
    <input name="txtSignupName" id="txtSignupName" type="text" placeholder="name" value="a">
    <input name="txtSignupLastName" id="txtSignupLastName" type="text" placeholder="last name" value="aa">
    <input name="txtSignupPhone" id="txtSignupPhone" type="text" placeholder="phone" value="20">
    <input name="txtSignupEmail" id="txtSignupEmail" type="text" placeholder="email" value="a@a.com">
    <input name="txtSignupCpr" id="txtSignupCpr" type="text" placeholder="cpr" value="1234567890">
    <input name="txtSignupPassword" id="txtSignupPassword" type="password" placeholder="password">
    <input name="txtSignupConfirmedPassword" id="txtSignupConfirmedPassword" type="password" placeholder="retype password">
    <button>signup</button>
  </form>

<?php 
  $sLinkToScript = '<script src="js/signup.js"></script>';
  require_once 'bottom.php'; 
?>