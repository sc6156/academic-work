<?php
/* This script creates a function which can be used to generate
the head section displayed at the top of each page. A parameter is taken
to set the title of the page. */

function createHead($title) {
  $createHead = <<<HEADCONTENT
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="utf-8"> 
	  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <title>$title</title>
      <link rel="stylesheet" type="text/css" href="/PE7045/assets/stylesheets/coorie_css_master.css"/>
      <script defer src="/PE7045/assets/scripts/js_functions.js"></script>
    </head>
HEADCONTENT;
  return $createHead;
}


/* This script creates a function which generates the header section that 
is used throughout the site. It contains the company logo and a utilities menu. 
An unordered list is used as the basis for the menu. */

function createHeader() {

  /* Obtain current url so can use in the code below and css stylesheet to 
  highlight whether any of the links in the header have been clicked */
  $current_url = basename($_SERVER['PHP_SELF']);

  /* Get absolute path of current page using function and store in a variable 
  used in the sign_in.php page to redirect users to their previous page after 
  they have signed in */
  $oldPage = getPath();

  // Create the header using the variables above
  echo '<header>';
    if($current_url !== 'home.php'){  // Make the logo a link if the user is not on the homepage
      echo '<a href="home.php"><img id="logo" src="/PE7045/assets/images/coorie_logo.png" alt="picture of coorie logo"></a>';
	}
    else {
      echo '<img id="logo" src="/PE7045/assets/images/coorie_logo.png" alt="picture of coorie logo">';
    }
    echo '<ul id="menu">'; 
    // Start creating the menu items 	
?>
      <li <?php if ($current_url == 'home.php'){echo 'class="current"';}?> id="home"><a href="home.php">Home</a></li>
      <li <?php if ($current_url == 'about.php'){echo 'class="current"';}?> id="about"><a href="about.php">About</a></li>   
      
<?php 
    // If the user is not signed in, display the sign in and register options 
    if(!check_login()) { 
?>
      <li <?php if ($current_url == 'sign_in.php'){echo 'class="current"';}?> id="sign_in"><a href="sign_in.php?page_url=<?php echo $oldPage;?>">Sign In</a></li>
      <li <?php if ($current_url == 'register.php' || $current_url == 'registerProcess.php' ){echo 'class="current"';}?> id="register"><a href="register.php">Register</a></li>
<?php 
    }    
    else { 
    // If the user is signed in, display a link to their account and a logout option
?>
      <li <?php if ($current_url == 'account.php'){echo 'class="current"';}?> id="welcome"><a id="acclink" href="account.php">Account</a></li>  
      <li id="logout"><a href="logout.php">Logout</a></li>  
<?php  
    }
    echo '</ul>';
  echo '</header>';
  }


/* This script creates a function which generates the footer section that 
 is used throughout the site. It houses a further utilities menu containing 
 elements/links which aren't considered worthy of being displayed in the header. */

function createFooter() {
  $current_url = basename($_SERVER['PHP_SELF']); 

  echo '<footer>';
    echo '<ul id="endMenu">'; 
?>
      <li <?php if ($current_url == 'credits.php'){echo 'class="current"';}?> id="credits"><a href="credits.php">Site Credits</a></li>
      <li <?php if ($current_url == 'contact_us.php'){echo 'class="current"';}?> id="contact_us"><a href="contact_us.php">Contact Us</a></li>
      <li <?php if ($current_url == 'ux_design.php'){echo 'class="current"';}?> id="ux_design"><a href="ux_design.php">UX Design</a></li>
      <li <?php if ($current_url == 'security_report.php'){echo 'class="current"';}?> id="security_report"><a href="security_report.php">Security Report</a></li>
<?php
    echo '</ul>';
  echo '</footer>';
}


/* This script creates a function which generates the sticky navigation bar 
 that is used on many of the pages. It contains only 2 links: one to the accommodation 
 search page and another to a page detailing the activities. */
 
function createStickyBar() {
  $current_url = basename($_SERVER['PHP_SELF']);

  echo '<nav id="stickyBarContainer">';
    echo '<ul id="stickyBar">'; 
?>
      <li <?php if ($current_url == 'accommodation_search.php'){echo 'class="current"';}?> id="accomSearch">
      <a href="accommodation_search.php">Search for Accommodation</a></li>
      <li <?php if ($current_url == 'activities.php'){echo 'class="current"';}?> id="exploreActivities">
      <a href="activities.php">Explore Activities</a></li>
<?php
    echo '</ul>';
  echo '</nav>';
}


