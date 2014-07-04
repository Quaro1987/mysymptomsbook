

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

            $('#addSymptom').click(function()
            {
            	if($('#symptomToBeSearchedTitle').val()=="")
            	{
            		alert('You need to select a symptom.');
            	}
            	else if($('#dateSymptomSeen').val()=="")
            	{
            		alert('You need to select the date the symptom was first seen on.');
            	}	
            	else if(!($.inArray($('#symptomToBeSearchedCode').val(), symptomCodesArray)==-1))
            	{
            		alert('This Symptom already exists in your search.');
            	}
            	else
            	{
            		//create new symptom in javascript
					var newSymptom = 
					{
						symptomCode: $('#symptomToBeSearchedCode').val(),
						dateSymptomFirstSeen: $('#dateSymptomSeen').val(),
						symptomTitle: $('#symptomToBeSearchedTitle').val()
					};
					//pass new symptom code into symptomCodes array
					symptomCodesArray.push(newSymptom.symptomCode);
					//add symptom code to query string
					symptomCodesQueryString = symptomCodesQueryString+"&symptomCode[]="+newSymptom.symptomCode;
					//pass new symptom into symptomsList array
					symptomsList.push(newSymptom);
					//increase counter
					counter++;
					//empty input
					$('#symptomToBeSearchedCode').val("");
 			 		$('#symptomToBeSearchedTitle').val("");
					//append symptoms table
					$('#symptomToBeSearchedTable tbody').append('<tr class="child"><td>'+newSymptom.symptomTitle+'</td></tr>');
					//make table visable
					$('#symptomToBeSearchedTable').removeClass("hidden");
				}
            });


			$('#search').click(function()
			{	
				if($('#symptomToBeSearchedTitle').val()=="")
            	{
            		alert('You need to select a symptom.');
            	}
            	else if($('#dateSymptomSeen').val()=="")
            	{
            		alert('You need to select the date the symptom was first seen on.');
            	}	
            	else if(!($.inArray($('#symptomToBeSearchedCode').val(), symptomCodesArray)==-1))
            	{
            		alert('This Symptom already exists in your search.');
            	}
            	else
            	{
					//create new symptom in javascript
					var newSymptom = 
					{
						symptomCode: $('#symptomToBeSearchedCode').val(),
						dateSymptomFirstSeen: $('#dateSymptomSeen').val(),
						symptomTitle: $('#symptomToBeSearchedTitle').val()
					};
					//pass new symptom code into symptomCodes array
					symptomCodesArray.push(newSymptom.symptomCode);
					//pass new symptom into symptomsList array
					symptomsList.push(newSymptom);
					//add symptom code to query string
					symptomCodesQueryString = symptomCodesQueryString+"&symptomCode[]="+newSymptom.symptomCode;
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
				}
			});
});