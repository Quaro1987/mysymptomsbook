$(document).ready(function() 
			{	
			$("#doctorSpecialtyFormInput").hide();
			//changing symptom category in the addSymptom page updates the gridview
			$('#categorySelectDropDown').change(function(){

				$('.search-form form').submit(function(){
					$('#symptoms-grid').yiiGridView('update', {
						data: $(this).serialize()
					});
				return false;
				});
			});
			//copy choice to input textboxes
			$('#symptomSelectDiv').on('click', 'table tbody tr', function() 
			{		
  				var firstColVal = $(this).find('td:first-child').text();
  				var secondColVal = $(this).find('td:nth-child(2)').text();		 	
 			 	$('#symptomToBeSearchedCode').val(firstColVal);
 			 	$('#symptomToBeSearchedTitle').val(secondColVal); 			 	
            });
			//redirect from successPage to addSymptom page
            $('#redirectToAddSymptomsPageButton').on('click', function()
            {
            	window.location.assign('/mysymptomsbook/index.php?r=symptomhistory/addSymptom')
            });
            //when userType dropdown is changed toggle the doctor specialty selection
            $('#userTypeSelectDropDown').change(function(){
            	if(document.getElementById("userTypeSelectDropDown").value==1)
            	{
            		$('#doctorSpecialtyFormInput').toggle();
            	}
				else if(document.getElementById("userTypeSelectDropDown").value==0)
				{
					$('#doctorSpecialtyFormInput').toggle();
					//set doctor specialty to null so a normal user won't input a doctor specialty
					document.getElementById("doctorSpecialtySelectDropDown").selectedIndex = 0;
				}
				return false;
			});
			//check if symptom and symptom date is selected before submitting form
			$("#symptomhistory-form").submit(function( event ) {
				if($('#symptomToBeSearchedTitle').val()=="")
				{
				alert('You need to select a symptom.');
				event.preventDefault();
				}
				else if($('#dateSymptomSeen').val()=="")
				{
				alert('You need to select the date the symptom was first seen on.');
				event.preventDefault();
				}			
			});
			//check if a doctor user has sellected a specialty
			$("#registration-form").submit(function( event ) {
				if(document.getElementById("userTypeSelectDropDown").value==1)
				{
					if(document.getElementById("doctorSpecialtySelectDropDown").value==null)
					{
					alert('You need to select a specialty, Doctor.');
					event.preventDefault();
					}
				}		
			});
			//copy add doctor request choice to input textboxe
			$('#doctors-grid').on('click', 'table tbody tr', function() 
			{		
  				var doctorID = $(this).attr("data-id"); 	
 			 	$('#doctorIDTextfield').val(doctorID);	 	
            });
});