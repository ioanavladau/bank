$("#frmTransfer").submit(()=>{

  $.ajax({
    method: "GET",
    url: 'apis/api-transfer',
    // url: 'apis/api-transfer'+$("#txtTransferToPhone").val(),
    // if you already pointed to the API, it will be cached
    data: { 
      "phone": $("#txtTransferToPhone").val(),
      "amount": $("#txtTransferAmount").val()
    }, // same thing with api-is-phone-registered-locally.php?phone=1234555'
    cache: false,
    dataType: "JSON"
  }).done((jData)=>{
    // if smb disabled JS
    // if we get -1 it means that we bypassed the F-E validation
    if( jData.status == -1 ){
      console.log('**********');
      console.log(jData);
    }


    // the phone number is not reg. locally
    if( jData.status == 0 ){
      console.log('**********');
      console.log("Go get the list of banks");
    } // end of 0 case


    // the phone number is reg. locally
    if( jData.status == 1 ){
      console.log('**********');
      console.log(jData);
      // TODO: Continue with a local transfer
    }
  }).fail(()=>{
    console.log("FATAL ERROR")
  });
  
  return false;
})
