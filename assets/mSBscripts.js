$('#symptomSelectDiv').hide();

$(document).ready(function() 
			{
			//initialize symptoms array
			var symptomsList = [];
			//innitialize symptomCodes array
			var symptomCodesArray = [];
			//innitialize counter
			var counter = 0;
			//innitialize queryString
			var symptomCodesQueryString = "";
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
					symptomTitle: $('#symptomToBeSearchedTitle').val()
				};
				//create new object for symptom code
				symptomCodesQueryString = symptomCodesQueryString+"&symptomCode[]"+newSymptom.symptomCode;
				//pass new symptom into symptomsList array
				symptomsList.push(newSymptom);
				//increase counter
				counter++;
				//empty input
				$('#symptomToBeSearchedCode').val("");
 			 	$('#symptomToBeSearchedTitle').val("");
				//append symptoms table
				$('#symptomTable tbody').append('<tr class="child"><td>'+newSymptom.symptomCode+'</td></tr>');
            });


			$('#search').click(function()
			{	
				//create new symptom in javascript
				var newSymptom = 
				{
					symptomCode: $('#symptomToBeSearchedCode').val(),
					dateSymptomFirstSeen: $('#dateSymptomSeen').val(),
					symptomTitle: $('#symptomToBeSearchedTitle').val()
				};

				//pass new symptom into symptomsList array
				symptomsList.push(newSymptom);

				symptomCodesQueryString = symptomCodesQueryString+"&symptomCode[]"+newSymptom.symptomCode;
				
				console.log(symptomCodesQueryString);

				//make ajax call to server
				$.ajax({
					type:'POST',
					url: '/mysymptomsbook/index.php?r=symptomhistory/search',
					data:{symptomsList: symptomsList},
					success: function(result) {
           					window.location = '/mysymptomsbook/index.php?r=disease/index'+symptomCodesQueryString;
        			},
					dataType:'html',
				});
			});
});