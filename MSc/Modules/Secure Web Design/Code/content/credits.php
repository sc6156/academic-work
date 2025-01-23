<?php
/* This page lists the sources that were consulted when the website was
being built. This includes links to the images displayed across the site. Only signed 
in users can access this page. */

  require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
  startSession();
  checkAllowed(); // Check if the user is signed in
  echo createHead("Credits");

echo '<body>';
  echo '<div id="page_container">';
  
  createHeader(); 

  echo '<div class="clear"></div>';
  echo '<main id="creditsPage">';
    createStickyBar(); 
  
    echo '<h1 class="headings">Credits</h1>';
  
    echo '<p>The list below acknowledges the sources that were used to help create the coorie website. Please note, 
    references that were used to write the security report are included in that document and not in the list below.</p>';
  
    echo '<h3 class="creditsHead">Design and Accessibility</h3>';
  
    echo '<p>compose.ly. (n.d.). User Persona Template: Free Download and How-to Guide. [online] Available at: https://compose.ly/content-strategy/user-persona-guide [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Cornish, N. (2018). The Scottish wellness trend ‘Coorie’ sums up exactly how to live your best life. [online] Country Living. Available at: https://www.countryliving.com/uk/wellbeing/a23769694/coorie-scottish-trend/ [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Powazek, D. (2006). Home Page Goals. [online] A List Apart. Available at: https://alistapart.com/article/homepagegoals/ [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Produle (2009). MockFlow - Wireframe Tools, Prototyping Tools, UI Mockups, UX Suite. [online] Mockflow.com. Available at: https://mockflow.com/ [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>WebAIM (2019). WebAIM: Contrast Checker. [online] Webaim.org. Available at: https://webaim.org/resources/contrastchecker/ [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>www.iteracy.com. (n.d.). Web page size and layout. [online] Available at: https://www.iteracy.com/blog/post/size-and-layout-of-a-web-page [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>W3.org. (2013). The W3C Markup Validation Service. [online] Available at: https://validator.w3.org/#validate_by_upload [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>W3.org. (2009). The W3C CSS Validation Service. [online] Available at: https://jigsaw.w3.org/css-validator/#validate_by_upload [Accessed 8 Sep. 2022].</p>';
  
    echo '<h3 class="creditsHead">Images</h3>';
  
    echo '<p>Meeroona (2018). 10 Best Winter Retreats in Finland for a Magical Experience. [online] Travel Away. Available at: https://travelaway.me/cozy-winter-retreats-finland/ [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Nappy. (n.d.). Man smiling @michellclark | Black & Brown stock photos. [online] Available at: https://nappy.co/photo/12 [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Pexels (n.d.). Photo by Andrea Piacquadio on Pexels. [online] pexels.com. Available at: https://www.pexels.com/photo/freckled-face-3763188/ [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Pexels (n.d.). Photo by Mikhail Nilov on Pexels. [online] pexels.com. Available at: https://www.pexels.com/photo/an-elderly-woman-in-white-shirt-wearing-eyeglasses-8317651/ [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Unique Cottages (2019). Unique Cottages Scotland | Scottish Self-catering Holiday Cottages. [online] Unique-cottages.co.uk. Available at: https://www.unique-cottages.co.uk/ [Accessed 8 Sep. 2022]. (Please note, the vast majority of images were taken from this source and it is impractical to list them all.)</p>';
  
    echo '<p>Unsplash (n.d.). Photo by Annie Spratt on Unsplash. [online] unsplash.com. Available at: https://unsplash.com/photos/-xa-wN48fWo [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Unsplash (n.d.). Photo by Charles Lamb on Unsplash. [online] unsplash.com. Available at: https://unsplash.com/photos/yxfn7fXWtxU [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Unsplash (n.d.). Photo by eniko kis on Unsplash. [online] unsplash.com. Available at: https://unsplash.com/photos/V58katgrQPY [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Unsplash (n.d.). Photo by Himiway Bikes on Unsplash. [online] unsplash.com. Available at: https://unsplash.com/photos/ub_iu_vlQz8 [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Unsplash (n.d.). Photo by Jonny McKenna on Unsplash. [online] unsplash.com. Available at: https://unsplash.com/photos/MGwCJS-3Odw [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Unsplash (n.d.). Photo by Joshua Earle on Unsplash. [online] unsplash.com. Available at: https://unsplash.com/photos/NkEH30uoe8o [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Unsplash (n.d.). Photo by Kajetan Sumila on Unsplash. [online] unsplash.com. Available at: https://unsplash.com/photos/dWFhf0IHe_k [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Unsplash (n.d.). Photo by kike vega on Unsplash. [online] unsplash.com. Available at: https://unsplash.com/photos/F2qh3yjz6Jk [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Unsplash (n.d.). Photo by Max Hermansson on Unsplash. [online] unsplash.com. Available at: https://unsplash.com/photos/w5uE11FiAc8 [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Unsplash (n.d.). Photo by Pierre Jeanneret on Unsplash. [online] unsplash.com. Available at: https://unsplash.com/photos/ktAYbWnwFlU [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Unsplash (n.d.). Photo by Ricky Motton on Unsplash. [online] unsplash.com. Available at: https://unsplash.com/photos/HLqBO3TOzRk [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Unsplash (n.d.). Photo by River Fx on Unsplash. [online] unsplash.com. Available at: https://unsplash.com/photos/ZxzQGmH65W0 [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Unsplash (n.d.). Photo by Valentina Sotnikova on Unsplash. [online] unsplash.com. Available at: https://unsplash.com/photos/0Qa-WEc4y-M [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Unsplash (n.d.). Photo by Vidar Nordli-Mathisen on Unsplash. [online] unsplash.com. Available at: https://unsplash.com/photos/yJKb_4vjYwA [Accessed 8 Sep. 2022].</p>';
  
    echo '<h3 class="creditsHead">General Reference Material (Not Including Course Materials)</h3>';
  
    echo '<p>Adams, D. (2018). Secure Login System with PHP and MySQL. [online] CodeShack. Available at: https://codeshack.io/secure-login-system-php-mysql/ [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>CSS-Tricks. (2019). Adaptive Photo Layout with Flexbox. [online] Available at: https://css-tricks.com/adaptive-photo-layout-with-flexbox/ [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>freeCodeCamp.org. (2018). How to keep your footer where it belongs ? [online] Available at: https://www.freecodecamp.org/news/how-to-keep-your-footer-where-it-belongs-59c6aa05c59c/ [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Google Developers. (n.d.). The Maps Embed API quickstart. [online] Available at: https://developers.google.com/maps/documentation/embed/map-generator [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Jimmy (n.d.). Best HTML to PHP Converter Online tool. [online] codebeautify.org. Available at: https://codebeautify.org/html-to-php-converter [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Mehvish (2019). How to Crop an Image in Circle Shape in Paint 3D. [online] Guiding Tech. Available at: https://www.guidingtech.com/crop-image-circle-shape-paint-3d-windows/ [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>MyBib Contributors (2019). Harvard Referencing Generator – FREE – (updated for 2019). [online] MyBib. Available at: https://www.mybib.com/tools/harvard-referencing-generator [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Postcodes, U.P.L. and A.V.-I. (n.d.). The UK Postcode Format. [online] UK Postcode Lookup and Address Validation - Ideal Postcodes. Available at: https://ideal-postcodes.co.uk/guides/uk-postcode-format [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Stack Overflow. (n.d.). css - Responsive iframe (google maps) and weird resizing. [online] Available at: https://stackoverflow.com/questions/12676725/responsive-iframe-google-maps-and-weird-resizing [Accessed 10 Sep. 2022].</p>';
	
	echo '<p>Stack Overflow. (n.d.). html - Preventing text wrapping between header and paragraph. [online] Available at: https://stackoverflow.com/questions/35442874/preventing-text-wrapping-between-header-and-paragraph [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Stack Overflow. (n.d.). I wish to use a single header file in multiple pages using include header.php, but one bit of info in the header.php must differ slightly on each page. [online] Available at: https://stackoverflow.com/questions/58109406/i-wish-to-use-a-single-header-file-in-multiple-pages-using-include-header-php-b [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Stack Overflow. (n.d.). php - Validate if age is over 18 years old. [online] Available at: https://stackoverflow.com/questions/1812589/validate-if-age-is-over-18-years-old [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Stack Overflow. (n.d.). PHP Check if date is past to a certain date given in a certain format. [online] Available at: https://stackoverflow.com/questions/19031235/php-check-if-date-is-past-to-a-certain-date-given-in-a-certain-format [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>Stack Overflow. (n.d.). php - Checking for date range conflicts in MySQL. [online] Available at: https://stackoverflow.com/questions/8914457/checking-for-date-range-conflicts-in-mysql [Accessed 8 Sep. 2022].</p>';
 
    echo '<p>The Net Ninja (2019). HTML & CSS Crash Course Tutorial #8 - CSS Layout & Position. YouTube. Available at: https://www.youtube.com/watch?v=XQaHAAXIVg8 [Accessed 8 Sep. 2022].</p>';
 
    echo '<p>Tinypng.com. (2019). TinyPNG – Compress PNG images while preserving transparency. [online] Available at: https://tinypng.com/ [Accessed 13 Sep. 2022].</p>';

    echo '<p>Treating PHP delusions. (n.d.). Relative and absolute paths, in the file system and on the web server. [online] Available at: https://phpdelusions.net/articles/paths [Accessed 8 Sep. 2022].</p>';
	
	echo '<p>Tutorial Republic (2020). Creating a User Login System with PHP and MySQL - Tutorial Republic. [online] www.tutorialrepublic.com. Available at: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>W3Schools (2019). W3Schools Online Web Tutorials. [online] W3schools.com. Available at: https://www.w3schools.com/. (Please note, multiple pages were accessed from this site, but only the homepage and page below have been listed for the sake of brevity.</p>';
  
    echo '<p>www.w3schools.com. (n.d.). How To Create a Lightbox. [online] Available at: https://www.w3schools.com/howto/howto_js_lightbox.asp [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>www.youtube.com. (n.d.). PHP Tutorial | Easiest Way To Redirect To Last Visited Page After Login | No Session Or Database. [online] Available at: https://www.youtube.com/watch?v=BHTHzu0-zIY [Accessed 8 Sep. 2022].</p>';
  
    echo '<p>www.youtube.com. (n.d.). Simple Image Lightbox Tutorial. [online] Available at: https://www.youtube.com/watch?v=uKVVSwXdLr0 [Accessed 8 Sep. 2022].</p>';
  
  echo '</main>';

  echo '<div class="clear"></div>';
  
  createFooter(); 

  echo '</div>';
echo '</body>';
echo '</html>';
?>