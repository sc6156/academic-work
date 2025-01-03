<?php
/* This page enables users to download a copy of the security report which 
critically evalucates the website's security. Only signed in users can access this page.*/

require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
startSession();
checkAllowed();  // Check if the user is signed in
echo createHead("Security Report");


echo '<body>';
  echo '<div id="page_container">';
  
  createHeader(); 

  echo '<div class="clear"></div>';
  echo '<main>';
    createStickyBar();
  
    echo '<h1 class="headings">Security Report</h1>';
  
    echo '<p>Please download the <a href="/PE7045/assets/downloadable_files/Security_Report.pdf" class="links"> security report PDF file</a> 
	to read a critical appraisal of the coorie website\'s security measures.</p>';
  
  echo '</main>';

  echo '<div class="clear"></div>';
  
  createFooter(); 

  echo '</div>';
echo '</body>';
echo '</html>';
?>