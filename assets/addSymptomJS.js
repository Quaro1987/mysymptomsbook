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