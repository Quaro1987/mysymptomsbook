<?php
/* @var $this SymptomhistoryController */
/* @var $model Symptomhistory */
/* @var $form CActiveForm */
//include custom JS scripts
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->baseUrl . '/assets/diagnoseSymptom.js',
        CClientScript::POS_LOAD
	);

?>

<div class="form">


<?php
	echo '<div class="row">';
	echo '<h4>Previous Doctor diagnosis: ';
	//switch check if there is a previous diagnosis and present it to the doctor
	switch ($symptomHistoryModel->symptomFlag)
	{
		case '1':
			echo '<span  class="lowDiagnosis">Low Danger</span></h4>';
			break;
		case '2':
			echo '<span  class="mildDiagnosis">Mild Danger</span></h4>';
			break;
		case '3':
			echo '<span  class="highDiagnosis">High Danger</span></h4>';
			break;
		default:
			echo '<span class="noDiagnosis">No diagnosis yet</span></h4>';
	}
	echo '<div class="row">';
	echo '<h4>Select diagnosis: </h4>';
	//widget for buttons to select symptom danger
	$this->widget('booster.widgets.TbButtonGroup',array(
	   	'buttons' => array(
	   		array('label' => 'Low Danger',  'htmlOptions'=>array('id' => 'lowDangerButton', 'onClick'=>'lowFlagSelected()')),
	   		array('label' => 'Mild Danger', 'htmlOptions'=>array('id' => 'mildDangerButton', 'onClick'=>'mildFlagSelected()')),
	   		array('label' => 'High Danger', 'htmlOptions'=>array('id' => 'highDangerButton', 'onClick'=>'highFlagSelected()'))
	   		),
	   	)
	); 
	echo '</div>'; 
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
		
		
		$this->endWidget(); 
		//button to sumit form
		
	
?>

</div><!-- form -->

