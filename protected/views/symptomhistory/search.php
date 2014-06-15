<?php
$this->pageTitle=Yii::app()->name . ' - Search Symptoms';
$this->breadcrumbs=array(
	'Search Symptoms',
); ?>
<?php
//include custom JS scripts
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/assets/mSBscripts.js',
        CClientScript::POS_END
	);
?>
<h1>Welcome to the search for symptoms page</h1>



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
		<?php echo $form->textField($model,'symptomTitle', array('id'=>'symptomToBeSearchedTitle')); ?>
		<?php echo $form->error($model,'symptomTitle'); ?>
		<br/>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
			array(
				'model'=>$model,
				'attribute'=>'dateSymptomFirstSeen',
				'id'=>'dateSymptomSeen',
    			'options'=>array(
       	 						'showAnim'=>'fold',
       	 						'dateFormat'=>'yy-mm-dd', //date format set to be compatible with database
    						),
  				'htmlOptions'=>array(	
       							'style'=>'height:20px;'
    						),
		)); ?>
		<?php echo CHtml::Button('Search Symptom(s)', array('id'=>'search'));  ?>
		<?php echo CHtml::Button('Add Another Symptom to Search', array('id'=>'addSymptom'));  ?>
	</div>


<div>
<table id="symptomTable"><tr><td></td></tr></table>
</div>
<?php $this->endWidget(); ?>
</div>  <!-- end of form -->