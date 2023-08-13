<?php  
  global $nopass;
  $user_err = $nopass = "";
  require_once("Controllers/cards_controller.php");

?>

<!DOCTYPE HTML>
<html>
<head>
  <title>Password Manager - Cards</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="/css/inner_css.css" />
  <script type="text/javascript" src="/Javascript/dashboard.js"></script>
</head>

<body>
  <div id="main">

    <?php 

    	include("header.php");

    ?>

    <div id="content_header"></div>
    <div id="site_content">

        <!-- insert the page content here -->
<div id="first">
        <label style="font-size: 35px;">Your cards</label>
        
        <table class="styled-table2">
          <tr><th>Card</th><th>Holder</th><th>Number</th><th>Expiry</th><th>Cvv</th><th>Brand</th><th></th><th></th></tr>
          <?php

            retrievecard($_SESSION['id']);

          ?>
        </table>
        <div style="text-align: center;">
          <label><?php if($nopass != ""){ echo "{$nopass}"; } ?></label>
        </div>
        <div style="margin-top: 15px;">
          <button style="margin-left: 600px; width: 150px;" onclick="location.href = 'clearallcard.php';" name="clearallcard" id='clearallcard' >Clear All</button>
        </div>
</div>
<div id="second" >
        <h2 style="margin-top: 20px;">Add New Card</h2>
        <form style="margin-top: 30px;" method="post">
        <div class="form_settings">
          <p><span style="font-size: 16px;">Card Name: </span><input type="text" name="name" placeholder="Enter Card Name" required /></p>
          <p><span style="font-size: 16px;">Card Holder: </span><input type="text" name="holder" placeholder="Enter Holder Name" required /></p>
          <p><span style="font-size: 16px;">Card Number: </span><input type="password" name="number" placeholder="Enter Card Number" required /></p>
          <p><span style="font-size: 16px;">Card Expiry: </span><input type="text" name="expiry" placeholder="Enter Expiry Date" required /></p>
          <p><span style="font-size: 16px;">Card cvv: </span><input type="password" name="cvv" placeholder="Enter Cvv Number" required /></p>
          <p><span style="font-size: 16px;">Card Brand: </span><input type="text" name="brand" placeholder="Enter Brand Name" required /></p>
          <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="add" value="Add" /></p>
          </form>
          
        </div>
        <!-- </form> -->

        <form style="margin-top: 30px;" method="post">
        <div class="form_settings">
        
        <label style="color: red; font-size: 14px;"><?php if($user_err != ""){ echo "{$user_err}"; } ?></label> 
        </div>

      </div>
    </div>
</div>
   
</body>
</html>
