<?php
/* This page takes the data entered into the html form on an accommodation page, 
validates it and checks whether the property can be booked. If it is already booked 
or there are errors in the form submission, the user is told and a button can be 
clicked to return them to the form. If the booking is available, the user is presented 
with details of the booking and asked to click a button to confirm it. */

require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
startSession();
checkAllowed(); // Check if the user is signed in
echo createHead("Confirm Booking");

echo '<body>';
  echo '<div id="page_container">';
  
  createHeader(); 

  echo '<div class="clear"></div>';

  $conn = getConnection();
  
  /* Main programme logic which utilises the functions lower down in the script called 
  validate_form(), show_errors() and process_form(). Either the errors are displayed or 
  the form is processed and the user is asked to confirm their booking */
  list($input, $errors) = validate_form();

  if ($errors) {
	echo show_errors($input, $errors, $conn);
  } 
  else {
    echo process_form($input);
  }
  
  createFooter(); 

  echo '</div>';
echo '</body>';
echo '</html>';


/* This function validates the data entered in the html form and stores both 
the input and errors into arrays */

function validate_form() {
  global $conn; 
  $errors = array();
  $input = array();

  /* Get each parameter value from the request stream and using ternary if operators check each parameter 
  to see if it was set. If it is, store it in a variable. Otherwise store a value of null in the variable */
  $input['checkin'] = array_key_exists('checkin', $_REQUEST) ? $_REQUEST['checkin'] : null;
  $input['checkout'] = array_key_exists('checkout', $_REQUEST) ? $_REQUEST['checkout'] : null;
  $input['guests'] = array_key_exists('guests', $_REQUEST) ? $_REQUEST['guests'] : null;
  
  // Create variables for use in validation of dates below
  // formatDate() is a user-defined function which formats the date so it can be used with logical operators 
  $now = date('Y-m-d');
  $checkin = formatDate($input['checkin']);
  $checkout = formatDate($input['checkout']);
  
  // Validation checks - 'checkin' variable 
  if (empty($input['checkin'])) {
    $errors[] = "<p>You have not entered a date in the 'Check In' field</p>\n";
  }
  else if (!dateCheck($input['checkin'])) { // dateCheck() is a user-defined function which checks if the date is valid 
    $errors[] = "<p>You have not entered a valid date in the 'Check In' field</p>\n";	  
  }	  
  else if ($checkin < $now) {
    $errors[] = "<p>The date that you've inserted in the 'Check In' field is in the past</p>\n";	   
  }	 

  // Validation checks - 'checkout' variable 
  if (empty($input['checkout'])) {
    $errors[] = "<p>You have not entered a date in the 'Check Out' field</p>\n";
  }
  else if (!dateCheck($input['checkout'])) {
    $errors[] = "<p>You have not entered a valid date in the 'Check Out' field</p>\n";	  
  }	  
  else if ($checkout < $now) {
    $errors[] = "<p>The date that you've inserted in the 'Check Out' field is in the past</p>\n";	   
  }	   
  
  // Validation checks - establish whether checkout is after checkin and at least one night is booked  
  if ($checkout <= $checkin) {
    $errors[] = "<p>The check out date must be after the check in date with at least one night booked</p>\n";	   
  }	     
  
  // Get accommodationID from session variable for use in SQL query below 
  $accom_id = isset($_SESSION['currentAccom']) ? $_SESSION['currentAccom'] : null;
  $validDateCheck = "SELECT accommodationID, start_date, end_date FROM booking WHERE accommodationID = $accom_id";
  
  // Validation checks - determine whether dates selected are already booked 
  $queryresult = mysqli_query($conn, $validDateCheck);
  if($queryresult) {
    while($currentrow = mysqli_fetch_assoc($queryresult)) {
	  if(($checkin >= $currentrow['start_date'] && $checkin < $currentrow['end_date']) 
	  || ($checkout > $currentrow['start_date'] && $checkout <= $currentrow['end_date'])
      || ($checkin <= $currentrow['start_date'] && $checkout >= $currentrow['end_date'])){
        $errors[] = "<p>This accommodation is already booked during the dates that you've selected.</p>\n";	 
	  }
    }
	  mysqli_free_result($queryresult);
	  mysqli_close($conn);
  }
  
  // Store max number of guests the accom can hold in a variable for validation 
  $guests = isset($_SESSION['maxGuests']) ? $_SESSION['maxGuests'] : null;  
  
  // Validation checks - 'guests' variable 
  if (empty($input['guests'])) {
    $errors[] = "<p>You have not entered the number of guests that will be staying</p>\n";
  }
  else if($input['guests'] <= 0 || $input['guests'] > $guests) {
	$errors[] = "<p>This property can only accommodate between 1 and $guests guests</p>\n";  
  }	  
  
  return array($input,$errors);
} 
  
