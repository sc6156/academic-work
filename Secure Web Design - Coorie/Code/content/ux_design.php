<?php
/* This page enables users to download a copy of the ux design report and personas 
which were created before the site was built. Only signed in users can access this page. */

require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
startSession();
checkAllowed();
echo createHead("UX Design Report");


echo '<body>';
  echo '<div id="page_container">';
  
  createHeader(); 

  echo '<div class="clear"></div>';
  echo '<main id="uxsection">';
    createStickyBar(); 
  
    echo '<h1 class="headings">UX Design</h1>';
  
    echo '<p>Please download the <a href="/PE7045/assets/downloadable_files/ux_design_report.pdf" class="links">UX Design PDF file</a>
    to view the wireframes and notes that were used to help create this website. The <a href="/PE7045/assets/downloadable_files/personas.pdf" 
    class="links">personas</a> created during the design process can also be downloaded.</p>';
    
	echo '<p>Although the final website implements most of the features included in the wireframes, it is important to note that some were excluded. 
    For example, there was an aspiration to include a password reset function and a webform for enquiries. In practice, both would require access 
    to a SMTP server or contact with some other external server, therefore these features could not be implemented. Lack of expertise and time 
    were also a factor in other cases.</p>';
  
  echo '</main>';

  echo '<div class="clear"></div>';
  
  createFooter(); 

  echo '</div>';
echo '</body>';
echo '</html>';
?>