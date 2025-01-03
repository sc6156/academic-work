<?php
/* This page enables already registered users to log into the site. It 
also gets the url of the previous page visited from a session variable so 
the user can be returned to this page after they have signed in. */

require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
startSession();
echo createHead("Please sign in");
$_SESSION['link'] = isset($_REQUEST['page_url']) ? $_REQUEST['page_url'] : null; // Get page_url variable from the header

echo '<body>';
  echo '<div id="page_container">';
  
  createHeader(); 

  echo '<div class="clear"></div>';
  echo '<main>';
    echo '<div id="loginBox">';
      echo '<h1 class="headings" id="loginhead">Please sign in below</h1>';
  
      echo '<form id="login" method="POST" action="authenticate.php">';
	    echo '<div>';
          echo '<label for="email">Email Address</label>&ensp;';
            echo '<input class="signinbox" id="email" type="email" name="email">';
	    echo '</div>';	
	    echo '<div>';
          echo '<label for="password">Password</label>&ensp;';
            echo '<input class="signinbox" id="password" type="password" name="password">';
	    echo '</div>';	

	    echo '<input type="submit" id="loginbutton" name="loginbutton" value="Sign In">';	
      echo '</form>'; 
	
	  echo '<p id="resetpass">Forgotten your password?<br><a class="resetlink" href="contact_us.php">Contact us</a><br><br>
	  Don\'t have an account?<br><a class="resetlink" href="register.php">Click here</a></p>';
    echo '</div>';
  echo '</main>';

  echo '<div class="clear"></div>';
  
  createFooter(); 

  echo '</div>';
echo '</body>';
echo '</html>';
?>