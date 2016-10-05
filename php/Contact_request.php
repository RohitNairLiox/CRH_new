<?php
	$Name = $_POST['Name'];
	$Email = $_POST['Email'];
	$Message = $_POST['Message'];

		if (empty($Name) || empty($Email) || empty($Message)) {

		}
		else{
			       $to = "sarathchandran@crhmumbai.org, sarathvalia@gmail.com";
			       $subject = "Requesting contact from site CRH Mumbai";
			       $content = "
								<html>
								<head>
								<title>HTML email</title>
								</head>
								<body>
								<p>Contact Request for CRH Mumbai!</p>
								<table>
								<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Message</th>
								</tr>
								<tr>
								<td>$Name</td>
								<td>$Email</td>
								<td>$Message</td>
								</tr>
								</table>
								</body>
								</html>
								";
			       $headers = "MIME-Version: 1.0" . "\r\n";
			       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			       $headers .= "From: contact@crhmumbai.org";
			    mail($to,$subject,$content,$headers);
				header("Location:http://www.devrohitnair.tk/contact_requested.html");
		}
?>