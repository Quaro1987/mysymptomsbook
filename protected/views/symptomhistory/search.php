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
 			 	var secondColVal = $(this).find('td:nth-child(2)').text();
 			 	$('#symptomToBeSearchedCode').val(firstColVal);
 			 	$('#symptomToBeSearched').val(secondColVal);
            });
			});
	 "); 
?>
<h1>Welcome to the search for symptoms page </h1>



<p class="note"></p>
	<!-- Select symptom category dropdown menu -->
	<div class="search-form">
			<?php $model2 = new Symptoms; ?>
			<?php $this->renderPartial('_searchCategory',array('model'=>$model2)); ?>
	</div>


			   <!-- select symptom -->
	<div class="row" id="symptomSelectDiv" >
		
		<?php $this->renderPartial('_symptomsGrid',array('model'=>$model2, false, true));?>
	</div>

	<div class="row buttons">
		<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'symptomhistory-form',
	'enableAjaxValidation'=>false,
	
	
)); ?>
		<?php echo $form->errorSummary($model); ?>
		<br/>
		<?php echo $form->textField($model,'symptomCode', array('id'=>'symptomToBeSearchedCode')); ?>
		<?php echo $form->error($model,'symptomCode'); ?>
		<br/>
		<?php echo $form->textField($model,'symptomTitle', array('id'=>'symptomToBeSearched')); ?>

		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
			array(
				'model'=>$model,
				'attribute'=>'dateSymptomFirstSeen',
    			'options'=>array(
       	 						'showAnim'=>'fold',
       	 						'dateFormat'=>'yy-mm-dd', //date format set to be compatible with database
    						),
  				'htmlOptions'=>array(
       							 'style'=>'height:20px;'
    						),
  				

		)); ?>
		<?php  echo CHtml::submitButton('Search');  ?>
	</div>



<?php $this->endWidget(); ?>
</div>  <!-- end of form -->