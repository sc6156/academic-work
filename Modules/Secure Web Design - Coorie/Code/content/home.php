<?php
/* This is the homepage. It contains three main sections: an intro section
which summarises what the site does, a recently added accommodation section, and 
finally a section for testimonials. */

require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
startSession();
echo createHead("coorie - wellness holidays and activities");

echo '<body>';
  echo '<div id="page_container">';
  
  createHeader(); 

  echo '<div class="clear"></div>';
  echo '<main>';
    
  /* This is the first section of the main content on the page. It contains 
  text summarising what the website offers, 2 buttons to navigate to key pages 
  in the site, and a picture to entice customers. */
	
    echo '<section>';
      echo '<div id="intro">';	
	    echo '<h1>Wellness Holidays and Activities</h1>';
	    echo '<p>Take a break from urban living and retreat to some of the best holiday accommodation 
	     that rural Scotland has to offer. Take part in a range of activities designed to enhance 
	     your wellbeing, from stargazing to wild swimming.</p>';
		   echo '<div id="buttonGroup">';
		     echo '<button class="homeButtons" onclick="window.location.href=\'/PE7045/content/accommodation_search.php\'">Search for Accommodation</button>';
	         echo '<button class="homeButtons" onclick="window.location.href=\'/PE7045/content/activities.php\'">Explore Activities</button>';
		   echo '</div>'; 
	  echo '</div>';
      echo '<img id="home_img" src="/PE7045/assets/images/remote_cottage.jpg" alt="picture of remote cottage in Scottish Highlands">';
	echo '</section>';  
	
	echo '<div class="clear"></div>';

    /* This is the second section of the main content on the page. It contains 
	a picture and brief details of 3 properties that have recently been added to the 
	site. Each provides a link to the relevant accommodation page. */
	
    echo '<section id="recent">';
      echo '<h2 id="raa">Recently Added Accommodation</h2>'; 
	  echo '<div id="nas">';
	    echo '<a href="0001_loch_hosta_cottage.php"><figure>';
          echo '<img class="newAccom" src="/PE7045/assets/images/accom_id_0001/loch_hosta_cottage.jpg" alt="Picture of Loch Hosta Cottage in North Uist">';
          echo '<figcaption class="nacap">Loch Hosta Cottage<br>North Uist</figcaption>';
        echo '</figure></a>';
	    echo '<a href="0002_the_black_barn.php"><figure>';
          echo '<img class="newAccom" src="/PE7045/assets/images/accom_id_0002/black_barn_skye.jpg" alt="Picture of The Black Barn in the Isle of Skye">';
          echo '<figcaption class="nacap">The Black Barn<br>Isle of Skye</figcaption>';
        echo '</figure></a>';
	    echo '<a href="0003_achnacarron_boathouse.php"><figure>';
          echo '<img class="newAccom" src="/PE7045/assets/images/accom_id_0003/achnacarron_boathouse.jpg" alt="Picture of Achnacarron Boathouse in Argyll">';
          echo '<figcaption class="nacap">Achnacarron Boathouse<br>Argyll</figcaption>';
        echo '</figure></a>';
	  echo '</div>';
	echo '</section>'; 

    echo '<div class="clear"></div>';	
	  
	/* This is the third section of the main content on the page. It contains  
	3 testimonials given by customers who recommend the company. Their first name, 
	location and a quote attributed to them is displayed. */
	
	echo '<section>';
      echo '<h2 id="testHead">Testimonials</h2>'; 
	  echo '<div id="fullTest">';
        echo '<div class="testSection">';
		  echo '<img class="test" src="/PE7045/assets/images/test_1.png" alt="Picture of customer called Tom who gave a testimonial">';
		  echo '<div class="review">';
		    echo '<p>Tom<br>London</p>';
		    echo '<p class="quote">"The cottage was well prepared, comfortable and had everything we needed.
		    Its position on the side of the loch was simply beautiful."</p>';
		  echo '</div>';
		echo '</div>';
        echo '<div class="testSection">';
		  echo '<img class="test" src="/PE7045/assets/images/test_2.png" alt="Picture of customer called Mary who gave a testimonial">';
		  echo '<div class="review">';
		    echo '<p>Mary<br>Glasgow</p>';
		    echo '<p class="quote">I thought I had seen everything Scotland had to offer but I was blown away by our trip. 
		    The location of the boathouse was stunning and brought us right back to nature."</p>';
		  echo '</div>';
		echo '</div>';
        echo '<div class="testSection">';
		  echo '<img class="test" src="/PE7045/assets/images/test_3.png" alt="Picture of customer called Sarah who gave a testimonial">';
		  echo '<div class="review">';
		    echo '<p>Sarah<br>Manchester</p>';
		    echo '<p class="quote">"The activities were clearly designed to complement the setting and provide the complete wellness holiday. 
		    I left feeling recharged and enlightened, having enjoyed many new experiences."</p>';
	      echo '</div>';   
		echo '</div>';
	  echo '</div>';	
    echo '</section>';
  echo '</main>';

  echo '<div class="clear"></div>';
  
  createFooter(); 

  echo '</div>';
echo '</body>';
echo '</html>';
?>