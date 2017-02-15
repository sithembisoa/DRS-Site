<?php
// Check for empty fields

if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['subject'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
   $s = "";
	$name = strip_tags(htmlspecialchars($_POST['name']));
	$email_address = strip_tags(htmlspecialchars($_POST['email']));
	$subject = strip_tags(htmlspecialchars($_POST['subject']));
	$message = strip_tags(htmlspecialchars($_POST['message']));
	$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';
$errorMessage = 'There was an error while submitting the form. Please try again later';
   if($subject == 1)
   {
	   $s = "General Customer Service";
   }else if($subject == 2)
   {
	   $s = "Suggestions";
   }else if($subject == 3)
   {
	   $s = "Service Support";
   }
	try{
// Create the email and send the message
$to = 'dummy@noreply.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "$s";
$email_body = "Details:\n\nName: $name\n\nEmail: $email_address\n\n\nMessage:\n$message";
$headers = "From: noreply@drsgroup.co.za\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";   
mail($to,$email_subject,$email_body,$headers);
$responseArray = array('type' => 'success', 'message' => $okMessage);
}catch(\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}
   
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
    echo $responseArray['message'];	
}
?>
