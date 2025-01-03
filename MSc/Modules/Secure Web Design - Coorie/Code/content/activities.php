<?php
/* This page provides further information about activities and details 
on each one. It queries the MySQL database to get these details. */
  
require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
startSession();
echo createHead("Explore Activities");

echo '<body>';
  echo '<div id="page_container">';
  
  createHeader(); 

  echo '<div class="clear"></div>';
  echo '<main id="actGap">';
    createStickyBar(); 
  
    echo '<h1 class="headings">Activities Overview</h1>';
  
    echo '<p>When booking accommodation with coorie, guests can choose to take part in a wide range of activities during their stay. 
    These activities cater for the very active to those that enjoy a slower pace of life, so there is something for everyone.</p>';
  
    echo '<p>Activities are self-led, delivered online to the devices provided in the accommodation or attended in person. Some are free 
    and included within the cost of the accommodation, whereas others incur an additional charge.</p>';
  
    echo '<p>The full range of activities are listed below. Please note that the activities offered are dependent on the accommodation. 
    Full details on what is available can be found on the accommodation page for each property.</p>';

	$conn = getConnection();
	
	// Ensure utf-8 character set returned from database queries for display purposes 
	$charset = "SET NAMES 'utf8'";
	mysqli_query($conn, $charset);
	  
	$sql = "SELECT * FROM activities";
	  
	if($queryresult = mysqli_query($conn, $sql)) {
	  while($currentrow = mysqli_fetch_assoc($queryresult)) {
	    $name = $currentrow['name'];
	    $path = $currentrow['imagePath'];
		$alt = $currentrow['altImage'];
		$desc = $currentrow['description'];
		$format = $currentrow['format'];
		$level = $currentrow['activityLevel'];
		$cost = $currentrow['cost'];
			  
		echo '<figure class="activities">';
          echo '<h2 class="act_heading">'.$name.'</h2>';
          echo '<img class="activity_img" src="'.$path.'" alt="'.$alt.'">';
          echo '<div class="activity_desc">';
            echo '<p><strong>Description: </strong>'.$desc.'';
            echo '<p><strong>Format: </strong>'.$format.'</p>';
            echo '<p><strong>Activity level: </strong>'.$level.'</p>';
            echo '<p><strong>Cost: </strong>'.$cost.'</p>';
          echo '</div>';
        echo '</figure>';
			  
		echo '<div class="clear"></div>';
      }
	}
	
	mysqli_free_result($queryresult);
	mysqli_close($conn);

  echo '</main>';

  echo '<div class="clear"></div>';
  
  createFooter(); 

  echo '</div>';
echo '</body>';
echo '</html>';
?>