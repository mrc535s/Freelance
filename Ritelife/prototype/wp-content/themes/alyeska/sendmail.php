<?php
/*

==========================================
== PHP Contact Script - by Jason Bobich ==
==========================================

This script is intended for use with Wordpress
themes utilizing the Jaybich Wordpress Framework.

Customizations:
On your theme options page, you can add up to three
additional fields to your contact form. However, if
you would like to add fields beyond that, you can do
so by adding them manually into the HTML code in
template_contact.php. Any form fields you add to
template_contact.php will automatically be registered
with this script and sent out in the email. Just make
sure you give any manually added fields a unique field
name. 

Example:
<input type="text" name="ENTER SOMETHING UNIQUE HERE" value="" class="required">

THERE IS NO NEED TO EDIT THIS FILE.

*/

//Check to make sure a spam bot didn't submit the form
if($_POST['checking']) {
    die("You dipped your hand in the honeypot!");
}

//Hidden elements
$to = str_replace("[ at ]", "@", $_POST['myemail']); //Email where the message is being sent
$blog_name = $_POST['mysitename']; //Name of your site

//Visible form elements
$name = $_POST['name']; 
$email = $_POST['email']; 
$message_text = $_POST['message'];

//Retrieve fields added through the theme options page.
$user_fields = array(	

	//Field 1
	array(
		'name' => $_POST['user-field-1-name'],
		'value' => $_POST['user-field-1']
	),
	
	//Field 2
	array(
		'name' => $_POST['user-field-2-name'],
		'value' => $_POST['user-field-2']
	),
	
	//Field 3
	array(
		'name' => $_POST['user-field-3-name'],
		'value' => $_POST['user-field-3']
	),

);

//Add fields added through theme options page to Email
$custom = '';
foreach ($user_fields as $key => $field) {
	
	if($field['value']) {
	
		$custom.= $field['name'] . ": " . $field['value'] ."<br /> \n";
	
	}
	
}

//Declare which field naems we're already using.
$currently_active = array(	'name',
							'email',
							'message',
							'myemail',
							'mysitename',
							'submitted',
							'checking',
							'user-field-1',
							'user-field-1-name',
							'user-field-2',
							'user-field-2-name',
							'user-field-2',
							'user-field-3',
							'user-field-3-name'
							);

//If you add any fields manually to tempate_contact.php, this will grab them and send them in the email.
$extras = '';
foreach ($_POST as $key => $field) {

	if(!in_array($key,$currently_active)) {
		$extras.= $key . ": " . $field . "<br /> \n";
	}

}

//Setting up email
$subject = "New Message from $blog_name";

$message = "New message from  $name <br/>
			Mail: $email<br />
			$custom
			$extras
			Message: $message_text";

$header  = 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$header .= 'From:'. $email . " \r\n";
			
$sent = mail($to, $subject, $message, $header);

//For debugging
if($sent) {
	echo "mail sent";
} else {
	echo "error";
}

?>