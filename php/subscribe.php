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
// Check if user exists 
$query = "SELECT `Email` FROM `subscribers` WHERE `Email`= '$email'";
$query = $conn->query($query);

    if(mysqli_num_rows($query) != 0) {
        $emailResponse = "<div class='w3-panel w3-blue'><p><strong>User Exists!</strong> <span class='w3-hide-large'><br></span> You have already subscribed to our Newletter.</p></div>";
    }
    else{
      $sql = "INSERT INTO `subscribers` (`ID`, `Email`) VALUES (NULL, '$email')";

        if ($conn->query($sql) === TRUE) {

              /*Email Start*/
         $emailResponse = "<div class='w3-panel w3-green'><p><strong>Subscribed!</strong> <span class='w3-hide-large'><br></span> Now You'll recieve our occasional Updates and Newletters</p></div>";

            $to = "sarathchandran@crhmumbai.org, sarathvalia@gmail.com";
                $subject = "Subscribers list - CRH Mumbai";
                $content = "Subscribers Email ID - " . $email;
                $headers = "From: contact@crhmumbai.org";
             mail($to,$subject,$content,$headers);

          } else {
             $emailResponse = "<span class='w3-orange w3-serif w3-large' style='padding:10px;'><strong>Database Connection Error!</strong> Please try resubmitting the form.</span>";
         }

          $conn->close();
    }



}
}
echo $emailResponse;
?>