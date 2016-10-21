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
      $hash = md5(mt_rand(1,1000));
      $sql = "INSERT INTO `subscribers` (`ID`, `Email`, `hash`, `verified`) VALUES (NULL, '$email', '$hash', 'No')";
      $urlString = "http://crhmumbai.org/verify.php?email=" . $email . "&key=" . $hash;
        if ($conn->query($sql) === TRUE) {

              /*Email Start*/
         $emailResponse = "<div class='w3-panel w3-green'><p><strong>Subscribed!</strong> <span class='w3-hide-large'><br></span> We have send you an email please follow that link to confirm! </p></div>";

            $to = $email;
             $subject = "Verify Email Address - CRH Mumbai";
             $content = "
                <html>
                  <head>
                      <title>Email Verfication</title>
                  </head>
                  <body>
                             <div style='background:#f8f8f8;font-size:14px;font-weight:normal;text-align:left;letter-spacing:0.4px'>
                        <center style='margin:0 auto;padding-top:30px;height:80px;width:85%;max-width:600px;background:#f8f8f8'>           
                        <h1 style='float:left; color:#D4D4D4; font-family:Comic Sans MS, cursive, sans-serif;' height='28'>CRH Mumbai</h1>    
                        </center>    
                        <center style='width:85%;max-width:600px;height:auto;margin:0 auto;text-align:left;padding-bottom:50px'>        
                        Hi,<br><br>You have subscribed to recieve our Newletter.<br><br>Please visit the following link
                      to verify your email ID:<br><br>
                      <a href='".$urlString."' target='_blank'>http://crhmumbai.org/<wbr>verify.php?key=<wbr>$hash</a>
                      <br><br><br>
                      If you need any assistance, please contact us at <a style='text-decoration:none' href='mailto:support@crhmumbai.org?subject=Reset+Subscription' target='_blank'>support@crhmumbai.org </a>
                      <br><br>
                      Thank you for choosing
                      to hear from us.
                      <br><br><br>        
                      Best regards,<br><br>
                      Sarathchandran,<br>
                      Committee for the Right to Housing.      
                       <br><br><br><br>      
                         <center style='border-top:1px solid #e1e1e1;background:#f8f8f8;text-align:left'>       
                          <p style='color:#888;font-size:10px!important;margin-top:4px;max-width:600px;float:left'>Copyright © CRH Mumbai. All Rights
                        Reserved.</p>      
                        </center>    
                       </center>  
                      </div>
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
}
echo $emailResponse;
?>