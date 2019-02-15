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
      "amount": $("#txtTransferAmount").val(),
      "message": $("#txtTransferMessage").val()
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
      // console.log(sBalance);
      // console.log($('#lblBalance').text());
      if( sBalance != $('#lblBalance').text() ){

      swal({
        title: "YOU HAVE MORE MONEY!", 
        text: "You got money",
        icon: "success",
      });

        $('#lblBalance').text(sBalance);
        money.play();
      }
    }).fail(()=>{

    });


    // TRANSACTIONS 
    $.ajax({
      method: "GET",
      url: 'apis/api-get-transactions-not-read',
      // it adds a timestamp to the URL. We need cache: false to get new balance
      cache: false,
      dataType: "JSON"
    })
    .done(( jTransactions )=>{
      // console.log(jData);
      for( let jTransactionKey in jTransactions ){
        console.log(jTransactionKey);
        // the key can start with a number
        // if you have a key that is not really valid, use square brackets
        let jTransaction = jTransactions[jTransactionKey];
        let date = jTransaction.date;
        let amount = jTransaction.amount;
        let name = jTransaction.name;
        let lastName = jTransaction.lastName;
        let fromPhone = jTransaction.fromPhone;
        let message = jTransaction.message;

        let sTransactionTr = `
            <tr>
              <td>${jTransactionKey}</td>
              <td>${date}</td>
              <td>${amount}</td>
              <td>${name}</td>
              <td>${lastName}</td>
              <td>${fromPhone}</td>
              <td>${message}</td>
             </tr>
        `
        // prepend, not append, to push new transactions down
        $("#lblTransactions").prepend(sTransactionTr);
      }
    }).fail(()=>{

    });




  }, 3000);
};

fnvGetBalance();

// PHP doesn't have web sockets, but node.js does
// eating up the RAM
// 

/*

"transactionsNotRead": {
  "ID1": {
    "date": 018301213,
    "amount": 50, 
    "message": "Thanks",
    "name": "AA",
    "lastName": "AAAA"
  }
},
"transactions": {
  "ID1": {
    "date": 018301213,
    "amount": 50, 
    "message": "Thanks",
    "name": "AA",
    "lastName": "AAAA"
  }
}

*/