<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <style>
        input {width:10%;}
    </style>
</head>

<body>
    <div class="alert alert-danger">
        <p>You have not paid the fees. Pay now to activate your account.</p>
    </div>

    <div align="center">
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

          <!-- Identify your business so that you can collect the payments. -->
          <input type="hidden" name="business" value="dawat@gmail.com">

          <!-- Specify a Buy Now button. -->
          <input type="hidden" name="cmd" value="_xclick">

          <!-- Specify details about the item that buyers will purchase. -->
          <input type="hidden" name="item_name" value="username:{{$user_name}}">
          <input type="hidden" name="item_number" value="{{$user_id}}">
          <? php $fees = $fees / 100; ?>
          <input type="hidden" name="amount" value="{{$fees}}">
          <input type="hidden" name="currency_code" value="USD">

          <input type="hidden" name="cancel_return" value="http://127.0.0.1:8000/payment"> 
          <input type="hidden" name="return" value="http://127.0.0.1:8000/paid">

          <!-- Display the payment button. -->
          <input type="image" width="20" name="submit" border="0"
          src="http://jsmom.org/wp-content/uploads/2012/07/paypal-paynow-button-300x89.png"
          alt="Pay Now">
          <img alt="" border="0" width="1" height="1"
          src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

        </form>
    </div>
</body>