/* In this function, we pass in the array of error messages, loop through it and concatenate
all the messages together. A button is also added which allows the customer to return to 
the form on the accommodation page. */
   
function show_errors($input, $errors, $conn) {
  $error_output = "<div id=\"errormsg\"><p>The following problem(s) occurred when trying to process your booking:</p><br><ul> ";
  foreach ($errors as $currentErrorMessage) {
    $error_output .= "<li>".$currentErrorMessage. "</li>\n";
  }
  $error_output .= "<br></ul><p>Please try again.</p><br><br>";
  $error_output .= "<button id=\"backButton\"><a href=\"javascript:history.go(-1)\">Return to accommodation page</a></button>";
  return $error_output;
}


/*In the function below, we pass in the array of validated input values and use them
to display details of the proposed booking, which we ask the customer to confirm by clicking 
a button. When they do, they are then taken to the bookingConfirmation.php page.*/

function process_form($input) {
  // Store variables from session that are needed in this function 
  $costPerNight = isset($_SESSION['costCurrentAccom']) ? $_SESSION['costCurrentAccom'] : null;
  $accomName = isset($_SESSION['accom_name']) ? $_SESSION['accom_name'] : null;
  $area = isset($_SESSION['area']) ? $_SESSION['area'] : null;
  $image = isset($_SESSION['bookImage']) ? $_SESSION['bookImage'] : null;
  $alt = isset($_SESSION['bookImageAlt']) ? $_SESSION['bookImageAlt'] : null;
  
  // Calculate duration of booking and total cost
  $in = date_create($input['checkin']);
  $out = date_create($input['checkout']);
  $totalNights = date_diff($in, $out);
  $totalNights = $totalNights->format("%a");
  $totalCost = $costPerNight * $totalNights;
  
  // Convert dates into UK format 
  $checkinDisplay = getUKDate($input['checkin']);
  $checkoutDisplay = getUKDate($input['checkout']);
  
  // Store additional session variables needed in bookingConfirmation.php
  $_SESSION['checkin'] = isset($input['checkin']) ? formatDate($input['checkin']) : null;
  $_SESSION['checkout'] = isset($input['checkout']) ? formatDate($input['checkout']) : null;
  $_SESSION['guests'] = isset($input['guests']) ? $input['guests'] : null;
  $_SESSION['totalCost'] = $totalCost;
 
  // Ask customer to check details before confirming booking 
  echo "<div id=\"confirmBook\">";
    echo "<div id=\"bookDetails\">";
      echo "<h2>".$accomName.", ".$area."</h2>";
      echo "<p>You have chosen to book this accommodation from <b>".$checkinDisplay."</b> to <b>".$checkoutDisplay."</b> for <b>". $input['guests'] ."</b> guests.</p>";
      echo "<p>The total cost for <b>".$totalNights."</b> nights is <b>£".$totalCost."</b>.</p>";
      echo "<p>If you would like to book this accommodation, please click the button below.</p>";
      echo "<form method=\"POST\" action=\"bookingConfirmation.php\">";
        echo "<input type=\"submit\" id=\"conBookButton\" name=\"conBookButton\" value=\"Confirm Booking\">";
      echo "</form>";
    echo "</div>";
  
    echo '<img id="book_img" src="'.$image.'" alt="'.$alt.'">';
  echo "</div>";
}
?>






