<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$email = $_POST["email1"];
if(empty($email)) {
 $emailResponse = "<div class='w3-container w3-red'>
  <p>Please Enter your Email ID to Subscribe!</p>
</div> ";
}
else {
$email = test_input($email);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailResponse = "<div class='w3-container w3-red'>
  <p>Invalid Email Format!</p>
</div>  ";
}
else {
	$emailResponse = "<div class='w3-panel w3-green'>
  <p><strong>Subscribed!</strong> <span class='w3-hide-large'><br></span> Now You'll recieve our occasional Updates and Newletters</p>
</div>  ";
}
}
echo $emailResponse;
?>