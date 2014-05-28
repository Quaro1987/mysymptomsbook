<?php
$this->pageTitle=Yii::app()->name . ' - Search Symptoms';
$this->breadcrumbs=array(
	'Search Symptoms',
);

//select symptom category, reveal symptomSelectDiv and populate symptom select grid to choose symptom
Yii::app()->clientScript->registerScript('search', "
			$('#symptomSelectDiv').hide();

			$('#categorySelectDropDown').change(function(){
				$('#symptomSelectDiv').show();
				$('#symptoms-grid').yiiGridView('update', {
					data: $(this).serialize()
				});
				return false;
			});
			var ColVal = 'text';
			
			$('#symptoms-grid table tbody tr').click(function()
       		{
            	var firstColVal=$('#symptoms-grid table tbody tr').find('td:first-child').text();
            	document.getElementByID('symptomToBeSearched').value = firstColVal;
            	alert(firstColVal);
            });
	 "); 
?>
<h1>Welcome to the search for symptoms page </h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<h1>Hello</h1>

<p class="note">Fields with <span class="required">*</span> are required.</p>
	<!-- Select symptom category dropdown menu -->
	<div class="search-form">
			<?php $this->renderPartial('_searchCategory',array('model'=>$model)); ?>
	</div>


			   <!-- select symptom -->
	<div class="row" id="symptomSelectDiv" >
		<?php $this->renderPartial('_symptomsGrid',array('model'=>$model));?>
	</div>

	<div class="row buttons">
		<input id="symptomToBeSearched" name="test" ></input>
		<?php  echo CHtml::submitButton('Search');  ?>
	</div>



<?php $this->endWidget(); ?>
</div>  <!-- end of form -->