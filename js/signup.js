$("#frmSignup").submit(function(){
  $.ajax({
    method: "POST",
    // signup.js is running in the browser so we points to apis folder
    url: "apis/api-signup",
    // data is the KEY that allows us to throw from F-E to B-E
    // $("#frmSignup").serialize() -> MUST SERIALIZE -> code that PHP will understand
    data: $("#frmSignup").serialize(),
    dataType: 'json'
  })
  .done((jData)=>{
    console.log(jData);
    if(jData.status == 1){
      console.log("CLIENT SAVED")
    } else{
      console.log("SOMETHING IS WRONG")
    }
  })
  .fail(()=>{
    console.log("error");
  });
  
  return false;
});