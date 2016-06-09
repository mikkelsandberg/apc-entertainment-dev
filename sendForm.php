<html>
<head>
	<title>Thank you for contacting APC Entertainment</title>
</head>
<body>
<?php 
	$recipient = 'mikkel.h.sandberg@gmail.com';
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$body = $_POST['body'];
	// For errors and confirmation message
	$messages = array();

	// Allow only reasonable real names
	if (!preg_match("/^[\w\ \+\-\'\"]+$/", $name)) {
		$messages[] = "The name field must contain only alphabetical characters, numbers, spaces, and limited punctuation. We apologize for any inconvenience.";
	}

	// CAREFUL: don't allow hackers to sneak line breaks and additional headers into the message and trick us into spamming for them!
	$subject = preg_replace('/\s+/', ' ', $subject);
	// Make sure the subject isn't blank afterwards!
	if (preg_match('/^\s*$/', $subject)) {
		$messages[] = "Please specify a subject for your message.";
	}

	// Make sure the message has a body
	if (preg_match('/^\s*$/', $body)) {
		$messages[] = "Your message was blank. Did you mean to say something?"; 
	}

	if (count($messages)) {
    // There were problems, so tell the user and
    // don't send the message yet
    foreach ($messages as $message) {
      echo("<p>$message</p>\n");
    }
    echo("<p>Click the back button and correct the problems. Then click Send Your Message again.</p>");
  } else {
    // Send the email - we're done
		mail($recipient,
      $subject,
      $body,
      "From: $name <$email>\r\n" .
      "Reply-To: $name <$email>\r\n"); 
    echo("<p>Your message has been sent. Thank you!</p>\n");
  }
?>
</body>
</html>