$('#symptomSelectDiv').hide();

$(document).ready(function() 
			{
			//initialize symptoms array
			var symptomsList=[];

			$('#categorySelectDropDown').change(function()
			{
				$('#symptomSelectDiv').show();
				
				$('#symptoms-grid').yiiGridView('update', 
				{
					data: $(this).serialize()
				});
				return false;
			});

			//copy choice to input textboxes
			$('#symptomsSelectGrid table tbody tr').click(function() 
			{		
  				var firstColVal = $(this).find('td:first-child').text();
  				var secondColVal = $(this).find('td:nth-child(2)').text();		 	
 			 	$('#symptomToBeSearchedCode').val(firstColVal);
 			 	$('#symptomToBeSearchedTitle').val(secondColVal);
            });

			$('#addSymptom').click(function()
			{
				//create new symptom in javascript
				var newSymptom = 
				{
					symptomCode: $('#symptomToBeSearchedCode').val(),
					dateSymptomFirstSeen: $('#dateSymptomSeen').val(),
					symptomTitle: $('symptomToBeSearchedTitle').val()
				};
				//pass new symptom into symptomsList array
				symptomsList.push(newSymptom);
				//empty input
				$('#symptomToBeSearchedCode').val("");
 			 	$('#symptomToBeSearchedTitle').val("");
 			 	$('#dateSymptomSeen').val("");
				//append symptoms table
				$('#symptomTable tbody').append('<tr class="child"><td>'+newSymptom.symptomCode+'</td></tr>');
			});

			$('#symptomhistory-form').on(submit, function(e)
			{
				e.preventDefault;

				//create new symptom in javascript
				var newSymptom = 
				{
					symptomCode: $('#symptomToBeSearchedCode').val(),
					dateSymptomFirstSeen: $('#dateSymptomSeen').val(),
					symptomTitle: $('symptomToBeSearchedTitle').val()
				};
				//pass new symptom into symptomsList array
				symptomsList.push(newSymptom);
				
			});
			
});