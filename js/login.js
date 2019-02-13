$("#frmLogin").submit(function(){
  $.ajax({
    method: "POST",
    url: "apis/api-login.php",
    // data is the KEY that allows us to throw from F-E to B-E
    // MUST SERIALIZE -> code that PHP will understand
    data: $("#frmLogin").serialize(),
    dataType: 'json'
  })
  .done((jData)=>{
    console.log(jData);
    if(jData.status == 0){
      console.log(jData);
      swal({
        title: "LOGIN FAIL", 
        text: "Check phone number and password and try again. Code: " + jData.code,
        icon: "warning",
      });
      return;
    }
  
    swal({
      title: "CONGRATS!", 
      text: "You have logged in",
      icon: "success",
    });
  })
  .fail(()=>{
    console.log("error");
  });
  
  return false;
});