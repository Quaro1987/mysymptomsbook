//copy add doctor request choice to input textbox
$('#doctors-grid').on('click', 'table tbody tr', function() 
{		
  	var doctorID = $(this).attr("data-id"); 	
  	$('#doctorIDTextfield').val(doctorID);	 	
});
//changing doctor specialty in the find a doctor page updates the gridview
$('#specialtySelectDropDown').change(function(){
	$('.search-form form').submit(function(){
		$('#doctors-grid').yiiGridView('update', {
			data: $(this).serialize()
		});
	return false;
	});
});