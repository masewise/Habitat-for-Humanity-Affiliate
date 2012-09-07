<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}

$formType = $_POST['formType'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipCode = $_POST['zipCode'];
$email = $_POST['email'];
$homePhone = $_POST['homePhone'];
$cellPhone = $_POST['cellPhone'];

//Validate first
if(empty($firstName)||empty($lastName)) 
{
    echo "Please enter your first and last name!";
    exit;
}

if(IsInjected($email))
{
    echo "The email you entered is incorrectly formatted!";
    exit;
}

$to = 'pulaskikyhabitat@gmail.com'; 
$subject = $formType; 
$headers = 'From: no-reply@pulaskikyhabitat.org' . "\r\n" . 
				  'Reply-To: no-reply@pulaskikyhabitat.org' . "\r\n" . 
				  'X-Mailer: PHP/' . phpversion(); 
				  
$message = 'First Name: ' 		. "\r\t" . $firstName 		. "\r\r" . 
				   'Last Name: ' 		. "\r\t" . $lastName 		. "\r\r" . 
				   'Address: ' 			. "\r\t" . $address 			. "\r\r" . 
				   'City: ' 				. "\r\t" . $city 				. "\r\r" . 
				   'State: '				. "\r\t" . $state 				. "\r\r" . 
				   'Zip Code: ' 		. "\r\t" . $zipCode 			. "\r\r" . 
				   'Email: ' 			. "\r\t" . $email 				. "\r\r" . 
				   'Home Phone: ' 	. "\r\t" . $homePhone 	. "\r\r" . 
				   'Cell Phone: ' 		. "\r\t" . $cellPhone;
				   
echo (mail($to, $subject, $message, $headers)) ? header('Location: success.html') : 'An error has occurred, please try again later!'; 

// Function to validate against any email injection attempts
function IsInjected($str)
{
	$injections = array('(\n+)',
								  '(\r+)',
								  '(\t+)',
								  '(%0A+)',
								  '(%0D+)',
								  '(%08+)',
								  '(%09+)'
								 );
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	
	if(preg_match($inject,$str))
	{
		return true;
	}
	
	else
	{
		return false;
	}
}
   
?> 