<?php 
/* This script obtains details and images of all accommodation in the MySQL database 
and echoes each one to the screen. It is called by the search_engine.php script by default
when the user hasn't entered data in the html form on the accommodation_search.php 
page. */

$sqlAccom = "SELECT * FROM accommodation a, accom_photos ap WHERE a.accommodationID = ap.accommodationID";
	  
if($newresult = mysqli_query($conn, $sqlAccom)) {
  // Use a while loop to obtain details of accommodation one at a time then echo to the screen	
  while($currentrow = mysqli_fetch_assoc($newresult)) {
    $img = $currentrow['img1']; 
    $alt = $currentrow['alt1'];
    $name = $currentrow['accommodation_name'];
	$id = sprintf("%04d",$currentrow['accommodationID']); // Store accommodation id in variable with leading zeros included 
    $filename = str_replace(" ", "_", strtolower($name)); // E.g. store accommodation name as loch_hosta_cottage, not loch hosta cottage
    $area = $currentrow['area'];
    $guests = $currentrow['guests'];
    $bedrooms = $currentrow['bedrooms'];
    $bathrooms = $currentrow['bathrooms'];
    $desc = $currentrow['description'];
    $price = intval($currentrow['price_per_night']); // Store the integer value rather than the decimal in the database 

    echo '<a href="/PE7045/content/'.$id.'_'.$filename.'.php"><figure class="accomlist">';
	  echo '<img class="accomlist_img" src="'.$img.'" alt="'.$alt.'">';
	  echo '<h2 class="accomlist_head">'.$name.', '.$area.'</h2>';
	  
	  // Use if statements to determine whether to pluralise bathrooms and bedrooms in subheading
	  if($bedrooms > 1 && $bathrooms > 1) {
	    echo '<div class="accomsum">';
		  echo '<div><span class="stat">'.$currentrow['guests'].'</span> guests</div>';
	      echo '<div><span class="stat">'.$currentrow['bedrooms'].'</span> bedrooms</div>';
	      echo '<div><span class="stat">'.$currentrow['bathrooms'].'</span> bathrooms</div>';
	      echo '<div><span class="stat">£'.intval($currentrow['price_per_night']).'</span> per night</div>';
		echo '</div>';
	  }
	  else if ($bedrooms > 1 && $bathrooms == 1) {
		echo '<div class="accomsum">';
	      echo '<div><span class="stat">'.$currentrow['guests'].'</span> guests</div>';
	      echo '<div><span class="stat">'.$currentrow['bedrooms'].'</span> bedrooms</div>';
	      echo '<div><span class="stat">'.$currentrow['bathrooms'].'</span> bathroom</div>';
	      echo '<div><span class="stat">£'.intval($currentrow['price_per_night']).'</span> per night</div>';
		echo '</div>';
	  }
	  else if ($bedrooms ==1 && $bathrooms > 1) {
	    echo '<div class="accomsum">';
		  echo '<div><span class="stat">'.$currentrow['guests'].'</span> guests</div>';
	      echo '<div><span class="stat">'.$currentrow['bedrooms'].'</span> bedroom</div>';
	      echo '<div><span class="stat">'.$currentrow['bathrooms'].'</span> bathrooms</div>';
	      echo '<div><span class="stat">£'.intval($currentrow['price_per_night']).'</span> per night</div>';
		echo '</div>';
	  }
	  else {
	    echo '<div class="accomsum">';
		  echo '<div><span class="stat">'.$currentrow['guests'].'</span> guests</div>';
	      echo '<div><span class="stat">'.$currentrow['bedrooms'].'</span> bedroom</div>';
	      echo '<div><span class="stat">'.$currentrow['bathrooms'].'</span> bathroom</div>';
	      echo '<div><span class="stat">£'.intval($currentrow['price_per_night']).'</span> per night</div>';
		echo '</div>';
	  }
	    echo '<p class="adesc">'.$desc.'</p>';
    echo '</figure></a>';
  
  echo '<div class="clear"></div>';
  }
}
mysqli_free_result($newresult);
?>