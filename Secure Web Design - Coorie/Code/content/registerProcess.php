<?php
/* This page takes the form data submitted by a user on register.php, 
validates it, then inserts it into the database if there are no errors. If 
there are errors, these are displayed along with a button which clears them 
and redisplays the form when pressed. */

require_once($_SERVER['DOCUMENT_ROOT']."/PE7045/assets/scripts/functions.php");
$conn = getConnection();
startSession();
echo createHead("Registering Process");

echo '<body>';
  echo '<div id="page_container">';
  
  createHeader(); 

  echo '<div class="clear"></div>';
  
  /* Main programme logic which utilises the functions lower down in the script called 
  validate_form(), show_errors() and process_form(). Either the errors are displayed 
  and the user is asked to try again, or the form data is entered into the database 
  and a confirmation message is displayed, before redirection to the sign in page. */
    
  list($input, $errors) = validate_form($conn);
  
  if ($errors) {
	echo show_errors($input, $errors, $conn);
  } 
  else {
    echo process_form($input, $conn);
  }
  mysqli_close($conn);
	
  createFooter(); 

  echo '</div>';
echo '</body>';
echo '</html>';


function validate_form($conn) {

  $errors = array();
  $input = array();
  
  /* Get each parameter value from the request stream and using ternary if operators, check each parameter 
  to see if it was set. If it is, store it in a variable. Otherwise store a value of null in the variable */
  $input['fname'] = array_key_exists('fname', $_REQUEST) ? $_REQUEST['fname'] : null;
  $input['surname'] = array_key_exists('surname', $_REQUEST) ? $_REQUEST['surname'] : null;
  $input['dob'] = array_key_exists('dob', $_REQUEST) ? $_REQUEST['dob'] : null;
  $input['postcode'] = array_key_exists('postcode', $_REQUEST) ? $_REQUEST['postcode'] : null;
  $input['address1'] = array_key_exists('address1', $_REQUEST) ? $_REQUEST['address1'] : null;
  $input['address2'] = array_key_exists('address2', $_REQUEST) ? $_REQUEST['address2'] : null;
  $input['email'] = array_key_exists('email', $_REQUEST) ? $_REQUEST['email'] : null;
  $input['password'] = array_key_exists('password', $_REQUEST) ? $_REQUEST['password'] : null;
  $input['passwordCheck'] = array_key_exists('passwordCheck', $_REQUEST) ? $_REQUEST['passwordCheck'] : null;

  // Remove any whitespace entered at start and end of each string
  $input['fname'] = trim($input['fname']);
  $input['surname'] = trim($input['surname']);
  $input['dob'] = trim($input['dob']);
  $input['postcode'] = trim($input['postcode']);
  $input['address1'] = trim($input['address1']);
  $input['address2'] = trim($input['address2']);
  $input['email'] = trim($input['email']);
  $input['password'] = trim($input['password']);
  $input['passwordCheck'] = trim($input['passwordCheck']);
  
  // Validation checks - 'fname' variable 
  if (empty($input['fname'])) {
    $errors[] = "<p>You have not entered a first name</p>\n";
  }
  else if (!preg_match("/^[a-zA-Z-' ]*$/", $input['fname'])) {
    $errors[] = "<p>Only letters, hyphens, apostrophes and spaces are permitted in a first name</p>\n";
  }
  
  // Validation checks - 'surname' variable 
  if (empty($input['surname'])) {
    $errors[] = "<p>You have not entered a surname</p>\n";
  }
  else if (!preg_match("/^[a-zA-Z-' ]*$/", $input['surname'])) {
    $errors[] = "<p>Only letters, hyphens, apostrophes and spaces are permitted in a surname</p>\n";
  } 
  
  // Validation checks - 'dob' variable 
  if (empty($input['dob'])) {
    $errors[] = "<p>You have not entered a date of birth</p>\n";
  }
  // dateCheck() checks that an html date is valid (see commonFunctions.php) 
  else if (!dateCheck($input['dob'])){  // User defined function checks for a valid date 
    $errors[] = "<p>You have not entered a valid date in the format dd-mm-yyyy</p>\n";
  }
  else if (time() < strtotime('+18 years', strtotime($input['dob']))) {  
    $errors[] = "<p>You must be at least 18 years old to register</p>\n";
  }
  
  // Validation checks - 'postcode' variable 
  if (empty($input['postcode'])) {
    $errors[] = "<p>You have not entered your postcode</p>\n";
  }  
  else if (!preg_match("/^[a-zA-Z]{1,2}([0-9]{1,2}|[0-9][a-zA-Z])\s*[0-9][a-zA-Z]{2}$/", $input['postcode'])) { 
    $errors[] = "<p>You have not entered a valid postcode it should be in the format AA9A 9AA, A9A 9AA, A9 9AA, A99 9AA, AA9 9AA OR AA99 9AA</p>\n";    
  }

  // Validation checks - 'address1' variable 
  if (empty($input['address1'])) {
    $errors[] = "<p>You have not entered the first line of your address</p>\n";
  }
  else if (!preg_match("/^[0-9a-zA-Z-' ]*$/", $input['address1'])) {
    $errors[] = "<p>Only numbers, letters, hyphens, apostrophes and spaces are permitted in the first line of the address</p>\n";   
  }
  
  // Validation checks - 'address2' variable 
  if (empty($input['address2'])) {
    $errors[] = "<p>You have not entered the second line of your address</p>\n";
  }  
  else if (!preg_match("/^[0-9a-zA-Z-' ]*$/", $input['address2'])) {
    $errors[] = "<p>Only numbers, letters, hyphens, apostrophes and spaces are permitted in the second line of the address</p>\n";      
  }

  // Validation checks - 'email' variable 
  if (empty($input['email'])) {
    $errors[] = "<p>You have not entered an email address</p>\n";
  }  
  else if(!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "<p>The text you have entered is not in the format of an email address</p>\n";
  }
  // Check if the email address entered has already been registered 
  else {
    $emailCheck = "SELECT * FROM customers WHERE email_address = ?";
    
    if ($stmt = mysqli_prepare($conn,$emailCheck)) {
      mysqli_stmt_bind_param($stmt, "s", $input['email']);
      $queryresult = mysqli_stmt_execute($stmt);
        
        if($queryresult) {
          mysqli_stmt_store_result($stmt);
         
          if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors[] = "<p>The email address you entered is already registered - please go to the sign in page</p>\n";
          }
        }
    }       
  }   

  // Validation checks - 'password' variable 
  if (empty($input['password'])) {
    $errors[] = "<p>You have not entered a password</p>\n";
  }  
  else {
    $uppercase = preg_match('@[A-Z]@', $input['password']);
    $lowercase = preg_match('@[a-z]@', $input['password']);
    $number = preg_match('@[0-9]@', $input['password']);
    $specialChars = preg_match('@[^\w]@', $input['password']);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($input['password']) < 9) {      
      $errors[] = "<p>Your password needs to be at least 9 characters long and include at least one of the following: 
      a capital letter, lower case letter, number and special character</p>\n";
    } 
  }

  // Validation checks - 'passwordCheck' variable 
  if (empty($input['passwordCheck'])) {
    $errors[] = "<p>You have not reentered your password</p>\n";
  }  
  else if($input['passwordCheck'] !== $input['password']) {
    $errors[] = "<p>The passwords that you have entered do not match</p>\n";    
  }
  
  return array($input,$errors);
} 
  
