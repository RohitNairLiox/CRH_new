<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$name = $_POST["name1"];
$email = $_POST["email1"];
$message = $_POST["message1"];
if(empty($name) || empty($email) || empty($message)) {
 $emailResponse = "<span class='w3-red w3-serif w3-large' style='padding:10px;'>Please fill in all the details to continue</span> ";
}
else {
$email = test_input($email);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailResponse = "<span class='w3-red w3-serif w3-large' style='padding:10px;'>Invalid Email ID</span> ";
}
else {
/*DB Start*/
$servername = "mysql.hostinger.in";
$username = "u207598627_rohit";
$password = "love2play";
$dbname = "u207598627_subsc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `contact_request` (`ID`, `Name`, `Email`, `Comment`) VALUES (NULL, '$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
	/*Email Start*/
	$emailResponse = "<span class='w3-green w3-serif w3-large' style='padding:10px;'><strong>Contact Requested!</strong> We'll get back to you shortly..</span>";
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
								<td>$name</td>
								<td>$email</td>
								<td>$message</td>
								</tr>
								</table>
								</body>
								</html>
								";
			       $headers = "MIME-Version: 1.0" . "\r\n";
			       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			       $headers .= "From: contact@crhmumbai.org";
			    mail($to,$subject,$content,$headers);
} else {
    $emailResponse = "<span class='w3-orange w3-serif w3-large' style='padding:10px;'><strong>Database Connection Error!</strong> Please try resubmitting the form.</span>";
}

$conn->close();

}
}
echo $emailResponse;
?>