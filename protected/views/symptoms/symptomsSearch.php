<?php
$this->pageTitle=Yii::app()->name . ' - Search Symptoms';
$this->breadcrumbs=array(
	'Search Symptoms',
);

//select symptom category, reveal symptomSelectDiv and populate symptom select grid to choose symptom
Yii::app()->clientScript->registerScript('search', "
			$( document ).ready(function() {

			$('#symptomSelectDiv').hide();

			$('#categorySelectDropDown').change(function(){
				$('#symptomSelectDiv').show();
				$('#symptoms-grid').yiiGridView('update', {
					data: $(this).serialize()
				});
				return false;
			});
			
			$('#symptomsSearchgrid table tbody tr').click(function() {
  				
  				var firstColVal = $(this).find('td:first-child').text();
 			 	$('#symptomToBeSearched').val(firstColVal);
            });
			});
	 "); 
?>
<h1>Welcome to the search for symptoms page </h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'searchSymptom-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


<p class="note"></p>
	<!-- Select symptom category dropdown menu -->
	<div class="search-form">
			<?php $this->renderPartial('_searchCategory',array('model'=>$model)); ?>
	</div>


			   <!-- select symptom -->
	<div class="row" id="symptomSelectDiv" >
		<?php $this->renderPartial('_symptomsGrid',array('model'=>$model));?>
	</div>

	<div class="row buttons">
		<?php echo $form->textField($model,'symptomCode', array('id'=>'symptomToBeSearched')); ?>
		
		<?php  echo CHtml::submitButton('Search');  ?>
	</div>



<?php $this->endWidget(); ?>
</div>  <!-- end of form -->