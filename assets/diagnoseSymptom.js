function ajaxSubmitContactForm(ajaxUrl)
{
	if(($("#emailSubjectField").val()=='')||($("#emailBodyTextArea").val()==''))
	{
		alert('You must provide a subject and a main body text for the email.');
	}
	else
	{
		var data = $("#contactPatientform").serialize();
	
	    $.ajax({
	   		type: 'POST',
	    	url: ajaxUrl,
	   		data:data,
			success:function(){
				alert("Message succesfully sent.");
	            $('#contactPatientDiv').hide(50, "swing");
	        },
	   		error: function() {
	            alert("Error occured. Please try again.");
	    	},
	    	dataType: 'html'
  		});
	}
}

//reveal patient contact form div
function revealPatientContactForm()
{
	$('#contactPatientDiv').toggle(500, "swing");
}

//function to set the class of the button for a selected symptom
function setSelectedFlagButton(flagValue)
{
	switch(flagValue)
	{
		case 1:
			$("#lowDangerButton").addClass("selectedFlag");
			break;
		case 2:
			$("#mildDangerButton").addClass("selectedFlag");
			break;
		case 3:
			$("#highDangerButton").addClass("selectedFlag");
			break;
	}
}

function lowFlagSelected()
{
	//remove class from previous selection
	$(".selectedFlag").removeClass("selectedFlag");
	//copy flag value to hidden text field
	$("#symptomFlagTextField").val("1");
	//change selected buttons color
 	$("#lowDangerButton").addClass("selectedFlag");
}
function mildFlagSelected()
{
	//remove class from previous selection
	$(".selectedFlag").removeClass("selectedFlag");
	//copy flag value to hidden text field
	$("#symptomFlagTextField").val("2");
	//change selected buttons color
 	$("#mildDangerButton").addClass("selectedFlag");
}
function highFlagSelected()
{
	//remove class from previous selection
	$(".selectedFlag").removeClass("selectedFlag");
	//copy flag value to hidden text field
	$("#symptomFlagTextField").val("3");
	//change selected buttons color
 	$("#highDangerButton").addClass("selectedFlag");
}
