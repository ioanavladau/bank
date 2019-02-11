<?php

  // HTML page and server sends you data back
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>AJAX</title>
</head>
<body>
  <div>
    The stock name is: <span id="lblStockName"></span>
  </div>

  <div>
    The stock price is: <span id="lblStockPrice"></span>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jquery uses xmlhttprequest behind the scenes -->
  <script>
    // xmlhttprequest
    // fetch
    // $.ajax().done().fail()

    //     $.ajax({
    //        method: ''
    //      })

    // by default $.ajax uses method: 'GET'
    // $('#lblData').text(sStockPrice); TEXT instead of HTML to get rid of the script tag
    // TEXT protects you for script injections

    // runs one time every x amount of seconds
    // runs every x amount of seconds

    // setInterval(function(){

    // }, interval);

    setInterval(() => {
      $.ajax({
        method: 'GET',
        url: 'apis/api-get-stock-price.php',
        dataType: 'JSON'
      })
      .done(function( jData ){
        // convert sData to jData
        // let jData = JSON.parse(sData); -> REPLACED WITH dataType: 'JSON'
        console.log(jData);
        if( jData.status == 1 ){
          $('#lblStockName').text(jData.name);
          $('#lblStockPrice').text(jData.price);
        }else{
          console.log("SOMETHING IS WRONG");
        }
        // $('#lblData').text(sStockPrice);
      })
      .fail(function(){
        console.log('ERROR');
      })
    }, 2000);





  </script>


</body>
</html>