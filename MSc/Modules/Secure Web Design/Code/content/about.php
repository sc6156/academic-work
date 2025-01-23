<?php
// This page simply provides details about the company and its ethos

require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
startSession();
echo createHead("About coorie");

echo '<body>';
  echo '<div id="page_container">';
  
  createHeader(); 

  echo '<div class="clear"></div>';
  echo '<main>';
    createStickyBar(); 

    echo '<h1 class="headings">What does \'coorie\' mean?</h1>';
	
    echo '<p id="about_para1">Coorie is a Scottish word that traditionally means to snuggle or cuddle and is derived from the old Gaelic word ‘còsagach’. 
    Recently, it has taken on a new meaning and now also represents a way of living, much like the Danish concept of Hygge.</p>';
	
    echo '<p>According to its contemporary meaning, coorie is about finding happiness by embracing the Scottish outdoors, slowing down 
    and taking pleasure from the smaller things in life. <a class="links" href="https://www.countryliving.com/uk/wellbeing/a23769694/coorie-scottish-trend/">
    Country Living</a> states that this happiness could be found in:</p>';
	
    echo '<p id="quote">“… wild loch swimming, bracing walks in the Highlands or spending a Sunday smoking your own food, then wrapping yourself up 
    in a Tartan blanket in front of a roaring fire in a country pub to \'blether\' or chit-chat until the stars come out.”</p>';
	
    echo '<img id="about_img" src="/PE7045/assets/images/about_img.jpg" alt="Picture of a woodcabin with a roaring fire in the middle of the room and snow outside">';
  
    echo '<h1 class="headings" id="aboutHead2">How can I achieve coorie?</h1>';
	
    echo '<p>Although modern living makes it difficult to implement coorie, its benefits can be achieved during a holiday or short break. 
    The accommodation offered by coorie is set amongst Scotland’s hills, mountains, valleys, forests and waterways, which provide our 
    guests with the opportunity to escape the day-to-day pressures of life and retreat to nature.</p>';
  
    echo '<p id="aboutBottom">During their stay, guests can tend to their physical and mental wellbeing by exploring the beautiful surroundings and taking part 
    in the various activities on offer. Of course, relaxation, doing very little and enjoying a bit of ‘me time’ is also strongly encouraged!</p>';
		
  echo '</main>';

  echo '<div class="clear"></div>';
  
  createFooter(); 

  echo '</div>';
echo '</body>';
echo '</html>';
?>