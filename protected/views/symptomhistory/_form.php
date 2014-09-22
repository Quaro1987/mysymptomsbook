<?php
/* @var $this SymptomhistoryController */
/* @var $model Symptomhistory */
/* @var $form CActiveForm */
//include custom JS scripts
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/assets/diagnoseSymptom.js',
        CClientScript::POS_HEAD
	);


?>

<div class="form">


<?php
$this->widget('booster.widgets.TbButtonGroup',array(
   	'buttons' => array(
   		array('label' => 'Low Danger',  
   			  'htmlOptions'=>array(
   			  		'id' => 'lowDangerButton', 
   			  		'onClick'=>'function()
   			  			{
   			  				$("#symptomFlagTextField").val("1");
   			  				$("lowDangerButton").addClass("selectedFlag");
   			  			}')),
   		array('label' => 'Mild Danger', 'htmlOptions'=>array('id' => 'mildDangerButton', 'onClick'=>'$("#symptomFlagTextField").val("2");')),
   		array('label' => 'High Danger', 'htmlOptions'=>array('id' => 'highDangerButton', 'onClick'=>'$("#symptomFlagTextField").val("3");'))
   		),
   	)
); 

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'diagnoseSymptomForm',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); 
	//textfield input for symptom flag
	echo $form->hiddenfield($symptomHistoryModel, 'symptomFlag', array('id'=>'symptomFlagTextField'));
	

	echo $form->hiddenfield($symptomHistoryModel, 'id', array('value'=>$symptomHistoryModel->id));
	//button to sumit form
	
	$this->endWidget(); 

	

	?>

</div><!-- form -->

