<?php
$this->pageTitle=Yii::app()->name . ' - Add Symptom';
$this->breadcrumbs=array(
	'Add Symptom',
); 

//side menu
$this->menu= Yii::app()->Globals->getSidePortletMenu();

//include custom JS scripts
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/assets/addSymptomJS.js',
        CClientScript::POS_END
	);
//include css file
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/addSymptom.css');

?> 


<!-- Select symptom category dropdown menu -->
<div id="addSymptomLabelDiv" class="row">
<h3 id="addSymptomLabel">Choose a Symptom Category</h3>
</div>


<div id="symptomSelectDiv">
<?php

//widget to pick symptom
$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'symptoms-grid',
		'selectableRows'=>1, //ability to select one symptom at a time
		'dataProvider'=>$symptomsModel->search(),
		'filter'=>$symptomsModel,
		'columns'=>array(
			'symptomCode',
			'title',
			'inclusions',
			'exclusions',
			array('name'=>'symptomCategory', 'filter'=>'')		
		)
));   ?>	 
</div>
<br/>
<div id="selectedSymptomDiv">

<?php echo CHtml::Button('', array('class'=>'symptomButton', 'id'=>'selectedSymptomButton', 'onclick'=>'resetSymptomPick()')); ?>

</div>

<div class="row buttons">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'symptomhistory-form',
	'enableAjaxValidation'=>false,	
)); ?>

		<br/>
		<?php echo $form->hiddenField($model,'symptomCode', array('id'=>'symptomToBeSearchedCode')); ?>
		
		<?php echo $form->hiddenField($model,'symptomTitle', array('id'=>'symptomToBeSearchedTitle')); ?>
		
		<div id="dateDiv" class="row">
		<div id="datePickingDiv" class="row">
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
			array(
				'model'=>$model,
				'attribute'=>'dateSymptomFirstSeen',
				'id'=>'dateSymptomSeen',
    			'flat' => true,
    			'options'=>array(
       	 						'maxDate'=>"+0D", //the latest date the user can pick is the current date
       	 						'dateFormat'=>'yy-mm-dd', //date format set to be compatible with database
    						),
  				'htmlOptions'=>array(	
       							'style'=>'height:400px;'
    						),
		)); ?>
		</div>
		</div>

		</br>	
		<div id="submitButtonDiv" class="row buttons">
		<?php echo CHtml::submitButton('Add Symptom'); ?>
		</div>
</div>



<?php $this->endWidget(); ?>
</div>  <!-- end of form -->