/* In this function, we pass in the array of error messages, loop through it and concatenate
   all the messages together. A button is also added which allows the customer to remove the errors
   using a javascript function called removeErrors(). */
   
function show_errors($input, $errors, $conn) {
    $error_output = "<div id=\"errormsg\"><p>The following problem(s) occurred when trying to process your request:</p><br><ul> ";
    foreach ($errors as $currentErrorMessage) {
      $error_output .= "<li>".$currentErrorMessage . "</li>\n";
    }
    $error_output .= "<br></ul><p>Please try again.</p>\n";
	$error_output .= "<button id=\"errButton\" onclick=\"removeErrors()\">Remove errors & redisplay form</button></div>";
    $error_output .= add_register_form($input, $conn, 'registerProcess.php'); 
    
    return $error_output;
}

/* This function will concatenate the HTML and PHP needed to re-display the form with
the user's previously chosen data pre-populated in the form fields */

function add_register_form($input, $conn, $actionScript) {
    $formOutput = <<<FORM
    <main>
      <div id="registerBox2">
        <h1 class="headings" id="reghead">Register for an Account</h1>
  
        <form id="reg" method="POST" action="$actionScript">
          <div id="fname">
            <label for="fname">First Name</label>
              <input class="reginputs" type="text" name="fname" value="{$input['fname']}">
          </div>      
          <div id="surname">
            <label for="surname">Surname</label>
              <input class="reginputs" type="text" name="surname" value="{$input['surname']}">
          </div>          
          <div id="dob">
            <label for="dob">Date of Birth</label>
              <input class="reginputs" type="date" name="dob" value="{$input['dob']}">
          </div>                  
          <div id="postcode">
            <label for="postcode">Postcode</label>
              <input class="reginputs" type="text" name="postcode" value="{$input['postcode']}">
          </div>              
          <div id="address1">
            <label for="address1">First Line of Address</label>
              <input class="reginputs" type="text" name="address1" value="{$input['address1']}">
          </div>    
          <div id="address2">
            <label for="address2">Second Line of Address</label>
              <input class="reginputs" type="text" name="address2" value="{$input['address2']}">
          </div>    
          <div id="email">
            <label for="email">Email Address</label>
              <input class="reginputs" type="email" name="email" value="{$input['email']}">
          </div>    
          <div id="password">
            <label for="password">Password</label>
              <input class="reginputs" type="password" name="password">
          </div>    
          <div id="passwordCheck">
            <label for="passwordCheck">Reenter Password</label>
              <input class="reginputs" type="text" name="passwordCheck">
          </div>    
      
          <input type="submit" id="regbutton" name="regbutton" value="Register">    
        </form> 
    
        <p id="exAcc">Already have an account?<br><a id="signinlink" href="sign_in.php">Sign in here</a></p>
      </div>
    </main>
FORM;

return $formOutput;
}