/* This script creates a function which establishes a connection to the 
 coorie database. */

function getConnection() {
  define('DB_NAME', 'unn_w21056374');
  define('DB_USER', 'unn_w21056374');
  define('DB_PASSWORD', 'N3wm0dule5678!');
  define('DB_HOST', 'localhost');
    
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
    die("Cannot connect to the database");
	
  return $conn;
} 


/* This script creates a function which populates each accommodation page and 
provides the accommodation details held in the company database. Filepaths to photos of 
properties are retrieved from the database and displayed on the page, along with an 
overview, information on facilities and activity details. A Google Maps API is also used to 
display the accommodation location and a booking form is provided at the bottom. */

function createAccomContent() {
  $conn = getConnection();  
  
  // Ensure utf-8 character set returned from database queries for display purposes 
  $charset = "SET NAMES 'utf8'";
  mysqli_query($conn, $charset);

  $accom_url = basename($_SERVER['PHP_SELF']); // Get the accommodation page filename (e.g. 0001_loch_hosta_cottage)
  $accom_id = substr($accom_url, 0, 4); // Place the first 4 numbers in the filename in the variable $accom_id
  $_SESSION['currentAccom'] = $accom_id;  // Save accom_id in session variable so it can be accessed on subsequent booking page
  $_SESSION['returnToAccom'] = getPath();  // Save path to current accom page in session variable for use on subsequent booking page
	
  // Use $accom_id to find the property in the database
  $sql = "SELECT * FROM accommodation a, accom_photos ap WHERE a.accommodationID = ap.accommodationID AND a.accommodationID =".$accom_id;

  if($queryresult = mysqli_query($conn, $sql)) {
    $currentrow = mysqli_fetch_assoc($queryresult);
  }
    
  // Save accommodation details into session variables for use at booking stage, if the user decides to book 
  $_SESSION['costCurrentAccom'] = isset($currentrow['price_per_night']) ? $currentrow['price_per_night'] : null;
  $_SESSION['maxGuests'] = isset($currentrow['guests']) ? $currentrow['guests'] : null;
  $_SESSION['accom_name'] = isset($currentrow['accommodation_name']) ? $currentrow['accommodation_name'] : null;
  $_SESSION['area'] = isset($currentrow['area']) ? $currentrow['area'] : null;
  $_SESSION['bookImage'] = isset($currentrow['img1']) ? $currentrow['img1'] : null;
  $_SESSION['bookImageAlt'] = isset($currentrow['alt1']) ? $currentrow['alt1'] : null;
	
  // Use results of query to start displaying accommodation content 
  echo '<h2 class="accom_title">'.$currentrow['accommodation_name'].', '.$currentrow['area'].'</h2>';
    
  // Use if statements to determine whether to pluralise bathrooms and bedrooms in subheading
  if($currentrow['bedrooms'] > 1 && $currentrow['bathrooms'] > 1) {
    echo '<div class="subheading">';
	  echo '<div><span class="stat">'.$currentrow['guests'].'</span> guests</div>';
	  echo '<div><span class="stat">'.$currentrow['bedrooms'].'</span> bedrooms</div>';
	  echo '<div><span class="stat">'.$currentrow['bathrooms'].'</span> bathrooms</div>';
	  echo '<div><span class="stat">£'.intval($currentrow['price_per_night']).'</span> per night</div>';
	echo '</div>';
  }
  else if ($currentrow['bedrooms'] > 1 && $currentrow['bathrooms'] == 1) {
    echo '<div class="subheading">';
	  echo '<div><span class="stat">'.$currentrow['guests'].'</span> guests</div>';
	  echo '<div><span class="stat">'.$currentrow['bedrooms'].'</span> bedrooms</div>';
	  echo '<div><span class="stat">'.$currentrow['bathrooms'].'</span> bathroom</div>';
	  echo '<div><span class="stat">£'.intval($currentrow['price_per_night']).'</span> per night</div>';
	echo '</div>';
  }
  else if ($currentrow['bedrooms'] == 1 && $currentrow['bathrooms'] > 1) {
    echo '<div class="subheading">';
	  echo '<div><span class="stat">'.$currentrow['guests'].'</span> guests</div>';
	  echo '<div><span class="stat">'.$currentrow['bedrooms'].'</span> bedroom</div>';
	  echo '<div><span class="stat">'.$currentrow['bathrooms'].'</span> bathrooms</div>';
	  echo '<div><span class="stat">£'.intval($currentrow['price_per_night']).'</span> per night</div>';
	echo '</div>';
  }
  else {
    echo '<div class="subheading">';
	  echo '<div><span class="stat">'.$currentrow['guests'].'</span> guests</div>';
	  echo '<div><span class="stat">'.$currentrow['bedrooms'].'</span> bedroom</div>';
	  echo '<div><span class="stat">'.$currentrow['bathrooms'].'</span> bathroom</div>';
	  echo '<div><span class="stat">£'.intval($currentrow['price_per_night']).'</span> per night</div>';
	echo '</div>';
  }

  // Start displaying photo gallery containing images of accommodation (image links obtained from database) 
  echo '<div class="gallery">';
    // Use first image from database as the main image on the property page
    echo '<img class="big_img" src="'.$currentrow['img1'].'" onclick="openModal();currentSlide(1)" alt="'.$currentrow['alt1'].'">';
    // Use 'for' loop to access remaining 8 images and display on page as smaller images
    for($x = 2; $x <= 9; $x++) {
      echo '<img class="thumb_img" src="'.$currentrow['img'.$x].'" onclick="openModal();currentSlide('.$x.')" alt="'.$currentrow['alt'.$x].'">';  
    } 
  echo '</div>';  
    
  // Create a model/lightbox which appears when an image is clicked in the gallery
  echo '<div id="myModal" class="modal">';
    echo '<span class="close cursor" onclick="closeModal()">&times;</span>';
    echo '<div class="modal-content">';
      
      for($x = 1; $x <= 9; $x++) {
        echo '<div class="mySlides">';
          echo '<span class="numbertext">'.$x.' / 9</span>';
          echo '<img src="'.$currentrow['img'.$x].'" alt="'.$currentrow['alt'.$x].'" class = "modal_img" style="width:100%">';
        echo '</div>';  
      }
    
      // Create the next and previous arrows
      echo '<a class="prev" onclick="plusSlides(-1)">&#10094;</a>';
      echo '<a class="next" onclick="plusSlides(1)">&#10095;</a>';
      
    echo '</div>';
  echo '</div>';
	
	
	
  // Start to display details about the accommodation facilities and the activities available 
  echo '<div class="accom_main">';
    echo '<div class="details">'; 
      echo '<h3>Overview<br></h3>';
      echo '<p>'.$currentrow['description'].'<br><br></p>';

      echo '<h3>Facilities<br></h3>';
      echo '<ul class="facilities">';
        if($currentrow['kitchen'] == 'Y') {echo '<li>Kitchen</li>';}
        if($currentrow['garden'] =='Y') {echo '<li>Garden</li>';}
        if($currentrow['parking'] == 'Y') {echo '<li>Parking</li>';}
        if($currentrow['bbq'] == 'Y') {echo '<li>BBQ</li>';}
        if($currentrow['wifi'] == 'Y') {echo '<li>WiFi</li>';}
        if($currentrow['tv'] == 'Y') {echo '<li>TV</li>';}
        if($currentrow['air_con'] == 'Y') {echo '<li>Air Conditioning</li>';}
        if($currentrow['pets_welcome'] == 'Y') {echo '<li>Pets Welcome</li>';}
      echo '</ul>';

      echo '<h3><br>Activities<br></h3>';
      echo '<ul class="activity_list">';
        $activities = array("hiking", "climbing", "horse_riding", "wild_swimming", "kayaking", "paddleboarding",
        "cycling", "fishing", "foraging", "yoga", "meditation", "stargazing", "painting");
      
        foreach($activities as $activity) {
          if($currentrow[$activity] == 'Y') {
            $display = ucwords(str_replace("_", " ", $activity));
              echo '<li>'.$display.'</li>'; 
          } 
        }
      echo '</ul>';
    echo '</div>';


    // Display a map of the accommodation location obtained from the Google Maps API
	echo '<div class="map">';
      echo '<h3>Location<br></h3>';
    
      require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/apiKey.php");
      $key = getMapsAPIKey();
    
      if(isset($currentrow['latitude']) && isset($currentrow['longitude'])) {
        echo '<div class="gmap">';
		  echo '<iframe style="border:0" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/place?q='.$currentrow['latitude'].',+'.$currentrow['longitude'].'&key='.$key.'&zoom=8"></iframe>';
        echo '</div>';
	  }
      else {
        echo '<p>Cannot display map.</p>';    
      }   
	echo '</div>';
    
	//Display booking form if user is signed in 
	if(check_login()){
	  echo '<div class="bookingForm">';
	    echo '<form class="booking" method="POST" action="booking.php">';
	      echo '<div class="checkin">';
            echo '<label for="chkin">Check In</label>';
            echo '<input id="chkin" type="date" name="checkin">';
	      echo '</div>';		
	      echo '<div class="checkout">';
            echo '<label for="chkout">Check Out</label>';
            echo '<input id="chkout" type="date" name="checkout">';
	      echo '</div>';			  
	      echo '<div class="guests">';
            echo '<label for="guest">Number of Guests</label>';
            echo '<input id="guest" type="number" class="guestbox" name="guests" min="1" max="'.$currentrow['guests'].'">';
	      echo '</div>';		
		  echo '<input type="submit" class="bookbutton" name="bookbutton" value="Book">';	
        echo '</form>'; 
	  echo '</div>';
    }	
	//Display link to sign in page if user is not signed in
	else {  
	  $oldPage = getPath();
      echo '<p id="signinpara">To book this accommodation, please <span class="sibutton"><a href="sign_in.php?page_url='.$oldPage.'">sign in</a></span> to your account.</p>';
	}
	
  echo '</div>';
    
  mysqli_free_result($queryresult);
  mysqli_close($conn);  
}


