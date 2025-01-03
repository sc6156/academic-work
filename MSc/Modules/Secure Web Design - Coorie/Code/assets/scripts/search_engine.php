<?php
/* This script obtains the data entered by the user in the search form
on the accommodation_search.php page. If no data is entered, the script 
echoes a list of all accommodation in the database using the accom_list.php 
external script by default. If data is entered, the parameters are entered 
into a SQL query and the details of the accommodation returned are obtained 
using the display_results.php external script. */

// Declare variables that will be used to store the form data  
$area = "";
$guests = 0;
$bedrooms = 0;
$costmin = 0.0;
$costmax = 0.0;

// Check if form data submitted - if not, display all accommodation in database by default   
if (!isset($_GET["search"]) || isset($_GET["reset"])) {
  include_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/accom_list.php");	
}
// If form data is submitted, start processing it then display the search results 
else {
  // 	
  if ($_SERVER["REQUEST_METHOD"] == "GET") { 
    //Sanitise data received from form before entering into SQL query   
    $area = empty($_GET["area"]) ? "prompt" : filter_var($_GET["area"], FILTER_SANITIZE_STRING);
    $guests = empty($_GET["guests"]) ? 1 : filter_var($_GET["guests"], FILTER_SANITIZE_NUMBER_INT);
    $bedrooms = empty($_GET["bedrooms"]) ? 1 : filter_var($_GET["bedrooms"], FILTER_SANITIZE_NUMBER_INT);
    $costmin = empty($_GET["costmin"]) ? 1 : filter_var($_GET["costmin"], FILTER_SANITIZE_NUMBER_INT);
    $costmax = empty($_GET["costmax"]) ? 250 : filter_var($_GET["costmax"], FILTER_SANITIZE_NUMBER_INT);


    /* The 'prompt' value for $area represents the default 'Search all areas' option in the drop down list. 
	If a user doesn't choose a particular area and leaves this option as the default, it is not included in 
	query passed to MySQL. In this case, the results returned are based on any of the remaining form data 
	being set (guests, bedrooms and cost). */
    if($area=="prompt") {
	  $sqlSearch = "SELECT * FROM accommodation a, accom_photos ap WHERE a.accommodationID = ap.accommodationID AND a.guests >=? 
	  AND a.bedrooms >=? AND a.price_per_night >=? AND a.price_per_night <=?";
	  
	  if($stmt = mysqli_prepare($conn, $sqlSearch)){
	    mysqli_stmt_bind_param($stmt, "iidd", $guests, $bedrooms, $costmin, $costmax);
	    mysqli_stmt_execute($stmt);
	    $result = mysqli_stmt_get_result($stmt);
		
	    include_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/display_results.php");	
	  }	
	  mysqli_free_result($result); //The database connection is closed in the accommodation_search.php script 
	}	
	/* If the user does select an area in the html search form, use this and the other parameters to construct 
	the SQL query. */
	else {	
	  $sqlSearch = "SELECT * FROM accommodation a, accom_photos ap WHERE a.accommodationID = ap.accommodationID AND a.area =? AND a.guests >=? 
	  AND a.bedrooms >=? AND a.price_per_night >=? AND a.price_per_night <=?";
		
	  if($stmt = mysqli_prepare($conn, $sqlSearch)){
	    mysqli_stmt_bind_param($stmt, "siidd", $area, $guests, $bedrooms, $costmin, $costmax);
	    mysqli_stmt_execute($stmt);
	    $result = mysqli_stmt_get_result($stmt);
		
	    include_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/display_results.php");	
	  }
	  mysqli_free_result($result);  //The database connection is closed in the accommodation_search.php script 
	}
  }
}
?>	