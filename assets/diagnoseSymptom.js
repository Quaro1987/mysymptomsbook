//copy add doctor request choice to input textbox
$('#lowDangerButton').on('click', function() 
{		 	
  	$('#symptomFlagTextField').val('1');	 	
});

$('#mildDangerButton').on('click', function() 
{		 	
  	$('#symptomFlagTextField').val('2');	 	
});

$('#highDangerButton').on('click', function() 
{		 	
  	$('#symptomFlagTextField').val('3');	 	
});

