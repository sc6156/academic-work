<?php
/* This script takes the results obtained from the SQL query in search_engine.php 
and echoes only the accommodation that meet the search parameters entered into 
the form on the accommodation_search.php */

// Provide feedback to the user on the result of their search 
$rows = mysqli_num_rows($result); 
if($rows == 0) {	
  echo "No results returned. Please widen your search.";  
}
else if($rows == 1){
  echo $rows." result returned.";	
}
else {
  echo $rows." results returned.";	
}

while($currentrow = mysqli_fetch_assoc($result)) {
  $img = $currentrow['img1'];
  $alt = $currentrow['alt1'];
  $name = $currentrow['accommodation_name'];
  $filename = str_replace(" ", "_", strtolower($name));
  $area = $currentrow['area'];
  $guests = $currentrow['guests'];
  $bedrooms = $currentrow['bedrooms'];
  $bathrooms = $currentrow['bathrooms'];
  $desc = $currentrow['description'];
  $price = intval($currentrow['price_per_night']);
  $id = sprintf("%04d",$currentrow['accommodationID']);

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
?>