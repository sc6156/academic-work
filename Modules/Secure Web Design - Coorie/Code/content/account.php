<?php
/* This page can only be accessed if the user is signed into their account. It 
displays their account details and bookings they have made.*/

require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
startSession();
checkAllowed(); // Check if the user is signed in
echo createHead("My account");

echo '<body>';
  echo '<div id="page_container">';
  
  createHeader(); 

  echo '<div class="clear"></div>';
  echo '<main>';
    createStickyBar(); 

    // Store variables from session that are needed in this page
    $customerID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;
  
    $conn= getConnection();
  
    // Get customer's details from the database
    $customer = "SELECT customerID, email_address, customer_forename, customer_surname, customer_postcode,
    customer_address1, customer_address2, date_of_birth FROM customers WHERE customerID = $customerID";
  
    $queryresult = mysqli_query($conn, $customer);
    $customerDetails = mysqli_fetch_array($queryresult);
   
    // Start echoing customer details to the screen
	echo "<div id=\"accDetails\">";
      echo "<h2>Account Details</h2>";
      echo "<p><b>Name:</b> &ensp;".$customerDetails['customer_forename']." ".$customerDetails['customer_surname']."</p>"; 
      echo "<p><b>Date of Birth:</b> &ensp;".getUKDate($customerDetails['date_of_birth'])."</p>"; 
      echo "<p><b>Address:</b> &ensp;".$customerDetails['customer_address1'].", ".$customerDetails['customer_address2'].", ".$customerDetails['customer_postcode']."</p>";  
      echo "<p><b>Email Address:</b> &ensp;".$customerDetails['email_address']."</p>&emsp;"; 
   
    // Start the accommodation booking section 
    echo "<h2>Accommodation Bookings</h2>";
   
    // Get details of accommodation the customer has booked, if any  
    $bookings = "SELECT a.accommodation_name, a.area, a.accommodationID, b.accommodationID, b.customerID, 
    b.start_date, b.end_date, b.num_guests, b.total_booking_cost, b.bookingID 
    FROM accommodation a, booking b
    WHERE b.customerID = $customerID
    AND b.accommodationID = a.accommodationID";
 
    if($queryresult2 = mysqli_query($conn, $bookings)) {
      if(!mysqli_num_rows($queryresult2) == 0) { 
        while($currentrow = mysqli_fetch_assoc($queryresult2)) {
		  $bookingID = $currentrow['bookingID'];	
          $accomName = $currentrow['accommodation_name'];
          $area = $currentrow['area'];
          $start_date = getUKDate($currentrow['start_date']);
          $end_date = getUKDate($currentrow['end_date']);
          $num_guests = $currentrow['num_guests'];
          $cost = $currentrow['total_booking_cost'];
		  
		  echo '<p><b>Booking ID:</b> '.$bookingID.'</p>';
		  echo '<p><b>Accommodation:</b> '.$accomName.'</p>';
		  echo '<p><b>Area:</b> '.$area.'</p>';
		  echo '<p><b>Check In:</b> '.$start_date.'</p>';
		  echo '<p><b>Check Out:</b> '.$end_date.'</p>';
		  echo '<p><b>Guests:</b> '.$num_guests.'</p>';
		  echo '<p><b>Total Cost:</b> £'.$cost.'</p>';
		  echo '<br><br>';
        }
      }
      else  {
        echo "<p>No bookings have been made yet.</p>";   
      }
    }  
	echo '</div>';
    
  echo '</main>';

  echo '<div class="clear"></div>';
  
  createFooter(); 

  echo '</div>';
echo '</body>';
echo '</html>';
?>