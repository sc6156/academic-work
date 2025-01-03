<?php
/* This page allows a user to enter their details into a form and 
register them in a database. The details are sent to registerProcess.php 
when submitted. */

require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
startSession();
echo createHead("Register with coorie");

echo '<body>';
  echo '<div id="page_container">';
  
  createHeader(); 

  echo '<div class="clear"></div>';
  echo '<main>';
    echo '<div id="registerBox">';
      echo '<h1 class="headings" id="reghead">Register for an Account</h1>';
  
      echo '<form id="reg" method="POST" action="registerProcess.php">';
        echo '<div>';
	      echo '<label for="fname">First Name</label>&ensp;';
            echo '<input class="reginputs" id="fname" type="text" name="fname">';
	    echo '</div>';	  
	    echo '<div>';
          echo '<label for="surname">Surname</label>&ensp;';
            echo '<input class="reginputs" id="surname" type="text" name="surname">';
	    echo '</div>';		  
	    echo '<div>';
          echo '<label for="dob">Date of Birth</label>&ensp;';
            echo '<input class="reginputs" id="dob" type="date" name="dob">';
	    echo '</div>';				  
	    echo '<div>';
          echo '<label for="postcode">Postcode</label>&ensp;';
            echo '<input class="reginputs" id="postcode" type="text" name="postcode">';
	    echo '</div>';			  
	    echo '<div>';
          echo '<label for="address1">First Line of Address</label>&ensp;';
            echo '<input class="reginputs" id="address1" type="text" name="address1">';
	    echo '</div>';	
	    echo '<div>';
          echo '<label for="address2">Second Line of Address</label>&ensp;';
            echo '<input class="reginputs" id="address2" type="text" name="address2">';
	    echo '</div>';	
	    echo '<div>';
          echo '<label for="email">Email Address</label>&ensp;';
            echo '<input class="reginputs" id="email" type="email" name="email">';
	    echo '</div>';	
	    echo '<div>';
          echo '<label for="password">Password</label>&ensp;';
            echo '<input class="reginputs" id="password" type="password" name="password">';
	    echo '</div>';	
	    echo '<div>';
          echo '<label for="passwordCheck">Reenter Password</label>&ensp;';
            echo '<input class="reginputs" id="passwordCheck" type="password" name="passwordCheck">';
	    echo '</div>';	
	  
	    echo '<input type="submit" id="regbutton" name="regbutton" value="Register">';	
      echo '</form>'; 
	
	  echo '<p id="exAcc">Already have an account?<br><a id="signinlink" href="sign_in.php">Sign in here</a></p>';
    echo '</div>';
  echo '</main>';

  echo '<div class="clear"></div>';
  
  createFooter(); 

  echo '</div>';
echo '</body>';
echo '</html>';
?>