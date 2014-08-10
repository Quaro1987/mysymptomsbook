$(document).ready(function(){	
			//hides doctorSpecialty when page loads
            $("#doctorSpecialtyFormInput").hide();
            //if the selection of userType is doctor it shows the input used for errors in form filling
			if(document.getElementById("userTypeSelectDropDown").value==1)
            {
            	$('#doctorSpecialtyFormInput').show();
            }
});
			

			
            //when userType dropdown is changed toggle the doctor specialty selection
            $('#userTypeSelectDropDown').change(function(){
            	if(document.getElementById("userTypeSelectDropDown").value==1)
            	{
            		$('#doctorSpecialtyFormInput').show();
            	}
				else if(document.getElementById("userTypeSelectDropDown").value==0)
				{
					$('#doctorSpecialtyFormInput').hide();
					//set doctor specialty to 0 so a normal user won't input a doctor specialty
					document.getElementById("doctorSpecialtySelectDropDown").selectedIndex = 0;
				}
				return false;
			});
			
           