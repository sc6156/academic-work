<?php
/* This page is displayed when the user clicks the Confirm Booking button
on the booking.php page. They are told their booking is confirmed or it was unable 
to be completed. If it was successful, the details are entered into the SQL 
database. */

require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
startSession();
echo createHead("Booking Confirmation");


echo '<body>';
  echo '<div id="page_container">';
  
  createHeader(); 

  echo '<div class="clear"></div>';
  
  // Store variables from session that are needed in this page
  $accom_id = isset($_SESSION['currentAccom']) ? $_SESSION['currentAccom'] : null;
  $customerID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;	
  $checkin = isset($_SESSION['checkin']) ? $_SESSION['checkin'] : null;
  $checkout = isset($_SESSION['checkout']) ? $_SESSION['checkout'] : null;
  $guests = isset($_SESSION['guests']) ? $_SESSION['guests'] : null;
  $totalCost = isset($_SESSION['totalCost']) ? $_SESSION['totalCost'] : null;
 
  $conn = getConnection();     
  
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
	//Check if 'Confirm Booking' button has been clicked and insert details into database if so
    if(isset($_POST['conBookButton'])) {
		
      $insertSQL = "INSERT INTO booking (accommodationID, customerID, start_date, end_date, 
      num_guests, total_booking_cost) VALUES(?, ?, ?, ?, ?, ?)";
	
      if($stmt = mysqli_prepare($conn,$insertSQL)) {
        mysqli_stmt_bind_param($stmt, "ssssss", $accom_id, $customerID, $checkin, $checkout, $guests, $totalCost);	
        $queryresult2 = mysqli_stmt_execute($stmt);
          if (!$queryresult2) {
			echo "<p>We are unable to process your booking at this time. Please try again later or <a href=\"contact_us.php\">contact us</a> to book.</p>";  
		    header('Refresh: 3; url=home.php');
		  }	
		  else {
			echo "<p>Your booking is confirmed and the details have been stored in your account. You will be sent a written confirmation and invoice via 
			email shortly. Thank you for booking with coorie.</p>";    
		    header('Refresh: 3; url=home.php');
		  }
	  }		
	}		
  }	
  
  echo '</div>';
echo '</body>';
echo '</html>';
?>