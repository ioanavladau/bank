// self invoking function
// (function fnvGetBalance() {
//   setInterval(()=>{
//     console.log('x');
//   }, 1000);
// }())


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




// **************************************************

// Talk to the server and get the balance of the logged user
// self invoking function


// fnvGetBalance();
function fnvGetBalance() {
  var money = new Audio('money.mp3');
  
  setInterval(()=>{
    
    $.ajax({
      method: "GET",
      url: 'apis/api-get-balance',
      // it adds a timestamp to the URL. We need cache: false to get new balance
      cache: false
    })
    .done(( sBalance )=>{
      console.log(sBalance);
      console.log($('#lblBalance').text());
      if( sBalance != $('#lblBalance').text() ){
        $('#lblBalance').text(sBalance);
        money.play();
      }
    }).fail(()=>{

    });

  }, 2000);
};

fnvGetBalance();

// PHP doesn't have web sockets, but node.js does
// eating up the RAM
// 
