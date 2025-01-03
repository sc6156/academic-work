<?php
require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
startSession();
echo createHead("The Hillside Hideaway");

echo '<body>';
  echo '<div id="page_container">';

  createHeader(); 

  echo '<div class="clear"></div>';
  
  echo '<main>';
    createStickyBar(); 
	createAccomContent();
  echo '</main>';
  
  createFooter(); 
 
  echo '</div>';
echo '</body>';
echo '</html>';
?>