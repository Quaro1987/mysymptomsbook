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