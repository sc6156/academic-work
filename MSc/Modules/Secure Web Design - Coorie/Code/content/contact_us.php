<?php
/* This page merely provides an email address if a user needs to contact
the business. A webform would have been used but there is no access to a SMTP
server. */

require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
startSession();
echo createHead("Contact Us");

echo '<body>';
  echo '<div id="page_container">';
  
  createHeader(); 

  echo '<div class="clear"></div>';
  echo '<main>';
    createStickyBar();  
  
    echo'<h1 class="headings">Contact Us</h1>';
  
    echo '<p>You may need to contact us if you have a query about a booking, a question about our accommodation, or you simply need to reset your password. 
    To get in touch, please send an email to:<br><br><a id ="contactLink" href = "mailto:scott.cumming@northumbria.ac.uk">scott.cumming@northumbria.ac.uk</a></p>';
	
  echo '</main>';
  
  createFooter(); 

  echo '</div>';
echo '</body>';
echo '</html>';
?>