/* This script creates a function which checks whether a customer is signed
into the site and has established a session. */

function check_login() {
  if (isset($_SESSION['logged-in']) && $_SESSION['logged-in']) {
    return true;
  }
  else {
    return false;
  }
}


// This script creates a function which starts a session. 

function startSession() {
  ini_set("session.save_path", "../../../sessionData");
  session_start();
}


/* This script creates a function which can be used on restricted pages. If a 
customer is signed in, the page is displayed. If not, a popup alert is generated and
the customer is redirected to the sign in page. */

function checkAllowed() { 
  if(!check_login()) {
	echo "<script>alert(\"You must be signed in to view this page. You are being redirected to the sign in page.\");</script>";
    header('Refresh: 0; url=sign_in.php');
	exit();
  }
}


/* This script creates a function which obtains the path of the page the user 
is currently on. It is used in other scripts to redirect the user back to their 
previous page, after they have signed in. */

function getPath() {
  $protocol = $_SERVER['SERVER_PROTOCOL'];
  if(strpos($protocol, "HTTPS")) {
    $protocol = "HTTPS://";
  }	
  else {
	$protocol	= "HTTP://";		
  }	

  $redirect_link =  $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];	
  return $redirect_link;
}

  
/* This function takes a date from an html form and reformats it so that it can be used 
  in the checkdate() function to determine whether it is a valid date (rather than a string etc). */

function dateCheck($htmlDate) {
  $arr = date_parse($htmlDate);
  $mm = intval($arr['month']);
  $dd = intval($arr['day']);
  $yy = intval($arr['year']);  

  if(checkdate($mm, $dd, $yy)){
    return true;		 
  }
  else {
    return false;
  }	   
}	  

  
/* This function takes a date from an html form and returns it in the 
UK format DD/MM/YYYY. */

function getUKDate($htmlDate) {
  $arr = date_parse($htmlDate);
  $dd = intval($arr['day']);
  if($dd < 10) {
    $dd = "0".$dd;	  
  }
 
  $mm = intval($arr['month']);
    if($mm < 10) {
    $mm = "0".$mm;	  
  }
  
  $yy = intval($arr['year']);  

  $ukdate = $dd."/".$mm."/".$yy;
  return $ukdate;
}	  

  
/* This function takes a date from an html form and puts it in a datetime format 
so it can be accepted in MySQL or used with a logical operator. */

function formatDate($htmlDate) {
  $formattedDate = date("Y-m-d", strtotime($htmlDate));
  return $formattedDate;
}	  
?>