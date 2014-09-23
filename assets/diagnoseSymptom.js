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
