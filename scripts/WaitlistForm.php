  <?php
  
  $privatekey = "6LdzUGcfAAAAAIF4o2CxRhRPPEyxAWICfFC4xiky";
  $recaptcha = $_POST['g-recaptcha-response'];
  $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
          . $privatekey . '&response=' . $recaptcha;
		  
  $response = file_get_contents($url);
  
  $response = json_decode($response);

  if (!$response->success) {
    echo '<script>alert("Google reCAPTACHA verified")</script>';
  } else {
    // Successful verification
	
	date_default_timezone_set('America/Los_Angeles');
	
	$handle = fopen("../data/waitlist.csv", "a+");
	array_pop($_POST);
	array_pop($_POST);
	
	while (!feof($handle)) {
		
		$line = fgetcsv($handle);
		
		if ($line[1] == $_POST['email']) {
			fclose($handle);
			exit("Email already exists in waitlist!");
		}
	}
	
	$_POST["date"] = date("Ymd");
	$_POST["time"] = date("H:i:s");
	
	fputcsv($handle, $_POST);
	fclose($handle);
	
	// Compose a simple HTML email message
	$to = $_POST['email'];
	$subject = 'Test';
	$from = 'webcontactform@saddlebrookcourttechnologies.com';
	
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 
	// Create email headers
	$headers .= 'From: '.$from."\r\n".
		'Reply-To: '.$from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
	
	$message = '<html><body>';
	$message .= '<h1 style="color:#f40;">Hi!</h1>';
	$message .= '<p style="color:#080;font-size:18px;">How are you?</p>';
	$message .= '</body></html>';
	 
	// Sending email
	if(mail($to, $subject, $message, $headers)){
		echo 'Your mail has been sent successfully.';
	} else{
		echo 'Unable to send email. Please try again.';
	}
	
	$URL="https://saddlebrookcourttechnologies.com/Waitlist-Submission.html";
	echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
  }
  ?>