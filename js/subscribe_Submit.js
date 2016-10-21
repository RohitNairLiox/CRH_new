    $("#subscribe_Form").submit(function(e){
        e.preventDefault();

               var emailId = $('#sub_Email').val();
               emailId = emailId.toLowerCase();
               var atpos = emailId.indexOf("@");
		var dotpos = emailId.lastIndexOf(".");
        	/*Edit here*/
        	if(emailId == ""){
        		$('#resultDisplay').html("<div class='w3-container w3-red'><p>Please Enter your Email ID to Subscribe !</p></div>");
        	}
		else if(atpos<1 || dotpos<atpos+2 || dotpos+2>=emailId.length) {
			$('#resultDisplay').html("<div class='w3-container w3-red'><p>Invalid Email ID!</p></div>");
		}
        else{
 $.ajax({
        type: 'POST',
        url: 'php/subscribe.php',
        data: { email1: emailId},
        success: function(response) {
            $('#resultDisplay').html(response);
        }
    });
		 setTimeout(function(){
		    document.getElementById("subscribe_Form").reset();
		}, 1000);
				}
					});
					
					
					