/*In this function, we pass into the array the validated input values and use them in
a prepared statement to insert a record into the database. */

function process_form($input, $conn) { 

  $insertSQL = "INSERT INTO customers (email_address, password_hash, customer_forename, customer_surname, 
  customer_postcode, customer_address1, customer_address2, date_of_birth) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
  
  // Store a hash of the password for insertion into the database, not the password itself 
  $passwordHash = password_hash($input['password'], PASSWORD_DEFAULT);
  
  // Convert dob variable string into format accepted by MySQL using user-defined function
  $dob = formatDate($input['dob']);

  if ($stmt2 = mysqli_prepare($conn,$insertSQL)) {
    
    //Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt2, "ssssssss", $input['email'], $passwordHash, $input['fname'], $input['surname'], 
    $input['postcode'], $input['address1'], $input['address2'], $dob);
    
    $queryresult2 = mysqli_stmt_execute($stmt2);
    if (!$queryresult2) {
      echo "<p>We are unable to register you at the moment due to a technical issue. Please accept our apologies and try again later.</p>";
      header('Refresh: 4; url=register.php');
    }
    else {
      echo "<p>You have now been registered with coorie.</p>\n\n";
      echo "<p>You are being redirected to the Sign In page, where you can login and start booking accommodation.</p>";
      header('Refresh: 2; url=sign_in.php');
    }
  }
}
?>