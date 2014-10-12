//copy add doctor request choice to input textbox and submit form
$('#doctors-grid').on('click', 'table tbody tr .button-column a img', function() 
{		
  	var doctorID = $(this).parents('tr').attr("data-id"); 
  	$('#doctorIDTextfield').val(doctorID);
  	var data = $("#doctor-requests-form").serialize();
  	$.ajax({
	   		type: 'POST',
	   		data:data,
	   		success:function(){
	            $('#doctors-grid').yiiGridView('update', {
						data: $(this).serialize()
				});
				alert("Doctor Added");
	        },
  	});	 	
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
//update on image click
$('.imageLinkIcon').on('click', function()
{
	alert('testing');
});
