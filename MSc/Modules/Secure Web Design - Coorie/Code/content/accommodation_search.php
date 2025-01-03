<?php

/* This page contains a form which allows the user to search the accommodation 
in the database. The search_engine.php scipt procide the functionality for the page.
It displays all accommodation in the database on the page by default. If the search 
button is clicked, the results are returned using the parameters entered. All of the 
form fields are optional.*/

require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
startSession();
echo createHead("Search for accommodation");

echo '<body>';
  echo '<div id="page_container">';
  
  createHeader(); 

  echo '<div class="clear"></div>';
  echo '<main>';
    createStickyBar(); 
	
	echo '<h1 class="headings">Find your perfect coorie getaway</h1>';
	
	//Search form created below. Please note that all form parameters are optional. 
  
    echo '<form id="bsearch" method="GET" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">';
    echo '<div id="search1">'; 
	  echo '<label for="area"></label>';
	    echo '<select name="area" id="area">';
		  echo '<option value="" disabled selected hidden>Where</option>';
	      echo '<option value="prompt">Search all areas</option>';
 
          // Connect to database to get other areas for drop down menu options 
	      $conn = getConnection();
		  
		  // Ensure utf-8 character set returned from database queries for display purposes 
	      $charset = "SET NAMES 'utf8'";
	      mysqli_query($conn, $charset);
	
		  $sqlArea = "SELECT DISTINCT(area) FROM accommodation";
	
	      if($queryresult = mysqli_query($conn, $sqlArea)) {
	        while($currentrow = mysqli_fetch_assoc($queryresult)) {
	          $area = $currentrow['area'];
		      $areaRef = trim($area);
		      $areaRef = strtolower($areaRef);
		
		    echo '<option value="'.$areaRef.'">'.$area.'</option>';
	        }
	      }  
          mysqli_free_result($queryresult);	

        echo '</select>';
    echo '</div>';

    echo '<div id="search2">'; 			
	  echo '<label for="guests"></label>';
        echo '<input type="number" id="guests" name="guests" min="1" max="8" placeholder="Guests">';
    echo '</div>';
	
    echo '<div id="search3">'; 	
	  echo '<label for="bedrooms"></label>';
        echo '<input type="number" id="bedrooms" name="bedrooms" min="1" max="3" placeholder="Bedrooms">';
    echo '</div>';
	
    echo '<div id="search4">'; 	  
	  echo '<label for="costmin" id="cost"></label>';
        echo '<input name="costmin" id="costmin" type="number" min="1" max="250" placeholder="From £">';
    echo '</div>';
	
    echo '<div id="search5">'; 	  
	  echo '<label for="costmax"></label>';
        echo '<input name="costmax" id="costmax" type="number" min="1" max="250" placeholder="To £">';
    echo '</div>';
	
	  echo '<input id="sbutton" type="submit" name="search" value="Search">';
	
	  echo '<input type="submit" id="reset" name="reset" value="Reset search">';

    echo '</form>';
  
    include_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/search_engine.php");
    mysqli_close($conn);
 
  echo '</main>';

  echo '<div class="clear"></div>';
  
  createFooter(); 

  echo '</div>';
echo '</body>';
echo '</html>';
?>