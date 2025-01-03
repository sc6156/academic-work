/* The code below provides the funcitonality for the image 
lightbox/modal on each accommodation page.*/

// Open the Modal
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

// Close the Modal
function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

// Next/previous controls
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  try{
    var i;
    var slides = document.getElementsByClassName("mySlides");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
	// The line below creates an error in the console as slides[slideIndex-1] doesn't yet exist
	// Try-catch has been used to handle the error and do nothing in response
    slides[slideIndex-1].style.display = "block"; 
  }
  catch{}
}

/////////////////////////////////////////////////////////////

/* This function allows the user to remove any errors generated in 
the registerProcess.php by clicking a button. At the same time, it 
displays the registration form with the previously entered data by the 
user. The form is hidden when the errors are initially displayed. */

function removeErrors() {
  const element = document.getElementById("errormsg");
  element.remove();
  
  var x = document.getElementById("registerBox2");
  x.style.display = "block";
}