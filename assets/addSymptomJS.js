$(document).ready(function() {
	$('#symptomSelectDiv').hide();
	$('#selectedSymptomDiv').hide();
	$('#dateDiv').hide();
	$('#submitButtonDiv').hide();
});

//changing symptom category in the addSymptom page updates the gridview
$('#categorySelectDropDown').change(function(){
	$('.search-form form').submit(function(){
		$('#symptoms-grid').yiiGridView('update', {
			data: $(this).serialize()
		});
	return false;
	});
	$('#symptomSelectDiv').show();
});
//select symptoms from gridview
$('#symptomSelectDiv').on('click', 'table tbody tr', function() 
{		
	//copy symptom attributes into variables
  	var firstColVal = $(this).find('td:first-child').text();
  	var secondColVal = $(this).find('td:nth-child(2)').text();
  	//copy variables into hidden textfields	
  	$('#symptomToBeSearchedCode').val(firstColVal);
  	$('#symptomToBeSearchedTitle').val(secondColVal);
  	//hide symptom grid and show button and take pick 
  	$('#symptomSelectDiv').slideToggle("slow", "linear");
  	$('#selectedSymptomDiv').toggle();
  	$('#dateDiv').slideToggle("slow", "linear");
  	$('#submitButtonDiv').toggle();
  	$('#addSymptomLabel').text("Input the date the Symptom was first seen.");
  	//change button's label
  	document.getElementById("selectedSymptomButton").value=secondColVal;
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
	alert('You need to select the date the symptom was first seen on');
	event.preventDefault();
	}			
});
//update gridview with side column pick
function updateGridView(gridID, value) 
{   
	//reset symptom pick if the user picks a new category
	$('#submitButtonDiv').hide();
	$('#dateDiv').hide();
	$('#selectedSymptomDiv').hide();
	$('#addSymptomLabel').text("Click on a Symptom to select it");
  	//change button's label
  	document.getElementById("selectedSymptomButton").value='';
  	$('#symptomToBeSearchedCode').val('');
  	$('#symptomToBeSearchedTitle').val('');
	
	//update gridview
    $.fn.yiiGridView.update(gridID, {
    	data: 'r=symptomhistory%2FaddSymptom&Symptoms%5BsymptomCategory%5D='+value
    });
    $('#symptomSelectDiv').show("slow", "linear");

    return false;
};
//reset symptom pick
function resetSymptomPick()
{
	$('#submitButtonDiv').toggle();
	$('#dateDiv').slideToggle("slow", "linear");
	$('#symptomSelectDiv').slideToggle("slow", "linear");
  	$('#selectedSymptomDiv').toggle();
  	$('#addSymptomLabel').text("Choose a Symptom Category");
  	//change button's label
  	document.getElementById("selectedSymptomButton").value='';
  	$('#symptomToBeSearchedCode').val('');
  	$('#symptomToBeSearchedTitle').val('');
}
