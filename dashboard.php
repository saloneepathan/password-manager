<?php  
  global $nopass;
  $user_err = $nopass = "";
  include("Controllers/dashboard_controller.php");

?>

<!DOCTYPE HTML>
<html>
<head>
  <title>Password Manager - Passwords</title>
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
        <label style="font-size: 35px;">Your passwords</label>
        
        <table class="styled-table">
          <tr><th>Website</th><th>Login ID</th><th>Password</th><th></th><th></th></tr>
          <?php

            retrievepass($_SESSION['id']);

          ?>
        </table>
        <div style="text-align: center;">
          <label><?php if($nopass != ""){ echo "{$nopass}"; } ?></label>
        </div>
        <div style="margin-top: 15px;">
          <button style="margin-left: 500px; width: 150px;" onclick="location.href = 'clearall.php';" name="clearall" id='clearall' >Clear All</button>
        </div>
</div>
<div id="second" >
        <h2 style="margin-top: 20px;">Add New Password</h2>
        <form style="margin-top: 30px;" method="post">
        <div class="form_settings">
          <p><span style="font-size: 16px;">Website: </span><input type="text" name="website" placeholder="Enter Website Name" required /></p>
          <p><span style="font-size: 16px;">Login ID: </span><input type="text" name="username" placeholder="Enter Login ID" required /></p>
          <p><span style="font-size: 16px;">Password: </span><input type="password" name="password" placeholder="Enter Password" required /></p>
          <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="add" value="Add" /></p>
          </form>
          <form style="margin-top: 30px;" method="get">
          <p><span style="font-size: 16px;">Password Length: </span><input type="number" id="length" name="length" min="15" max="50" required /></p>
          <p><span style="font-size: 16px;"> !@#$%^&* </span> <input type="checkbox" name="symbol" value="symbol"> </p>
          <p><span style="font-size: 16px;"> 0-9 </span><input type="checkbox" name="number" value="number"> </p>
          <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="generate" value="generate" /> </p>
          <p><span style="font-size: 16px;">Generated Password: </span><input type="text" name="generatedPass" placeholder="" value = "<?php if($generatedPassword != ""){ echo "{$generatedPassword}"; } ?>" /> </p>
          </form>
          <p style="padding-top: 15px"><span>&nbsp;</span><input style="width: 350px;" class="submit" type="submit" name="external" value="Check if your credentials are leaked in any data breaches!" onclick="window.location.href = 'https://haveibeenpwned.com/'" /></p>
          
        </div>
        <!-- </form> -->

        <form style="margin-top: 30px;" method="post">
        <div class="form_settings">
        
        <label style="color: red; font-size: 14px;"><?php if($user_err != ""){ echo "{$user_err}"; } ?></label> 
        </div>

        <h1 style="font-size: 35px; margin-top: 20px; color: purple;">About</h1>
        <p style="font-size: 16px;">
          This tool simplifies the overhead of remembering the passwords for different accounts 
          in various websites. To add a new password, fill up the details in the form displayed 
          above and click add. To remove any password, click on the corresponding remove button 
          in the table. To change your password or to delete your account, go to the settings tab.
          Make sure to logout your account before you leave.<br> 
        </p>

      </div>
    </div>
</div>
    
</body>
</html>
