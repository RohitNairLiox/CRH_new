<?php
	$Email = $_POST['Email'];

	if(empty($Email)){

	}
	else{
		$to = "sarathchandran@crhmumbai.org, sarathvalia@gmail.com";
		$subject = "Subscribers list - CRH Mumbai";
		$content = "Subscribers Email ID - " . $Email;
		$headers = "From: contact@crhmumbai.org";
	mail($to,$subject,$content,$headers);
	header("Location:http://www.devrohitnair.tk/contact_requested.html");
	}
?>