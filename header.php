<?php  

  echo "
      <div id='header'>
        <div id='logo'>
          <div id='logo_text'>
            <!-- class='logo_colour', allows you to change the colour of the text -->
            <h1><a href='dashboard.php'>Password <span class='logo_colour'>Manager</span></a></h1>
            <h2>Simple. Classic. Password Tool.</h2>
          </div>
          <div id='menubar' style='margin-left: 75%; padding-top: 20px; font-size: 16px; color: white;'>
              <ul id='menu'>
                <!-- put class='selected' in the li tag for the selected page - to highlight which page you're on -->
                <li><a href='dashboard.php'>Passwords</a></li>
                <li><a href='cards.php'>Cards</a></li>
                <li><a href='settings.php'>Settings</a></li>
                <li><a href='logout.php'>Logout</a></li>
              </ul>  
          </div>
          <h3 style='margin-top: 40px; margin-left: 1200px; color: ;'>".$_SESSION['email']."</h3>
        </div>
      </div>
  ";

?>
    
    <!-- <li><button onclick='location.href = 'dashboard.php';' >Home</button></li>
                <li><button onclick='location.href = 'settings.php';' >Settings</button></li>
                <li><button onclick='location.href = 'logout.php';' >Logout</button></li> -->


