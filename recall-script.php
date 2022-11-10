<?php 
	$to = "$email";
	$subject = "Medication Recall";

	// In php 7.2 and newer versions we can use an array to set the headers.
	$headers = array(
		"MIME-Version" => "1.0",
		"Content-Type" =>"text/html;charset=UTF-8",
		"From" =>"mp797@njit.edu",
		//"Reply-To" =>"dennis@mail.com"
		echo "Please do not reply to this email!";
	);

	$name = "People Who Care";

	ob_start();
	include("recall-mail-template.php");
	$message = ob_get_contents();
	ob_get_clean();

	$send = mail($to, $subject, $message, $headers);

	echo ($send ? "Mail is send" : "There was an error" );



