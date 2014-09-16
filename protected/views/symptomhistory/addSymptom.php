<?php
$this->pageTitle=Yii::app()->name . ' - Add Symptom';
$this->breadcrumbs=array(
	'Add Symptom',
); 

//side menu
$this->menu=array(
	array(
			'label'=>'Add Symptom', 
			'url'=>array('/symptomhistory/addSymptom'),
			'visible'=>!Yii::app()->user->isGuest
	),
	array(
			'label'=>'Find a Doctor', 
			'url'=>array('/doctorRequests/addDoctor'),
			'visible'=>!Yii::app()->user->isGuest
	),
	array(
			'label'=>'Manage User Requests', 
			'url'=>array('/doctorRequests/manageRequests'),
			'visible'=>(Yii::app()->user->usertype==1)
	),
	array(
			'label'=>'Check Patient Symptom History', 
			'url'=>array('/user/user/managePatients'),
			'visible'=>(Yii::app()->user->usertype==1)
	),
);

//include custom JS scripts
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/assets/addSymptomJS.js',
        CClientScript::POS_END
	);
?> 

<!-- Select symptom category dropdown menu -->
<div id="searchCategory" class="row">
			
<?php $form=$this->beginWidget('CActiveForm', array(
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
)); ?>

<?php 
echo $form->dropDownList($symptomsModel, 'symptomCategory',
                                        Yii::app()->Globals->getSymptomCategories(),
                                        array('submit'=>'',
                                              'id'=>'categorySelectDropDown',
                                              'prompt'=>"Select Symptom Category"));  ?>
<?php $this->endWidget(); ?>
</div>


<div class="row" id="symptomSelectDiv" >
<div class="row"><br/> <b>Select Symptom:</b> </div>	
<?php

//widget to pick symptom
$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'symptoms-grid',
		'selectableRows'=>1, //ability to select one symptom at a time
		'dataProvider'=>$symptomsModel->search(),
		'columns'=>array(
			'symptomCode',
			'title',
			'inclusions',
			'exclusions',
			'symptomCategory',		
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
		<?php echo $form->label($model,'dateSymptomFirstSeen'); ?>
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



